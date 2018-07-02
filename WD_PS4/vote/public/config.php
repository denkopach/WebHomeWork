<?php
session_start();
//enable error logging
define('LOGGING', true);
//catalog paths
define('PATH_TO_DIR', dirname(__DIR__));
define('PATH_TO_DIR_PUBLIC', PATH_TO_DIR . '\public');
define('PATH_TO_DIR_APP', PATH_TO_DIR . '\app');
define('PATH_TO_DIR_TEMPLATE', PATH_TO_DIR_APP . '\template');
define('PATH_TO_DIR_DB', PATH_TO_DIR_APP . '\dB');
//file paths
return (object) array(
    'voteForm' => PATH_TO_DIR_TEMPLATE . '\voteForm.php',
    'voteResForm' => PATH_TO_DIR_TEMPLATE . '\voteResForm.php',
    'data' => PATH_TO_DIR_DB . '\data.json',
    'valueForVote' => PATH_TO_DIR_DB . '\valueForVote.php',
    'dB' => PATH_TO_DIR_APP . '\dB.php',
    'addVote' => PATH_TO_DIR_APP . '\addVote.php',
    'getVote' => PATH_TO_DIR_APP . '\getVote.php',
    'main' => '/',
    'result' => '/result.php',
);
