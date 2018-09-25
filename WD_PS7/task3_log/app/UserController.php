<?php

class UserController
{   
    private $db;
    function UserController()
    {
        $this->db = Db::getConnection();
    }
    public function authorization($name, $pass)
    {
        global $configs;
        $errors = include $configs->error;
        try {
            if ($this->checkUserAndPass($name, $pass)) {
                return true;
            }

            if ($this->checkUserExist($name)) {
                Logger::log("INFO", 'wrong pass', "authorization");
                $_SESSION['loginErr'][] = $errors['passIsWrong'];
                return false;
            }

            if ($this->addNewUser($name, $pass)) {
                return true;
            }
            Logger::log("INFO", 'somethingWrong', "authorization");
            $_SESSION['err'][] = $errors['somethingWrong'];
            return false;

        } catch (Exception $err){
            Logger::log("ERROR", $err->getMessage(), "authorization");
            $_SESSION['err'][] = $err->getMessage();
            return false;
        }
    }
    private function addNewUser($name, $pass)
    {

        $sql = 'INSERT INTO users (name, pass)'
                . 'VALUES (:name, :pass)';

        $result = $this->db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':pass', $pass, PDO::PARAM_STR);

        $resp = $result->execute();
        $_SESSION['id'] = $this->db->lastInsertId();
        return $resp;
    }

    private function checkUserAndPass($name, $pass)
    {
        $sql = 'SELECT newid FROM users WHERE name = :name AND pass = :pass';
        $result = $this->db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':pass', $pass, PDO::PARAM_STR);
        $result->execute();
        $userID = $result->fetch();
        if ($userID) {
            $_SESSION['id'] = $userID[0];
            return true;
        }
        return false;
    }

    private function checkUserExist($name)
    {
        $sql = 'SELECT * FROM users WHERE name = :name';
        $result = $this->db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();
        if ($user) {
            return true;
        }
        return false;
    }
}
