<?php

if (stristr($_SERVER["PHP_SELF"], "func.php")) {
    header("Location:../index.php");
}
session_start(); 
$_SESSION['task'] = $_POST['submit'];
$result;
switch ($_SESSION['task']) {
    case 'task1':
    $result = getSumEl();
    break;
case 'task2':
    $result = getSumElWithOut237();
    break;
case 'task3':
    $result = drawFurTree();
    break;
case 'task4':
    $result = drawChessboard();
    break;
case 'task5':
    $result = sumDigitsNumber();
    break;
case 'task6':
    $result = arrayOperations();
    break;
}
$_SESSION['result'] = $result;

header("Location:../index.php");

function addEllP($res) {
    return '<p>' . $res . '</p>';
}

function getSumEl() {
    $count = 0;
    for ($i = -1000; $i <= 1000; $i++){
        $count += $i;
    }
    return addEllP($count);
}

function getSumElWithOut237() {
    $count = 0;

    for ($i = -1000; $i <= 1000; $i++) {
        
        $tmp = abs($i) % 10;
        
        if ($tmp === 2 || $tmp === 3 || $tmp === 7) {
            $count += $i;
        }
    }

    return addEllP($count);
}
    
function drawFurTree() {
    $res = '';
    $line = '';

    for ($i = 1; $i <= 50; $i++) {
        
        for ($j = 1; $j <= $i; $j++) {
            $line .= '*';
        }
        
        $res = $res . $line . '<br>';
        $line = '';
    }
    return addEllP($res);
}

function drawChessboard() {
    $res = '';
    $lines = $_POST['task4-lines'];
    $column = $_POST['task4-column'];

    if (!checkDigits($lines) || !checkDigits($column)) {
        $_SESSION['result'] = alarmError();
    }

    for ($i = 0; $i < $column; $i++) {
        
        $line = '<div class="task4-line">';
        
        for ($j = 0; $j < $lines; $j++) {
            
            if (($j + $i) % 2 === 0) {
                $line .= '<div class="task4-cell"></div>';
            } else {
                $line .= '<div class="task4-cell even"></div>';
            }
        }
        
        $line .= '</div>';
        
        $res .= $line;
    }
    return $res;
}

function sumDigitsNumber() {
    $input = $_POST['task5-input'];
    if (!checkDigits($input)) {
        $_SESSION['result'] = alarmError();
    }
    return addEllP(array_sum(str_split((string) abs($input))));
}

function arrayOperations() {
    $arr = array_map(function() {
            return rand( 1, 10);
        }, array_pad( [], 100, 0)
    );

    sort($arr);

    return array_unique(
            array_reverse($arr)
        );
}

function checkDigits($num) {
    return ctype_digit($num) && $num > 0;
}

function alarmError() {ы
    return '<p class="error">please enter positive integer number!</p>';
}
