<?php

include('WeatherInterface.php');

class Api implements WeatherInterface
{
    private $apiDataConfig;

    public function __construct()
    {
        $dataConfig = include CONFIG_PATH . 'data.php';
        $this->apiDataConfig = $dataConfig['api'];
    }

    public function run()
    {
        $weather = json_decode(@file_get_contents($this->apiDataConfig['apiPath'] . $this->apiDataConfig['apiKey']));

        if (!$weather) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode('Can not get data from weather service API');
            return;
        }

        array_splice($weather, $this->apiDataConfig['forecastsNumber']);

        http_response_code(200);
        header('Content-Type: application/json');
        require_once('ForecastAdapter.php');
        $adapter = new ForecastAdapter();
        echo $adapter->get($weather);
    }
}
