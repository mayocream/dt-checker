<?php

namespace Dt;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class interfaceApi {

	private $error_msg;
	private $return_content;

	public function __construct() {
		$this->exception();
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
		$select = new \Dt\selectAll($request->request->get('accountNUM'), $request->request->get('password'));
		$this->return_content = [
			'period' => \Dt\dateHandle::createFromData($select->dataArray),
			'dateArray' => $select->dataArray,
			'dt_count' => $select->dt_count,
			'accountId' => $select->accountId
		];
		$this->return_content();
	}

	private function exception() {
		set_exception_handler(function ($e) {
			if ($e->getCode() === 0) {
				$error_code = 500;
			} else {
				$error_code = $e->getCode();
			}
	   		$this->error_msg = [
				'error_code' => $error_code,
				'msg' =>$e->getMessage()
			];
			$this->error();
		});
	}

	private function return_content() {
		$response = new Response(
			json_encode([
				'success' => true,
				'content' => $this->return_content
			]),
			Response::HTTP_OK,
			[
				'Content-Type' => 'application/json',
				'Access-Control-Allow-Origin' => '*'
			]
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
			[
				'Content-Type' => 'application/json',
				'Access-Control-Allow-Origin' => '*'
			]
		);
		$response->send();
		exit();
	}


}