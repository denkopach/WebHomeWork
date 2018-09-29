<?php

class UserController
{   
    private $db;
    private $logger;
    private $errors;

    function __construct($configs)
    {
        $DB = new Db($configs);
        $this->db = $DB->getConnection();
        $this->logger = new Logger($configs);
        $this->errors = include $configs->error;
    }
    public function authorization($name, $pass)
    {
        try {
            if ($this->checkUserAndPass($name, $pass)) {
                return true;
            }

            if ($this->checkUserExist($name)) {
                $this->logger->log("INFO", 'wrong pass', "authorization");
                $_SESSION['loginErr'][] = $this->errors['passIsWrong'];
                return false;
            }

            if ($this->addNewUser($name, $pass)) {
                return true;
            }
            $this->logger->log("INFO", 'somethingWrong', "authorization");
            $_SESSION['err'][] = $this->errors['somethingWrong'];
            return false;

        } catch (Exception $err){
            $this->logger->log("ERROR", $err->getMessage(), "authorization");
            $_SESSION['err'][] = $err->getMessage();
            return false;
        }
    }
    private function addNewUser($name, $pass)
    {

        $sql = 'INSERT INTO users (userName, userPass)'
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
        $sql = 'SELECT userId FROM users WHERE userName = :userName AND userPass = :userPass';
        $result = $this->db->prepare($sql);
        $result->bindParam(':userName', $name, PDO::PARAM_STR);
        $result->bindParam(':userPass', $pass, PDO::PARAM_STR);
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
        $sql = 'SELECT * FROM users WHERE userName = :userName';
        $result = $this->db->prepare($sql);
        $result->bindParam(':userName', $name, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();
        if ($user) {
            return true;
        }
        return false;
    }
}
