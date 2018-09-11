<?php

class UserController
{
    static function authorization($name, $pass)
    {
        global $configs;
        $errors = include $configs->error;
        try {
            if (self::checkUserAndPass($name, $pass)) {
                return true;
            }

            if (self::checkUserExist($name)) {
                $_SESSION['loginErr'][] = $errors['passIsWrong'];
                return false;
            }

            if (self::addNewUser($name, $pass)) {
                return true;
            }
            $_SESSION['err'][] = $errors['somethingWrong'];
            return false;

        } catch (Exception $err){
            $_SESSION['err'][] = $err->getMessage();
            return false;
        }
    }
    private static function addNewUser($name, $pass)
    {

        $db = Db::getConnection();
        $sql = 'INSERT INTO users (name, pass) '
                . 'VALUES (:name, :pass)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':pass', $pass, PDO::PARAM_STR);
        return $result->execute();
    }

    private static function checkUserAndPass($name, $pass)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE name = :name AND pass = :pass';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':pass', $pass, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return true;
        }
        return false;
    }

    private static function checkUserExist($name)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE name = :name';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return true;
        }
        return false;
    }
}
