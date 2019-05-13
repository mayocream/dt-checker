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
 "2018-10-23",
 "2018-10-18",
 "2018-10-17",
 "2018-10-16",
 "2018-10-09",
 "2018-09-28",
 "2018-09-27",
 "2018-09-26",
 "2018-09-25",
 "2018-09-19",
 "2018-09-18",
 "2018-09-17"
];
$dateHandle = new \Dt\dateHandle();
$data = $dateHandle->createFromData($dataArray);
var_dump($data);