<?php

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location:/"); 
}

$configs = include($_SERVER['DOCUMENT_ROOT'] . '\config.php');

include $configs->dB;