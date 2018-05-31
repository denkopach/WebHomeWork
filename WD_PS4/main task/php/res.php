<?php

$filename = '../json/data.json';
$choise = $_POST['choise'];

if (isset($choise)) {
    if (file_exists($filename)) {
        $file = file_get_contents($filename, true);
        $taskList = json_decode($file,true);
    }
    
    $taskList[$choise] += 1;
    file_put_contents($filename,json_encode($taskList));
}
include 'valueForVote.php';

if (isset( $_POST['getVoteRes'])) {
    if (file_exists($filename)) {
        $file = file_get_contents($filename);
        $arr = json_decode($file, true);
        $newArr[0] = ['Programming language', 'Votes'];
        
        foreach ($arr as $key => $value){
            $newArr[] = [$valueForVote[$key], $value];
        }
        $newArr = json_encode($newArr);
        echo $newArr;
    }
}
?>