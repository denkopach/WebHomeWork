<?php
session_start();
if (isset($_POST['task'], $_POST['submit'])) {
    $_SESSION['task'] = $_POST['task'];
    switch ($_SESSION['task']) {
        case 'task1':
            task1();
            break;
        case 'task2':
            task2();
            break;
        case 'task3':
            task3();
            break;
        case 'task4':
            task4();
            break;
        case 'task5':
            task5();
            break;
        case 'task6':
            task6();
            break;
        default:
            $_SESSION['exception'] = "No function found for {$_SESSION['task']}";
    }
}
header("Location: index.php#{$_SESSION['task']}");

function task1()
{
    $sum = 0;
    for ($i = -1000; $i <= 1000; $i++) {
        $sum += $i;
    }
    return $_SESSION['result'] = $sum . ' ';
}

function task2()
{
    $sum = 0;
    for ($i = -1000; $i <= 1000; $i++) {
        $temp = abs($i);
        if ($temp === 2 || $temp === 3 || $temp === 7) {
            $sum += $i;
        }
    }
    return $_SESSION['result'] = $sum . ' ';
}

function task3()
{
    $temp = '';
    $asterisk = '*';
    for ($i = 0; $i <= 50; $i++) {
        $temp .= '<li>' . str_repeat($asterisk, $i) . '</li>';
    }

    return $_SESSION['result'] = '<ul>' . $temp . '</ul>';
}

function task4()
{
    $regex = '/^[1-9][0-9]*$/';
    $temp = '';
    if (strlen($_POST['height']) === 0 || strlen($_POST['width']) === 0) {
        return $_SESSION['error'] = "You need to enter both width and height";
    }

    if (!preg_match($regex, $_POST['height']) || !preg_match($regex, $_POST['width'])) {
        return $_SESSION['error'] = "Only positive number without '-' or '+' signs allowed (not including 0 )";
    }

    $height = intval($_POST['height']);
    $width = intval($_POST['width']);

    if ($height > 60 || $width > 60) {
        return $_SESSION['error'] = "Chessboard only allow these sizes : height - 60, width - 60";
    }

    for (; $height > 0; $height--) {
        $temp .= '<tr>';
        for ($j = 0; $j < $width; $j++) {
            $temp .= ($height + $j) % 2 != 0 ? '<td class="black"></td>' : '<td></td>';
        }
        $temp .= '</tr>';
    }
    return $_SESSION['result'] = '<table class="chessboard">' . $temp . '</table>';
}

function task5()
{

    if (!is_numeric($_POST['number'])) {
        return $_SESSION['error'] = "Only numbers allowed";
    }


    $num = $_POST['number'];
    $sum = 0;
    for ($i = 0; $i < strlen($num); $i++) {
        $sum += $num[$i];
    }
    return $_SESSION['result'] = $sum;
}

function task6()
{
    $arr = [];
    for ($i = 0; $i < 100; $i++) {
        array_push($arr, mt_rand(0, 10));
    }

    $arr = array_unique(array_reverse($arr));
    arsort($arr);
    return $_SESSION['result'] = print_r($arr, true);
}
