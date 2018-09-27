<?php

class WeatherFactory
{
    public static function selectClass($name)
    {
        $appConfig = include CONFIG_PATH . 'app.php';
        $dataConfig = include CONFIG_PATH . 'data.php';
        if (!isset($dataConfig[$name])) {
            return 'Weather service data not found';
        }

        if (!file_exists($appConfig[$name])) {
            return 'Weather service functions not found';
        }

        $icons = require_once $appConfig['icons'];

        require $appConfig[$name];
        return new $name($dataConfig[$name], $icons);
    }
}
