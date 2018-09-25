<?php

// FRONT CONTROLLER
$configs = include dirname(__DIR__).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

SiteController::actionIndex();
