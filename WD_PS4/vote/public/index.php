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
            <form method="post" action=<?= $configs->handler ?>>
                <div class="vote-radio">
                    <?php
                    $valueForVote = include $configs->valueForVote;
                    $isFirst = true;
                    foreach ($valueForVote as $key => $value):
                        $checked = ($isFirst) ? ' checked' : '';
                    ?>
                        <input 
                            type="radio"
                            name="vote" 
                            value= <?= $value ?>  
                            <?= $checked ?>
                        >   <?= $value ?>   <br>
                        
                    <?php
                        $isFirst = false;   
                        endforeach;
                    ?>
                </div>
                <div class="vote-signature">*make your choice</div>
                <div class="button submit" onclick="this.parentNode.submit();">&nbsp;Submit&nbsp;</div>
                <div class='err-msg'>
                    <?php
                        if (!empty($_SESSION['err'])) {
                            print_r($_SESSION['err']);
                            $_SESSION['err'] = [];
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
