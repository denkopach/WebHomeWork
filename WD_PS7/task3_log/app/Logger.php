<?php
class Logger
{
    static function log($level, $message, $service)
    {
        global $configs;
        if ($level === 'ERROR') {
            http_response_code(500);
        } else {
            http_response_code(200);
        }
        if (!isset($_SESSION['id'])) {
            $_SESSION['id'] = 'none';
        }
        $log = array(
            "@timestamp" => date("Y-m-d H:i:s"),
            "level" => $level,
            "message" => $message,
            "service" => $service,
            "customerid" =>  $_SESSION['id'],
            "ip" => $_SERVER['REMOTE_ADDR'],
        );
        $logStr = date("Y-m-d H:i:s")."level='${level}' message='${message}' service='${service}' customerid='{$_SESSION['id']}' ip='{$_SERVER['REMOTE_ADDR']}'".PHP_EOL;
        file_put_contents($configs->logFile, $logStr, FILE_APPEND | LOCK_EX);
        return $log;
    }
}
