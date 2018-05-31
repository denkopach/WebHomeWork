<?php

if (stristr($_SERVER["PHP_SELF"], "func.php")) {
    header("Location:../index.php");
}
$_SESSION['task'] = $_POST['submit'];
switch ($_SESSION['task']) {
	case 'task1':
		getResultTask1();
		break;
	case 'task2':
		getResultTask2();
		break;
	case 'task3':
		getResultTask3();
		break;
	case 'task4':
		getResultTask4();
		break;
	case 'task5':
		getResultTask5();
		break;
	case 'task6':
		getResultTask6();
		break;
}
function addEllP($res){
	return '<p>' . $res . '</p>';
}

function getResultTask1(){
	$count = 0;

	for ($i = -1000; $i <= 1000; $i++){
		$count += $i;
	}
	
	$_SESSION['result'] = addEllP($count);
}

function getResultTask2(){
	$count = 0;

	for ($i = -1000; $i <= 1000; $i++){
		
		$tmp = abs($i) % 10;
		
		if($tmp === 2 || $tmp === 3 || $tmp === 7){
			$count += $i;
		}
	}

	$_SESSION['result'] = addEllP($count);
}

function getResultTask3(){
	$res = '';
	$line = '';

	for($i = 0; $i < 50; $i++){
		
		for($j = 0; $j < $i; $j++){
			$line .= '*';
		}
		
		$res = $res . $line . '<br>';
		$line = '';
	}
	$_SESSION['result'] = addEllP($res);
}

function getResultTask4(){
	$res = '';
	$lines = $_POST['task4-lines'];
	$column = $_POST['task4-column'];

	if (!checkDigits($lines) || !checkDigits($column)){
		$_SESSION['result'] = alarmError();
	}

	for($i = 0; $i < $column; $i++){
		
		$line = '<div class="task4-line">';
		
		for($j = 0; $j < $lines; $j++){
			
			if(($j + $i) % 2 === 0){
				$line .= '<div class="task4-cell"></div>';
			} else {
				$line .= '<div class="task4-cell even"></div>';
			}
		}
		
		$line .= '</div>';
		
		$res .= $line;
	}
	$_SESSION['result'] = $res;
}

function getResultTask5(){
	$input = $_POST['task5-input'];
	if (!checkDigits($input)){
		$_SESSION['result'] = alarmError();
	}
	$_SESSION['result'] = addEllP(array_sum(str_split((string) abs($input))));
}

function getResultTask6(){
	$arr = array_map(function(){
					return rand( 1, 10);
					}, array_pad( [], 100, 0)
			);

	sort($arr);

	$_SESSION['result'] = array_unique(
			array_reverse($arr)
		);
}

function checkDigits($num){
	return ctype_digit($num) && $num > 0;
}

function alarmError(){
	return '<p class="error">please enter positive integer number!</p>';
}
