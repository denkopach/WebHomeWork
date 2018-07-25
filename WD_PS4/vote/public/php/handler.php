<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location:".$configs->main); 
}
$configs = include __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.php';
$valueForVote = include $configs->valueForVote;
$filename = $configs->data;
if (isset($_POST['vote'])) {
    include $configs->addVote;
    try {
        addVote($_POST['vote'], $filename, $valueForVote);
    }
    catch(Exception $err) {
        $_SESSION['err'][] = $err->getMessage();
    }
    header("location:".$configs->result);
} elseif (isset($_POST['getVoteRes'])) {
    include $configs->getVote;
    try {
        echo getVoteResult($filename, $valueForVote);
    }
    catch(Exception $err) {
        $_SESSION['err'][] = $err->getMessage();
    }
} else {
    $_SESSION['err'][] = 'Voting error. try again';
    header("location:".$configs->main); 
}
