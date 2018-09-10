<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

$dataPath = 'data.json';

if (isset($_POST['getAllMsg'])) {
    if (file_exists($dataPath) && !is_readable($dataPath)) {
        http_response_code(400);
        echo 'ERROR! File is not readable';
        return;
    } if (file_exists($dataPath)) {
        $allMsg = json_decode(file_get_contents($dataPath), true);
    } else {
        $allMsg = [];
    }
    $allMsg = array_filter($allMsg, function($msg){
            return $msg['isDel'] != 1;
        });
    echo json_encode(
            $allMsg, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    die();
}

if (isset($_POST['msg'])) {
    if (file_exists($dataPath)){
        $allMsgs = json_decode(file_get_contents($dataPath), true);
    } else {
        $allMsgs = [];
    }
    $msgExist = false;
    $msgTmp = [
        'msg' => $_POST['msg'],
        'id' => $_POST['id'],
        'offsetX' => $_POST['offsetX'],
        'offsetY' => $_POST['offsetY'],
        'isDel' => $_POST['isDel']
    ];
    foreach ($allMsgs as $index => $msg) {
        if ($msg['id'] === $_POST['id']) {
            $allMsgs[$index] = $msgTmp;
            $msgExist = true;
        }
    }
    if (!$msgExist) {
        $allMsgs[] = $msgTmp;
    }
    if (!file_put_contents($dataPath,json_encode(
            $allMsgs, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT))) {
        http_response_code(400);
        echo 'ERROR! File with data can not be created or edit';
    }
    die();
}
header('Location: ..' . DIRECTORY_SEPARATOR .'index.html');
