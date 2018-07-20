<?php
if(empty($access)) {
    header("location:/"); 
}
?>
<div class="block-auth">
	<form method="post">
		<span>Enter your name</span>
		<input type="text" name="login">
		<span>Enter your password</span>
		<input type="password" name="pass">
		
		<input type="submit" name="submit-auth" value="Submit">
		<div class="shadow-box">
			<div class="shadow">
			</div>
		</div>
	</form>
	
</div>