<?php

$filename = $configs->data;

$choise = $_POST['vote'];
$getVoteRes = $_POST['getVoteRes'];


if (isset($choise)) {
    if (checkFile($filename)) {
    	$taskList = getArrFromJson($filename);
    }
    $taskList[$choise] += 1;
    file_put_contents($filename,json_encode($taskList, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    $root = $_SERVER['DOCUMENT_ROOT'];
    header( 'Location: ../result.php', true);
}

if (isset($getVoteRes)) {
	$valueForVote = include($configs->valueForVote);
    if (checkFile ($filename)) {
        $arr = getArrFromJson($filename);
        $newArr[0] = ['Programming language', 'Votes'];
        foreach ($arr as $key => $value){
            $newArr[] = [$valueForVote[$key], $value];
        };
        $newArr = json_encode($newArr);
        echo $newArr;
    }
}

function getArrFromJson ($filename) {
    return json_decode(file_get_contents($filename), true);
}

function checkFile ($file) {
    try {
        if (!file_exists($file)) {
            throw new Exception('file does not exist');
        } elseif (!is_writable($file)) {
            throw new Exception('file is not writable');
        } else {
            return true;
        }
    } catch (Exception $err){
        return false;
    }
}