<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

if (!isset($_POST)) {
	header('Location: ../index.html');
	die();
}
$inputData = array_filter($_POST);

$pattern = [
	'ip' => '/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/',
	'url' => '/^(https?|ftp|torrent|image|irc):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?$/i',
	'email' => '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
	'date' => '^\\d{1,2}/\\d{2}/\\d{4}^',
	'time' => '/^([0-1][0-9]|2[0-3])[:]([0-5][0-9])[:]([0-5][0-9])$/'
];

foreach($inputData as $index => $val){
	if (isset($pattern[$index])) {
		$error[$index] = preg_match($pattern[$index], $val);
	}
}

echo json_encode($error, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
