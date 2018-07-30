<?php

class UserController
{   

    static function authorization($name, $pass) {
        try {
            if (!UserController::checkName($name)) {
                $_SESSION['loginErr'][] = 'логин должен быть два или более символов';
            }
            if (!UserController::checkPassword($pass)) {
                $_SESSION['loginErr'][] = 'пароль должен быть шесть или более символов';
            }
            if (!empty($_SESSION['loginErr'])) {
                return false;
            }

            if (UserController::checkUserAndPass($name, $pass)) {
                return true;
            }

            if (UserController::checkUserExist($name)) {
                $_SESSION['loginErr'][] = 'не правильный пароль';
                return false;
            }

            if (UserController::addNewUser($name, $pass)) {
                return true;
            }
            $_SESSION['err'][] = 'что-то пошло не так';
            return false;

        } catch (Exception $err){
            $_SESSION['err'][] = $err->getMessage();
            return false;
        }
    }
    private static function addNewUser($name, $pass) {

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

    private static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    
    private static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
}
