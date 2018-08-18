<?php
session_start();
$config = require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'config.php';
require_once $config['poll_php'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Title</title>
    <link rel='stylesheet' href='css/main.css'>
</head>
<body>
<section class='main'>
    <?php if (isset($_SESSION['exception'])): ?>
        <div class='error'>
            <span class="error-msg"><?= $_SESSION['exception'] ?></span>
            <img src="https://media.giphy.com/media/FxEwsOF1D79za/giphy.gif" alt="Barack">
        </div>
    <?php else : ?>
        <form action='php/handler.php' method='post' id='poll-form'>
            <div class='row'><h2><?= $question ?></h2></div>
            <div class='row'>
                <?php
                foreach ($options as $optionId => $option) : ?>
                    <div class='col'>
                        <label for='value<?= $optionId ?>'><?= $option ?></label>
                        <input type='radio' id='value<?= $optionId ?>' name='value' value='<?= $option ?>'>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class='row'>
                <input type='submit' id='submit-btn' name='submit-btn' class='submit-btn' value='Send'>
            </div>
        </form>
    <?php
    endif;
    session_destroy(); ?>

</section>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='js/script.js'></script>
</body>
</html>

