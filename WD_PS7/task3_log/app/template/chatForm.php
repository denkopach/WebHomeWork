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
            <input type="button" name="btnMsg" value=" Send " class="send-message-btn">
        </form>
        <form method="post">
            <input type="button" name="btnExt" value="Logout" class="exit-btn">
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>