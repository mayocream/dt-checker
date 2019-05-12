<?php

namespace Dt;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class interfaceApi {

	private $error_msg;
	private $return_content;

	public function __construct() {
		$this->loginRequest();
	}

	private function loginRequest() {
		$request = Request::createFromGlobals();
		if(!$request->request->has('accountNUM') || !$request->request->has('password')) {
			$this->error_msg = [
				'error_code' => 403,
				'msg' => 'Login Failed.'
			];
			$this->error();
		}
		try {
			$select = new \Dt\selectAll($request->request->get('accountNUM'), $request->request->get('password'));
			$this->return_content = [
				'dateArray' => $select->dateArray,
				'dt_count' => $select->dt_count,
				'accountId' => $select->accountId
			];
			$this->return_content();
		} catch (Exception $e) {
			$this->error_msg = [
				'error_code' => $e->getCode(),
				'msg' =>$e->getMessage()
			];
			$this->error();
		}
	}

	private function return_content() {
		$response = new Response(
			json_encode([
				'success' => true,
				'content' => $this->return_content
			]),
			Response::HTTP_OK,
			['Content-Type' => 'application/json']
		);
		$response->send();
		exit();
	}

	private function error() {
		$response = new Response(
			json_encode([
				'success' => false,
				'content' => $this->error_msg
			]),
			$this->error_msg['error_code'],
			['Content-Type' => 'application/json']
		);
		$response->send();
		exit();
	}


}