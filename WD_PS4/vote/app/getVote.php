<?php
function getVoteResult($filename, $valueForVote) {
    global $configs;
    include $configs->FileController;
    if (!FileController::checkFileWritable($filename)) {
        return false;
    }
    $arr = json_decode(file_get_contents($filename), true);
    $newArr[0] = ['Programming language', 'Votes'];
    foreach ($arr as $key => $value){
        $newArr[] = [$key, $value];
    };
    return json_encode($newArr);
}
