<?php

// FRONT CONTROLLER
session_start();
$config = require_once(dirname(__DIR__).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
require_once(APP_PATH.DIRECTORY_SEPARATOR.'Autoload.php');

$siteController = new SiteController($config);
$siteController->actionIndex();
