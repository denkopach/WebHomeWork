<?php
class CreateDb
{
	public static function create()
    {
        try {
            global $configs;
            $params = include $configs->dbParams;

            $dsn = "mysql:host={$params['host']};}";
            $db = new PDO($dsn, $params['user'], $params['password']);
            $db->exec("CREATE DATABASE {$params['dbname']};") ;
            unset($db);

            $db = Db::getConnection();
            $sql = "CREATE table users(
                `newid` INT( 11 ) unsigned AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR( 30 ) NOT NULL, 
                `pass` VARCHAR( 30 ) NOT NULL,
                `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP )" ;
            $db->exec($sql);
            $sql = "CREATE table messages(
                `newid` INT(11) unsigned AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(30) NOT NULL, 
                `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                `msg` VARCHAR(200) NOT NULL )" ;
            $db->exec($sql);
        } catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
    }
}
