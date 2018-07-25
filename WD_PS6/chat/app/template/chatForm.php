<div class="block-auth">
    <div class="block-chat">
        <?php
        if (isset($_SESSION["login"])) :
            ?>
            <div class="greeting">Hello, <?= $_SESSION["login"] ?>!</div>
        <?php endif; ?>
        <div class="block-msg-windows" >
        </div>
        <form class="formChat" method="post">
            <input type="text" name="userMsg" class="userMsg">
            <input type="button" name="btnMsg" value=" Send " class="btnMsg">
        </form>
        <form method="post" action="postRedirectGet.php">
            <input type="submit" name="btnExt" value="Logout">
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/script.js"></script>