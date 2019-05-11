<?php

namespace Checker;

class login {

	public function __construct($cardNUM, $password) {
		
	}

	private function validate() {

	}

	private function post() {

	}
}

class Http {

	private $url;

	public function __construct($url) {
		$this->url = $url;
	}

	public function post(array $header, array $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLINFO_HEADER_OUT,1);
		$output = curl_exec($ch);
		$headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);
	}
}


class getCookie {

}