<?php

if(empty($access) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location:/"); 
}
$choise = $_POST['vote'];

if (isset($choise)) {
	$filename = 'json/data.json';
    if (file_exists($filename)) {
    	$taskList = getArrFromJson($filename);
    }
    $taskList[$choise] += 1;
    file_put_contents($filename,json_encode($taskList, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
}

if (isset( $_POST['getVoteRes'])) {
	include 'valueForVote.php';
	$filename = '../json/data.json';

    if (file_exists($filename)) {
    	$arr = getArrFromJson($filename);
        $newArr[0] = ['Programming language', 'Votes'];
        
        foreach ($arr as $key => $value){
            $newArr[] = [$valueForVote[$key], $value];
        }
        $newArr = json_encode($newArr);
        echo $newArr;
    }
}

function getArrFromJson($filename) {
    return json_decode(file_get_contents($filename), true);
}

?>