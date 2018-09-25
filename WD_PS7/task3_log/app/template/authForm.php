<div class="block-auth">
    <form method="post" action="postRedirectGet.php">
        <label>Enter your name</label>
        <input type="text" name="login">
        <label>Enter your password</label>
        <input type="password" name="pass">
        <div class="error">
            <?php if (isset($_SESSION['loginErr'])): ?>
                    <?php foreach ($_SESSION['loginErr'] as $key => $value): ?>
                            <p><?= $value ?></p>
                    <?php endforeach;
                endif;
                $_SESSION['loginErr'] = array(); ?>
        </div>
        <input type="submit" name="submitAuth" value="Submit">
        <div class="shadow-box">
            <div class="shadow"></div>
        </div>
    </form>
</div>
