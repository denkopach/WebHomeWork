<?php
$configs = include(__DIR__ . '/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Голосование</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <div class="block-vote">
        <div class="task">
            Select your favorite <br>programming language:
            <form method="post" action="php/getDB.php">
                <div class="vote-radio">
                    <?php
                    $valueForVote = include $configs->valueForVote;
                    foreach ($valueForVote as $key => $value) {
                        $checked = ($key === 'contactChoice1') ? ' checked' : '';
                        echo '<input type="radio" name="vote" value="' . $key . '"' . $checked . '>' . $value . '<br>';
                    }
                    ?>
                </div>
                <div class="vote-signature">*make your choice</div>
                <div class="button submit" onclick="this.parentNode.submit();">&nbsp;Submit&nbsp;</div>
            </form>
        </div>
    </div>
</body>
</html>
