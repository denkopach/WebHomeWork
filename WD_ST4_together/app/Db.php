<?php

include('WeatherInterface.php');

class Db implements WeatherInterface
{
    private $dbDataConfig;
    private $connection;

    public function __construct()
    {
        $dataConfig = include CONFIG_PATH . 'data.php';
        $this->dbDataConfig = $dataConfig['db'];

        $dbConfig = $this->dbDataConfig;
        $dsn = "mysql:host={$dbConfig['dbHost']};port={$dbConfig['dbPort']};dbname={$dbConfig['dbName']};charset=utf8";

        $dbOptions = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->connection = new PDO($dsn, $dbConfig['dbUser'], $dbConfig['dbPassword'], $dbOptions);
        } catch (PDOException $e) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo 'ERROR conecting to dataBase!';
            return;
        }
    }

    public function run()
    {

        try {
            $request = $this->connection->query('SELECT UNIX_TIMESTAMP(forecast.timestamp) AS `time`, `temperature`, `rain_possibility`, `clouds` FROM `forecast`');
        } catch (PDOException $e) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo 'ERROR getting data!';
            return;
        }

        $weather = $request->fetchAll();
        array_splice($weather, $this->dbDataConfig['forecastsNumber']);

        http_response_code(200);
        header('Content-Type: application/json');

        require_once('ForecastAdapter.php');
        $adapter = new ForecastAdapter();
        echo $adapter->get($weather);
    }
}
