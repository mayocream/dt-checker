<?php

$url = 'http://baidu.com';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,0);
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HEADER,1);
curl_setopt($ch, CURLINFO_HEADER_OUT,1);
$output = curl_exec($ch);
$headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);

var_dump($output);