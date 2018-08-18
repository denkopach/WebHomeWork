<?php

function checkFile($filename, $fileWriteCheck = false)
{
    if (!file_exists($filename) || filesize($filename) == 0) {
        throw new Exception("File is empty or doesn't exist");
    } else if (!file_get_contents($filename)) {
        throw new Exception('Cannot read file');
    }
    if ($fileWriteCheck && !is_writable($filename)) {
        throw new Exception('Cannot write to file');
    }
}

function checkJson($string)
{
    if (json_decode($string) == null) {
        throw new Exception('Invalid json');
    }

}