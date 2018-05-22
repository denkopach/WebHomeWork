<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css">
	<?php
		$result = '';

		if(isset($_POST['Enter'])){
			include_once 'php/func.php';
			$buttonValue = $_POST['Enter'];
		 
			switch ($buttonValue) {
				case 'submit-task1':
					$result = getResultTask1();
					break;
				case 'submit-task2':
					$result = getResultTask2();
					break;
				case 'submit-task3':
					$result = getResultTask3();
					break;
				case 'submit-task4':
					$result = getResultTask4();
					break;
				case 'submit-task5':
					$result = getResultTask5();
					break;
				case 'submit-task6':
					$result = getResultTask6();
					break;
			}
		}

	?>
</head>
<body>
	<div class="conteiner">
		<div class="task">
			<h2>Task1</h2>
			<p>Let's calculate the sum of numbers between -1000 to 1000</p>
			<form method="post">
				<input type="submit" value="submit-task1" name="Enter">
				<? 
					if($buttonValue === "submit-task1"){
						echo $result;
					}
				?>
			</form>
		</div>

		<div class="task">
			<h2>Task2</h2>
			<p>Let's calculate the sum of numbers between -1000 to 1000 which end in 2, 3, 7</p>
			<form method="post">
				<input type="submit" value="submit-task2" name="Enter">
				<? 
					if($buttonValue === "submit-task2"){
						echo $result;
					}
				?>
			</form>
		</div>

		<div class="task">
			<h2>Task3</h2>
			<p>Let's construct a triangle of asterisks of 50 lines</p>
			<form method="post">
				<input type="submit" value="submit-task3" name="Enter">
				<div class="triangle">
					<? 
						if($buttonValue === "submit-task3"){
							echo $result;
						}
					?>
				</div>
			</form>
		</div>

		<div class="task">
			<h2>Task4</h2>
			<p>Let's draw a chessboard</p>

			<form method="post">
				<input type="number" name="task4-lines" size="4">
				x
				<input type="number" name="task4-column" size="4">
				<input type="submit" value="submit-task4" name="Enter">
				<div class="chessboard">
					<? 
						if($buttonValue === "submit-task4"){
							echo $result;
						}
					?>
				</div>
			</form>
		</div>

		<div class="task">
			<h2>Task5</h2>
			<p>Let's find the sum of the digits of the entered number</p>
			<form method="post">
				<input type="number" name="task5-input">
				<input type="submit" value="submit-task5" name="Enter">
				<? 
					if($buttonValue === "submit-task5"){
						echo $result;
					}
				?>	
			</form>
		</div>

		<div class="task">
			<h2>Task6</h2>
			<p>Generate an array of random integers from 1 to 10, the length of the array is 100. Remove the repetitions from the array, sort and revert</p>
			<form method="post">
				<input type="submit" value="submit-task6" name="Enter">
				<p>
					<? 
					if($buttonValue === "submit-task6"){
						print_r($result);
					}
				?>
				</p>
			</form>
		</div>
	</div>
</body>
</html>