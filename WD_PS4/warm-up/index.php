<?php
session_start(); 
ini_set('display_errors',1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="conteiner">
        <div class="task" id='task1'>
            <h2>Task1</h2>
            <p>Let's calculate the sum of numbers between -1000 to 1000</p>
            <form method="post" action="php/func.php">
                <input type="hidden" value="task1" name="submit">
                <input type="submit" value="Enter" name="Enter">
                <p class="result">
                    <?php
                    if (isset($_SESSION['task']) && $_SESSION['task'] === 'task1') {
                        echo $_SESSION['result'];
                    }
                    ?>
                </p>
            </form>
        </div>

        <div class="task" id='task2'>
            <h2>Task2</h2>
            <p>Let's calculate the sum of numbers between -1000 to 1000 which end in 2, 3, 7</p>
            <form method="post" action="php/func.php">
                <input type="hidden" value="task2" name="submit">
                <input type="submit" value="Enter" name="Enter">
                <p class="result">
                    <?php 
                    if (isset($_SESSION['task']) && $_SESSION['task'] === 'task2') {
                        echo $_SESSION['result'];
                    }
                    ?>
                </p>
            </form>
        </div>

        <div class="task" id='task3'>
            <h2>Task3</h2>
            <p>Let's construct a triangle of asterisks of 50 lines</p>
            <form method="post" action="php/func.php">
                <input type="hidden" value="task3" name="submit">
                <input type="submit" value="Enter" name="Enter">
                <div class="triangle">
                    <?php 
                    if (isset($_SESSION['task']) && $_SESSION['task'] === 'task3') {
                        echo $_SESSION['result'];
                    }
                    ?>
                </div>
            </form>
        </div>

        <div class="task" id='task4'>
            <h2>Task4</h2>
            <p>Let's draw a chessboard</p>

            <form method="post" action="php/func.php">
                <input type="number" name="task4-lines" size="4">
                x
                <input type="number" name="task4-column" size="4">
                <input type="hidden" value="task4" name="submit">
                <input type="submit" value="Enter" name="Enter">
                <div class="chessboard">
                    <?php 
                    if (isset($_SESSION['task']) && $_SESSION['task'] === 'task4') {
                        echo $_SESSION['result'];
                    }
                    ?>
                </div>
            </form>
        </div>

        <div class="task" id='task5'>
            <h2>Task5</h2>
            <p>Let's find the sum of the digits of the entered number</p>
            <form method="post" action="php/func.php">
                <input type="number" name="task5-input">
                <input type="hidden" value="task5" name="submit">
                <input type="submit" value="Enter" name="Enter">
                <p class="result">
                    <?php 
                    if (isset($_SESSION['task']) && $_SESSION['task'] === 'task5') {
                        echo $_SESSION['result'];
                    }
                    ?>
                </p>
            </form>
        </div>

        <div class="task" id='task6'>
            <h2>Task6</h2>
            <p>Generate an array of random integers from 1 to 10, the length of the array is 100. Remove the repetitions from the array, sort and revert</p>
            <form method="post" action="php/func.php">
                <input type="hidden" value="task6" name="submit">
                <input type="submit" value="Enter" name="Enter">
                <p class="result">
                    <?php 
                    if (isset($_SESSION['task']) && $_SESSION['task'] === 'task6') {
                        print_r($_SESSION['result']);
                    } 
                    session_destroy();
                    ?>
                </p>
            </form>
        </div>
    </div>
</body>
</html>