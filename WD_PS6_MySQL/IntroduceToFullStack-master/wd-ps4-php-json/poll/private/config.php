<?php
ini_set('display_errors', 1);
error_reporting(E_NOTICE);
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('PRIVATE_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('PUBLIC_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

return [
    'poll_json' => PRIVATE_PATH . 'json' . DIRECTORY_SEPARATOR . 'pollQuestions.json',
    'poll_php' => PRIVATE_PATH . 'pollQuestions.php',
    'charts_php' => PRIVATE_PATH . 'charts.php',
    'charts_json' => PRIVATE_PATH . 'json' . DIRECTORY_SEPARATOR . 'charts.json',
    'handler_php' => PRIVATE_PATH . 'handler.php',
    'file_check_php' => PRIVATE_PATH . 'fileCheck.php',
    'parse_votes_php' => PRIVATE_PATH . 'parseVotes.php',
    'vote_php' => PRIVATE_PATH . 'vote.php'
];
