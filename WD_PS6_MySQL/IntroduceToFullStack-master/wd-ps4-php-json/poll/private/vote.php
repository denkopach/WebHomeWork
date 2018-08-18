<?php
require_once $config['poll_php'];
require_once $config['parse_votes_php'];

function voteFor($option, $options, $charts)
{
    if (!in_array($option, $options)) {
        throw new Exception('No such option in poll');
    }

    $data = json_decode(getVotesData($charts), true);


    if (array_key_exists($option, $data)) {
        $data[$option]['votes'] += 1;
    } else {
        $data[$option] = ['votes' => 1];
    }

    file_put_contents($charts, json_encode($data, JSON_PRETTY_PRINT));
}

function checkVoteResults($charts)
{
    return toChartFormat(getVotesData($charts));
}
