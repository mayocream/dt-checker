<?php

namespace Dt;

use GuzzleHttp\Client;

class selectInfo {

	private $accountId;

	public $dt_count = 0;
	public $dataArray = [];

	public function __construct($accountId) {
		$this->accountId = $accountId;
		$this->select();
	}

	private function select() {
		// get total page num
		$firstPage = $this->selectOne();
		preg_match('/<span id="pagetotal">([0-9]*)<\/span>/', $firstPage, $match);
		$pagetotal = (int)$match[1];
		//echo($pagetotal);
		// get page data
		// first page
		$this->parseData($firstPage);
		if ($pagetotal > 1) {
			for ($i=2; $i <= $pagetotal; $i++) { 
				$pageData = $this->selectOne($i);
				$this->parseData($pageData);
			}
		}
		//var_dump($this->data);
		$this->dt_count = count($this->dataArray);
	}

	private function selectOne($pageno = null) {
		$client = new Client();
		$form_params = [
			'account' => $this->accountId,
			'startDate' => '',
			'startDate' => ''
		];
		if ($pageno !== null) {
			$form_params['pageno'] = $pageno;
		}
		$res = $client->Request('POST', 'http://ecard.cxxy.seu.edu.cn/mjkqBrows.action', [
			'form_params' => $form_params,
			'connect_timeout' => 5
		]);
		$body = iconv('GB2312', 'UTF-8', $res->getBody()->getContents());
		//var_dump($body);
		return $body;
	}

	private function parseData($body) {
		preg_match_all('/<tr class="listbg(|2)">[\s]*<td align="left">([ 0-9-:]*)<\/td>[\s]*<td align="left">[\S]*<\/td>[\s]*<td  align="left">[\S]*<\/td>[\s]*<td align="left" >[\S]*<\/td>[\s]*<td align="left" >([\S]*)<\/td>[\s]*<\/tr>/', $body, $match);
		if (count($match) < 2) {
			return null;
		}
		$date = $match[2];
		$type = $match[3];
		//var_dump($date);
		//var_dump($type);
		for ($i=0; $i < count($date); $i++) { 
			if ($type[$i] == '学生早操考勤') {
				$this->dataArray[] = substr($date[$i], 0, 10);
				//echo '1';
			}
		}
		$this->dataArray = array_unique($this->dataArray);
	}

}