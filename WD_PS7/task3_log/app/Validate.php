<?php

class Validate
{
    private $errors;

    public function __construct()
    {
        $this->errors = include Configs::getPath()->error;
    }

    public function check($name, $pass)
    {
        try {
            if (empty($name)) {
                $_SESSION['loginErr'][] = $this->errors['loginIsEmpty'];
            }
            if (empty($pass)) {
                $_SESSION['loginErr'][] = $this->errors['passIsEmpty'];
            }
            if (!empty($_SESSION['loginErr'])) {
                return false;
            }
            if(!preg_match( '/^[A-Za-z0-9 ]+$/i',$name)) {
                $_SESSION['loginErr'][] = $this->errors['loginHasSymbol'];
            }
            if (strlen($name) < 2) {
                $_SESSION['loginErr'][] = $this->errors['loginIsShort'];
            }
            if (strlen($pass) < 6) {
                $_SESSION['loginErr'][] = $this->errors['passIsShort'];
            }
            return !empty($_SESSION['loginErr']);

        } catch (Exception $err){
            $_SESSION['err'][] = $err->getMessage();
            return false;
        }
    }
}
