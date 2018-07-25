<?php
class Db{

private static $conn;

    public static function getConnection()
    {

        if (!empty(self::$conn)) {
            return self::$conn;
        }
        try {
            global $configs;
            $params = include $configs->dbParams;
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $db = new PDO($dsn, $params['user'], $params['password'], array(PDO::ATTR_PERSISTENT => true));
            $db->exec("set names utf8");
            self::$conn = $db;
            return $db;
        } catch (PDOException $e) {
             print "Error! : " . $e->getMessage() . "<br/>";
             die();
        }
    }
}
