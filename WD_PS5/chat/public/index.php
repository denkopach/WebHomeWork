<?php

// FRONT CONTROLLER

define('ROOT', dirname(dirname(__FILE__)));
$configs = include(ROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'/config.php');

SiteController::actionIndex();

?>
