<?php
session_start();
//show errors
ini_set('display_errors',1);
error_reporting(E_ALL);
//enable error logging
define('LOGGING', true);
//catalog paths
define('DIR_PATH', dirname(__DIR__));
define('PUBLIC_PATH', DIR_PATH.DIRECTORY_SEPARATOR.'public');
define('APP_PATH', DIR_PATH.DIRECTORY_SEPARATOR.'app');
define('TEMPLATE_PATH', APP_PATH.DIRECTORY_SEPARATOR.'template');
define('DB_PATH', APP_PATH.DIRECTORY_SEPARATOR.'dB');
//file paths
return (object) array(
	'FileController' => APP_PATH.DIRECTORY_SEPARATOR.'FileController.php',
    'voteForm' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'voteForm.php',
    'voteResForm' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'voteResForm.php',
    'data' => DB_PATH.DIRECTORY_SEPARATOR.'data.json',
    'valueForVote' => DB_PATH.DIRECTORY_SEPARATOR.'valueForVote.php',
    'dB' => APP_PATH.DIRECTORY_SEPARATOR.'dB.php',
    'addVote' => APP_PATH.DIRECTORY_SEPARATOR.'addVote.php',
    'getVote' => APP_PATH.DIRECTORY_SEPARATOR.'getVote.php',
    'main' => '/',
    'result' => '../result.php',
    'getDB' => 'php/getDB.php',
);
