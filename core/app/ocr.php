<?php

namespace Dt;

use GuzzleHttp\Client;

class Ocr {

	private $api_key = 'BUbksLdWttiefvmr0xDKko2I';
	private $secret_key = '8UZnpN7nM8zw5ekOSYqZWVhBQ9jN4viq';
	private $token;
	private $token_storage = ROOT_PATH.'/storage/token.txt';

	public function __construct() {
		$this->getToken();
	}

	private function getToken() {
		if (file_exists($this->token_storage)) {
			$token_storage = unserialize(file_get_contents(ROOT_PATH.'/storage/token.txt'));
			if (strtotime('now') <= $token_storage['expires_time']) {
				$this->getNewToken();
			} else {
				$this->token = $token_storage['token'];
			}
		} else {
			$this->getNewToken();
		}
	}

	private function getNewToken() {
		$client = new Client();
		$res = $client->Request('POST', 'https://aip.baidubce.com/oauth/2.0/token', [
			'query' => [
				'grant_type' => 'client_credentials',
				'client_id' => $this->api_key,
				'client_secret' => $this->secret_key
			]
		]);
		$json = json_decode($res->getBody()->getContents());
		$this->token = $json->access_token;
		file_put_contents(ROOT_PATH.'/storage/token.txt', serialize([
			'token' => $this->token,
			'expires_time' => strtotime('+'.$json->expires_in.'s')
		]));
	}

	public function ocrPic($pic_base64) {
		$client = new Client();
		$res = $client->Request('POST', 'https://aip.baidubce.com/rest/2.0/ocr/v1/general_basic', [
			'query' => [
				'access_token' => $this->token
			], 'form_params' => [
				'image' => $pic_base64
			]
		]);
		$result = json_decode($res->getBody()->getContents(), true);
		return $result['words_result'][0]['words'];
	}

}