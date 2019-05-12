<?php

namespace Dt;

class selectAll {

	private $accountNUM;
	private $password;
	
	public $accountId;
	public $dataArray = [];
	public $dt_count;

	public function __construct($accountNUM, $password) {
		$this->accountNUM = $accountNUM;
		$this->password = $password;
		$this->oldSystemQuery();
		$this->newSystemQuery();
		$this->dt_count = count($this->dataArray);
	}

	private function oldSystemQuery() {
		$oldSystem = new \Dt\getAccountId($this->accountNUM, $this->password);
		$this->accountId = $oldSystem->accountId;
		$query = new \Dt\selectInfo($this->accountId);
		$this->dataArray = array_merge($this->dataArray, $query->dataArray);
	}

	private function newSystemQuery() {
		$query = new \Dt\newSystemInfo($this->accountNUM, $this->password, $this->accountId);
		$this->dataArray = array_merge($this->dataArray, $query->dataArray);
	}

}