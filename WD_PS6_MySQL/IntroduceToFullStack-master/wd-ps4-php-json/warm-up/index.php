<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">

    <div class="exception">
        <?php
        if (isset($_SESSION['exception'])) {
            echo $_SESSION['exception'];
        }
        ?>
    </div>
    <!--Task1-->
    <div class="row" id="task1">
        <p class="task"> Task 1</p>
        <form method="post" action="model.php">
            <input type="hidden" name="task" value="task1">
            <label for="submit">Sum of numbers from -1000 to 1000<br></label>
            <input type="submit" name="submit" value="Show result">
        </form>
        <div class="result">
            <?php
            if ($_SESSION['task'] === 'task1' && isset($_SESSION['result'])) {
                echo $_SESSION['result'];
            }
            ?>
        </div>
    </div>

    <!--Task2-->
    <div class="row" id="task2">

        <p class="task"> Task 2</p>
        <form action="model.php" method="post">
            <input type="hidden" name="task" value="task2">
            <label for="submit">Sum of numbers from -1000 to 1000 ending on 2,3,7 <br></label>
            <input type="submit" name="submit" value="Show result">
        </form>
        <div class="result">
            <?php
            if ($_SESSION['task'] === 'task2' && isset($_SESSION['result'])) {
                echo $_SESSION['result'];
            }
            ?>
        </div>
    </div>

    <!--Task3-->
    <div class="row" id="task3">
        <div class="col">
            <p class="task"> Task 3</p>
            <form action="model.php" method="post">
                <input type="hidden" name="task" value="task3">
                <label for="submit">List of 50 '*'<br></label>
                <input type="submit" name="submit" value="Show result">
            </form>
            <div class="result">
                <?php
                if ($_SESSION['task'] === 'task3' && isset($_SESSION['result'])) {
                    echo $_SESSION['result'];
                }
                ?>
            </div>
        </div>
    </div>

    <!--Task4-->
    <div class="row" id="task4">
        <div class="col">
            <p class="task"> Task 4</p>
            <form action="model.php" method="post">
                <input type="hidden" name="task" value="task4">
                <label for="height">Enter chessboard height:</label>
                <input type="text" id="height" name="height">
                <label for="width">Enter chessboard width:</label>
                <input type="text" id="width" name="width">
                <input type="submit" name="submit" value="Show result">
            </form>
            <?php
            if (isset($_SESSION['error']) && $_SESSION['task'] === 'task4'): ?>
                <div class="error">
                    <?= $_SESSION['error'] ?>
                </div>
                <?php
            elseif ($_SESSION['task'] === 'task4' && isset($_SESSION['result'])) : ?>
                <div class="result">
                    <?= $_SESSION['result'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!--Task5-->
    <div class="row" id="task5">
        <div class="col">
            <p class="task"> Task 5</p>
            <form action="model.php" method="post">
                <input type="hidden" name="task" value="task5">
                <label for="number"> Enter number:</label>
                <input type="text" id="number" name="number">
                <input type="submit" name="submit" value="Show result">
            </form>
            <?php
            if (isset($_SESSION['error']) && $_SESSION['task'] === 'task5'): ?>
                <div class="error">
                    <?= $_SESSION['error'] ?>
                </div>
                <?php
            elseif ($_SESSION['task'] === 'task5' && isset($_SESSION['result'])) : ?>
                <div class="result">
                    <?= $_SESSION['result'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!--Task6-->
    <div class="row" id="task6">
        <p class="task"> Task 6</p>
        <form action="model.php" method="post">
            <input type="hidden" name="task" value="task6">
            <input type="submit" name="submit" value="Show result">
        </form>
        <?php
        if (isset($_SESSION['error']) && $_SESSION['task'] === 'task6'): ?>
            <div class="error">
                <?= $_SESSION['error'] ?>
            </div>
            <?php
        elseif ($_SESSION['task'] === 'task6' && isset($_SESSION['result'])) : ?>
            <div class="result">
                <?= $_SESSION['result'] ?>
            </div>
            <?php
        endif;
        session_destroy();
        ?>
    </div>
</div>
</body>
</html>

