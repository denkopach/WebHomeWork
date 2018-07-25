<?php
session_start();

ini_set('display_errors',1);
error_reporting(E_ALL);

define('SHOW_LOGS', true);
define('DIR_PATH', dirname(dirname(__DIR__)));
define('APP_PATH', DIR_PATH.DIRECTORY_SEPARATOR.'app');
define('TEMPLATE_PATH', APP_PATH.DIRECTORY_SEPARATOR.'template');
define('CONFIG_PATH', APP_PATH.DIRECTORY_SEPARATOR.'config');

require_once(APP_PATH.DIRECTORY_SEPARATOR.'Autoload.php');

return (object) array(
    'dbParams' => CONFIG_PATH.DIRECTORY_SEPARATOR.'dbParams.php',
    'header' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'header.php',
    'footer' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'footer.php',
    'authForm' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'authForm.php',
    'chatForm' => TEMPLATE_PATH.DIRECTORY_SEPARATOR.'chatForm.php',
);