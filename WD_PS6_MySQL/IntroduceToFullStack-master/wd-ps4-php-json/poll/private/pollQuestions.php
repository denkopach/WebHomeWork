<?php
require_once $config['file_check_php'];

try {
    checkFile($config['poll_json']);

    $fileData = file_get_contents($config['poll_json']);

    checkJson($fileData);
    $decodedJson = json_decode($fileData, true);
    $question = $decodedJson["question"];
    $options = $decodedJson["options"];
} catch (Exception $e) {
    $_SESSION['exception'] = $e->getMessage();
}