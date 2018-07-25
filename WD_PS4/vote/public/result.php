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
        <div id="piechart" class="pie-chart">
            
        </div>
        <div class="button back" onclick="javascript:document.location.href='index.php'">&nbsp;Back&nbsp;</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <div class='err-msg'>
            <?php
                if (!empty($_SESSION['err'])) {
                    print_r($_SESSION['err']);
                    $_SESSION['err'] = [];
                }
            ?>
        </div>

    </div>
</body>
</html>
