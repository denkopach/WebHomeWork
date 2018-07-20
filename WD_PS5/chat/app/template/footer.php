<div class="error">
	<?php 
		if (SHOW_LOGS && isset($_SESSION['err'])):
			foreach ($_SESSION['err'] as $key => $value):
					echo "<p>{$value}</p>";
			endforeach;
		endif;
		$_SESSION['err'] = array();
	?>
</div>
</body>
</html>