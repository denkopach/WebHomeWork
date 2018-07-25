<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location:".$configs->main); 
}
$configs = include __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.php';
$valueForVote = include $configs->valueForVote;
$filename = $configs->data;

if (isset($_POST['vote'])) {
    include $configs->addVote;
    addVote($_POST['vote'], $filename, $valueForVote);
    header("location:".$configs->result);
} elseif (isset($_POST['getVoteRes'])) {
    include $configs->getVote;
    echo getVoteResult($filename, $valueForVote);
}
