<?php
session_start();
$config = require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "config.php";

$charts = $config['charts_json'];

if (isset($_POST['value'])) {
    require_once $config['vote_php'];
    try {
        voteFor($_POST['value'], $options, $charts);
        header('Location: ../result.php');
    } catch (Exception $e) {
        $_SESSION['exception'] = $e->getMessage();
        header('Location: ../index.php');
    }
}
