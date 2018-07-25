<?php
function addVote($choice, $filename, $valueForVote) {
    global $configs;
    $taskList = [];
    include $configs->FileController;
    if (FileController::checkFileReadable($filename)) {
        $taskList = json_decode(file_get_contents($filename), true);
    }
    if (!isset($valueForVote[$choice])) {
        var_dump($choice);
        throw new Exception('Error! Selection error');
    }
    $taskList[$choice] = isset($taskList[$choice]) ? $taskList[$choice] + 1 : 1;

    if (file_put_contents($filename, json_encode($taskList, JSON_PRETTY_PRINT)) !== false) {
        return true;
    } else {
        throw new Exception('Error! Voice was not added! Error put content!');
    }
}
