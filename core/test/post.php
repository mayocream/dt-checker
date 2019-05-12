<?php

define('ROOT_PATH', dirname(__FILE__) . '/../');

require ROOT_PATH.'/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$reponse = $client->request('GET', 'http://baidu.com');

var_dump($reponse->getHeader('Set-Cookie'));