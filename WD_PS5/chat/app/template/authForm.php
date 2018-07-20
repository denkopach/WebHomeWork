<div class="block-auth">
	<form method="post" action="postRedirectGet.php">
		<span>Enter your name</span>
		<input type="text" name="login">
		<span>Enter your password</span>
		<input type="password" name="pass">
		<div class="error">
			<?php 
				if (isset($_SESSION['loginErr'])):
					foreach ($_SESSION['loginErr'] as $key => $value):
							echo "<p>{$value}</p>";
					endforeach;
				endif;
				$_SESSION['loginErr'] = array();
			?>
		</div>
		<input type="submit" name="submit-auth" value="Submit">
		<div class="shadow-box">
			<div class="shadow">
			</div>
		</div>
	</form>
</div>
