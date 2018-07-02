<?php
function addVote($choice, $filename, $valueForVote) {
    if (file_exists($filename)) {
        $taskList = json_decode(file_get_contents($filename), true);
    }
    if (!isset($valueForVote[$choice])) {
        throw new Exception('Error! Selection error');
    }
    $taskList[$choice] += 1;
    if (file_put_contents(filename, data)($filename, json_encode($taskList, JSON_PRETTY_PRINT)) !== false) {
        return true;
    } else {
        throw new Exception('Error! Voice was not added');
    }
}
