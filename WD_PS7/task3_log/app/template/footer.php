<div class="error">
    <?php 
        if (SHOW_LOGS && isset($_SESSION['err'])):
            foreach ($_SESSION['err'] as $key => $value): ?>
                    <p><?= $value; ?></p>
            <?php endforeach;
        endif;
        $_SESSION['err'] = array();
    ?>
</div>
</body>
</html>