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
		<?php
			include $configs->voteResForm;
		?>
	</div>
</body>
</html>