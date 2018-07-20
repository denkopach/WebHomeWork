<?php
session_start();

ini_set('display_errors',1);
error_reporting(E_ALL);

define('SHOW_LOGS', true);
define('DIR_PATH', dirname(__DIR__));
define('APP_PATH', DIR_PATH.DIRECTORY_SEPARATOR.'app');
define('TEMPLATE_PATH', APP_PATH.DIRECTORY_SEPARATOR.'template');
define('DB_PATH', APP_PATH.DIRECTORY_SEPARATOR.'db');

require_once(APP_PATH.DIRECTORY_SEPARATOR.'Autoload.php');

return (object) array(
	'header' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'header.php',
	'footer' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'footer.php',
	'authForm' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'authForm.php',
	'chatForm' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'chatForm.php',
	'users' => DB_PATH.DIRECTORY_SEPARATOR.'users.json',
	'messages' => DB_PATH.DIRECTORY_SEPARATOR.'messages.json',
);