<?php

include('WeatherInterface.php');

class Json implements WeatherInterface
{
    private $jsonError;
    private $jsonDataConfig;

    public function __construct()
    {
        $dataConfig = include CONFIG_PATH . 'data.php';
        $this->jsonDataConfig = $dataConfig['json'];
        $this->jsonError = $this->checkJson();
        if ($this->jsonError) {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode($this->jsonError);
            return;
        }
    }

    private function checkJson()
    {
        if (!file_exists($this->jsonDataConfig['jsonPath'])) {
            return 'Json is not found';
        }

        if (!is_writable($this->jsonDataConfig['jsonPath'])) {
            return 'Json is not writable';
        }

        if (!is_readable($this->jsonDataConfig['jsonPath'])) {
            return 'Json is not readable';
        }

        return false;
    }

    public function run()
    {
        $jsonForecasts = json_decode(file_get_contents($this->jsonDataConfig['jsonPath']));
        $weather = $jsonForecasts->list;

        array_splice($weather, $this->jsonDataConfig['forecastsNumber']);

        http_response_code(200);
        header('Content-Type: application/json');

        require_once('ForecastAdapter.php');
        $adapter = new ForecastAdapter();
        echo $adapter->get($weather);
    }
}
