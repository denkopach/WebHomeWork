<?php
session_start();

define('PATH_TO_DIR', dirname(__DIR__));
define('PATH_TO_DIR_PUBLIC', PATH_TO_DIR . '\public');
define('PATH_TO_DIR_TEMPLATE', PATH_TO_DIR . '\template');
define('PATH_TO_DIR_TEMPLATE', PATH_TO_DIR . '\application');
define('PATH_TO_DIR_DB', PATH_TO_DIR . '\DB');

return (object) array(
	'voteForm' => PATH_TO_DIR_TEMPLATE . '\voteForm.php',
	'voteResForm' => PATH_TO_DIR_TEMPLATE . '\voteResForm.php',
	'data' => PATH_TO_DIR_DB . '\data.json',
	'valueForVote' => PATH_TO_DIR_DB . '\valueForVote.php',
	'dB' => PATH_TO_DIR_TEMPLATE . '\DB.php'
);