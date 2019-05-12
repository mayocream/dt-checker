<?php

namespace Dt;

use GuzzleHttp\Client;

class getAccountId {

	public $accountId;
	private $cookie;

	public function __construct($cardNUM, $password) {
		$this->getCookie($cardNUM, $password);
	}

	private function getCookie($cardNUM, $password) {
		$client = new Client();
		$res = $client->Request('POST', 'http://my.cxxy.seu.edu.cn/userPasswordValidate.portal', [
			'form_params' => [
				'Login.Token1' => $cardNUM,
				'Login.Token2' => $password
			]
		]);
		$cookie = $res->getHeader('Set-Cookie');
		// testing
		//var_dump($cookie[0]);
		if (!empty($cookie)) {
			$res = $client->Request('GET', 'http://ecard.cxxy.seu.edu.cn/cxxyportalHome.action', [
				'headers' => [
					'Cookie' => $cookie[0]
				]
			]);
			$this->cookie = $res->getHeader('Set-Cookie')[0];
			// testing
			//var_dump($this->cookie);
			$this->getAccountId();
		} else {
			throw new \Exception("Login Failed.", 403);
		}
	}

	private function getAccountId() {
		$client = new Client();
		$res = $client->Request('GET', 'http://ecard.cxxy.seu.edu.cn/mjkqcardUser.action', [
			'headers' => [
				'Cookie' => $this->cookie
			]
		]);
		$body = $res->getBody()->getContents();
		preg_match('/<input name="account"  type="hidden" value=([0-9]*) >/', $body, $match);
		if (count($match) > 1) {
			$this->accountId = $match[1];
		} else {
			throw new \Exception("Login Failed.", 403);
		}
	}


}