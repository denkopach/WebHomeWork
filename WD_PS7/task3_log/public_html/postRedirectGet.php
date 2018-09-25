<?php
if ($_POST) {
    $configs = include dirname(__DIR__).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

    if (isset($_POST['btnExt'])) {
        $_SESSION = array();
        $res['log'] = Logger::log('INFO', 'user logout', 'exit');
    }

    if (isset($_POST['userMsg'])) {
        $userMsg = $_POST['userMsg'];   
        try {
            ChatController::addMsg($userMsg);
            $res['log'] = Logger::log("INFO", 'addMsg succes', "addMsg");
        } catch (Exception $err) {
            $_SESSION['err'] = $err->getMessage();
            $res['log'] = Logger::log("INFO", $err->getMessage(), "addMsg");
        }
    }

    if (isset($_POST['submitAuth'])) {
        Validate::check($_POST['login'], $_POST['pass']);
        if (empty($_SESSION['loginErr'])) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            if (isset($login) && isset($pass)) {
                $UserController = new UserController;
                if ($UserController->authorization($login, $pass)) {
                    $_SESSION['auth'] = true;
                    $_SESSION['login'] = $login;
                    Logger::log("INFO", 'loggin succes', "auth");
                }
            }
        }
        if (!isset($res['log'])) {  
            Logger::log("INFO", 'loggin false', "auth");
        }
    }

    if (isset($_POST['updChat'])) {
        try {
            $res['data'] = ChatController::getMsg($_POST['lastId']);
            $res['log'] = Logger::log("INFO", "receive all messages", "updChat");
        } catch (Exception $err){
            $res['log'] = Logger::log("ERROR", $err->getMessage(), "updChat");
            $_SESSION['err'][] = $err->getMessage();
        }
    }
    if (isset($res['log'])) {
        echo json_encode($res);
        die();
    }
}
header("Location: ./");
