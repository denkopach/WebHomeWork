<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location:/"); 
}
$configs = include __DIR__ . '\..\config.php';
$valueForVote = include $configs->valueForVote;
$filename = $configs->data;
$choice = $_POST['vote'];
$getVoteRes = $_POST['getVoteRes'];
if (isset($choice)) {
    include $configs->addVote;
    try {
        addVote($choice, $filename, $valueForVote);
    } catch (Exception $err) {
        echo $_SESSION['err'] = $err;
    }
    header("location:" . $configs->result);
} elseif (isset($getVoteRes)) {
    include $configs->getVote;
    try {
        echo getVoteResult($filename, $valueForVote);
    } catch (Exception $err) {
        echo $_SESSION['err'] = $err;
    }
}
