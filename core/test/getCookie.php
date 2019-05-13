<?php

define('ROOT_PATH', dirname(__FILE__) . '/../');

require ROOT_PATH.'/vendor/autoload.php';

//$getId = new \Dt\getAccountId('230218235', '283117');

// $accountNUM = '230218236';
// $password = '077670';

// $accountNUM = '230218235';
// $password = '283117';

//$getId = new \Dt\getAccountId($accountNUM, $password);

//var_dump($getId->accountId);
//$select = new \Dt\selectInfo($getId->accountId);
//var_dump($select->dt_count);

//$ocr = new \Dt\Ocr();
//echo $ocr->ocrPic('http://paocao.cxxy.seu.edu.cn/Page/NewSetting/Handler/LoginHandler.ashx?cmd=GetValidateCode&time=15576824036');

//$newSystem = new \Dt\newSystemInfo($accountNUM, $password, $getId->accountId);

// $select = new \Dt\selectAll($accountNUM, $password);
// echo $select->dt_count;

$dataArray = [
	'2018-09-01',
	'2019-10-23',
	'2020-02-11'
];
$data = \Dt\dateHandle::handleData($dataArray);
var_dump($data);