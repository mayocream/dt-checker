<?php

namespace Dt;

use GuzzleHttp\Client;

class newSystemInfo {

	public $dt_count = 0;
	public $dataArray = [];

	private $cookie;
	private $accountNUM;
	private $password;
	private $accountId;

	public function __construct($accountNUM, $password, $accountId) {
		$this->accountNUM = $accountNUM;
		$this->password = $password;
		$this->accountId = $accountId;
		$this->getCookie();
		$this->select();
	}

	private function select() {
		$client = new Client();
		$res = $client->Request('POST', 'http://paocao.cxxy.seu.edu.cn/Page/NewDoor/Handler/WaterListHandler.ashx', [
			'headers' => [
				'Cookie' => $this->cookie
			], 
			'form_params' => [
				'cmd' => 'queryWaterList',
				'sno' => '',
				'name' => '',
				'account' => $this->accountId,
				'deptcode' => '',
				'cardid' => '',
				'start_date' => '',
				'end_date' => '',
				'start_time' => '',
				'end_time' => '',
				'pid' => '',
				'doorreaderid' => '',
				'controlid' => '',
				'workaroundid' => '',
				'inout' => '',
				'eventtype' => '',
				'LimitWorkAround' => false,
				'LimitDept' => false,
				'page' => 1,
				'rows' => 10000
			],
			'connect_timeout' => 9
		]);
		$data = json_decode($res->getBody()->getContents(), true);
		//var_dump($data);
		$this->parseData($data);
	}

	private function parseData($data) {
		if ($data['total'] == 0) {
			return null;
		}
		foreach ($data['rows'] as $line) {
			if ($line['EventTypeStr'] == '正常刷卡开门') {
				$this->dataArray[] = substr($line['Watertime'], 0, 10);
			}
		}
		$this->dataArray = array_unique($this->dataArray);
		$this->dt_count = count($this->dataArray);
	}

	private function getCookie() {
		if ($this->loginOnce() == false) {
			for ($i=0; $i < 9; $i++) { 
				if ($this->loginOnce() == true) {
					break;
				}
				if ($i == 8) {
					throw new \Exception("Timeout.", 500);
				}
			}
		}
		preg_match('/([\S]*);/', $this->cookie, $match);
		$this->cookie = $match[0].' UserID=11111';
		//var_dump($this->cookie);
	}

	private function loginOnce() {
		$client = new Client();
		$res = $client->Request('GET', 'http://paocao.cxxy.seu.edu.cn/Page/NewSetting/Handler/LoginHandler.ashx?cmd=GetValidateCode&time='.strtotime('now'), ['connect_timeout' => 9]);
		$this->cookie = $res->getHeader('Set-Cookie')[0];
		$pic_base64 = base64_encode($res->getBody()->getContents());
		//file_put_contents(ROOT_PATH.'/test/pic_base64.txt', $pic_base64);
		$ocr = new \Dt\picOcr();
		$vaildCode = $ocr->ocrPic($pic_base64);
		//var_dump($vaildCode);
		$res = $client->Request('POST', 'http://paocao.cxxy.seu.edu.cn/Page/NewSetting/Handler/LoginHandler.ashx?cmd=Login', [
			'form_params' => [
				'LoginType' => 'sno',
				'UserName' => $this->accountNUM,
				'Password' => $this->password,
				'ValiCode' => $vaildCode
			], 'headers' => [
				'Cookie' => $this->cookie
			],
			'connect_timeout' => 9
		]);
		$result = json_decode($res->getBody()->getContents(), true)['success'];
		//var_dump($result);
		return $result;
	}


}