<?php
class Db{
    private $params;

    public function __construct()
    {
        $this->params = include_once 'config'.DIRECTORY_SEPARATOR.'dbParams.php';
        $this->logger = new Logger(Configs::getPath());
    }

    public function getConnection()
    {
        $params = $this->params;
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        try {
            $db = new PDO($dsn, $params['user'], $params['password'], array(PDO::ATTR_PERSISTENT => true));
            $db->exec("set names utf8");
            $this->logger->log('INFO', 'DB connectio succes', 'getConnection');
            return $db;
        } catch (PDOException $e) {
            $this->logger->log('ERROR', 'DB ERROR: ' . $e->getMessage(), 'getConnection');
            die('Error! error conect to DB');
        }
    }
}
