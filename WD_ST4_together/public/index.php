<?php
define('CONFIG_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR);

$appConfig = require_once CONFIG_PATH . 'app.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once $appConfig['mainPage'];
    return;
}

require_once $appConfig['WeatherFactory'];
$weatherService = WeatherFactory::selectClass($_POST['handler']);
if (is_string($weatherService)) {
    echo $weatherService;
    return;
}
$weatherService->run();
