<?php
if ($_POST) {
        $configs = include dirname(__DIR__).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

        if (isset($_POST['btnExt'])) {
            $_SESSION = array();
        }

        if (isset($_POST['userMsg'])) {
            $userMsg = $_POST['userMsg'];   
            try {
                ChatController::addMsg($userMsg);   
            } catch (Exception $err) {
                $_SESSION['err'] = $err->getMessage();
            }
        };

        if (isset($_POST['submitAuth'])) {
            
            Validate::check($_POST['login'], $_POST['pass']);

            if (empty($_SESSION['loginErr'])) {
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                if (isset($login) && isset($pass)) {
                    if (UserController::authorization($login, $pass)) {
                        $_SESSION['auth'] = true;
                        $_SESSION['login'] = $login;
                    }
                };
            }
        }

        if (isset($_POST['updChat'])) {
            echo json_encode(ChatController::getMsg());
            die();
        }
}
header("Location: ./");
