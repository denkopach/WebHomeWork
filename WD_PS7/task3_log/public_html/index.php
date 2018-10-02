<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

$path = require_once(dirname(__DIR__).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

require_once(APP_PATH.DIRECTORY_SEPARATOR.'Autoload.php');

Configs::setPath($path);

if (!$_POST) {
    $siteController = new SiteController();
    $siteController->actionIndex();
    return;
}

$logger = new Logger();

if (isset($_POST['btnExt'])) {
    $_SESSION = array();
    $res['log'] = $logger->log('INFO', 'user logout', 'exit');
}

if (isset($_POST['userMsg'])) {
    $userMsg = $_POST['userMsg'];
    try {
        $chatController = new ChatController();
        if ($chatController->addMsg($userMsg)) {
            $res['log'] = $logger->log("INFO", 'addMsg succes', "addMsg");
        } else {
            $res['log'] = $logger->log("ERROR", 'addMsg false', "addMsg");
        }

    } catch (Exception $err) {
        $_SESSION['err'] = $err->getMessage();
        $res['log'] = $logger->log("INFO", $err->getMessage(), "addMsg");
    }
}

if (isset($_POST['submitAuth'])) {
    $validate = new Validate();
    $validate->check($_POST['login'], $_POST['pass']);
    if (empty($_SESSION['loginErr'])) {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        if (isset($login) && isset($pass)) {
            $userController = new UserController();
            if ($userController->authorization($login, $pass)) {
                $_SESSION['auth'] = true;
                $_SESSION['login'] = $login;
                $logger->log("INFO", 'loggin succes', "auth");
            }
        }
    }
    if (!isset($res['log'])) {
        $logger->log("INFO", 'loggin false', "auth");
    }
}

if (isset($_POST['updChat'])) {
    try {
        $chatController = new ChatController();
        $res['data'] = $chatController->getMsg($_POST['lastId']);
        $res['log'] = $logger->log("INFO", "receive all messages", "updChat");
    } catch (Exception $err){
        $res['log'] = $logger->log("ERROR", $err->getMessage(), "updChat");
        $_SESSION['err'][] = $err->getMessage();
    }
}
if (isset($res['log'])) {
    echo json_encode($res);
    die();
}
header("Location: ".$_SERVER['PHP_SELF']);
