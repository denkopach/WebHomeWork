<?php
function getVoteResult($filename, $valueForVote) {
    if (!file_exists($filename)) {
        throw new Exception('Error! Error of access to voting results');
    }
    $arr = json_decode(file_get_contents($filename), true);
    $newArr[0] = ['Programming language', 'Votes'];
    foreach ($arr as $key => $value){
        $newArr[] = [$valueForVote[$key], $value];
    };
    return json_encode($newArr);
}
