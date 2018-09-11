<?php

class Validate
{
    static function check($name, $pass)
    {
        global $configs;
        $errors = include $configs->error;
        try {
            if (empty($name)) {
                $_SESSION['loginErr'][] = $errors['loginIsEmpty'];
            }
            if (empty($pass)) {
                $_SESSION['loginErr'][] = $errors['passIsEmpty'];
            }
            if (!empty($_SESSION['loginErr'])) {
                return false;
            }
            if (strlen($name) < 2) {
                $_SESSION['loginErr'][] = $errors['loginIsShort'];
            }
            if (strlen($pass) < 6) {
                $_SESSION['loginErr'][] = $errors['passIsShort'];
            }
            return !empty($_SESSION['loginErr']);

        } catch (Exception $err){
            $_SESSION['err'][] = $err->getMessage();
            return false;
        }
    }
}
