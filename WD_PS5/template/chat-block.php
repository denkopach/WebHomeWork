<?php 
if(empty($access)) {
    header("location:/"); 
}
?>
<div class="block-auth">
	<div class="block-chat">
		<div class="block-msg-windows" >
			
		</div>
		<form class="formChat" method="post">
			<input type="text" name="userMsg" class="userMsg">
			<input type="button" name="btmMsg" value=" Send " class="btmMsg">
			<input type="submit" name="btmExt" value="Logout">
		</form>

	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/script.js"></script>