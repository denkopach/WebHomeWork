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
    $result = getSumEl([2, 3, 7]);
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
header("Location:../index.php#{$_SESSION['task']}");

function getSumEl($withOutDigits = []) {
    $count = 0;
    for ($i = -1000; $i <= 1000; $i++){
        if (empty($withOutDigits)) {
            $count += $i;
        } else {
            if (in_array(abs($i) % 10, [2, 3, 7])) {
                $count += $i;
            }
        }
    }
    return $count;
}
    
function drawFurTree() {
    for ($line = 1; $line <= 50; $line++) {
        $res .= str_repeat('*', $line) . '<br>';
    }
    return $res;
}

function drawChessboard() {
    $linesAmount = $_POST['task4-lines'];
    $columnsAmount = $_POST['task4-column'];

    if (!checkDigits($linesAmount) || !checkDigits($columnsAmount)) {
        return alarmErrorNum();
    }
    if ($linesAmount > 100 || $columnsAmount > 100) {
        return 'please enter number to 100!';
    }
    for ($column = 0; $column < $columnsAmount; $column++) {
        $res .= '<div class="task4-line">';

        for ($line = 0; $line < $linesAmount; $line++) {
            $even = ($line + $column) % 2 === 0 ? 'even' : '';
            $res .= "<div class='task4-cell {$even}'></div>";
        }

        $res .= '</div>';
    }
    return $res;
}

function sumDigitsNumber() {
    $input = abs($_POST['task5-input']);
    if (!checkDigits($input)) {
        return alarmErrorNum();
    }
    return array_sum(str_split($input));
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

function alarmErrorNum() {
    return '<p class="error">please enter positive integer number!</p>';
}
