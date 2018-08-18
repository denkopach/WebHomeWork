<?php
require_once $config['file_check_php'];
require_once $config['poll_php'];

function toChartFormat($json)
{
    $data = json_decode($json, true);
    $keys = array_keys($data);
    $arr = [['Options', 'Votes']];
    foreach ($keys as $key) {
        array_push($arr, [$key, $data[$key]['votes']]);
    }
    return json_encode($arr, JSON_PRETTY_PRINT);
}

function getVotesData($charts)
{
    try {
        checkFile($charts,true);
        $data = file_get_contents($charts);
        checkJson($data);
    } catch (Exception $e) {
        $data = '';
    }
    return $data;

}


