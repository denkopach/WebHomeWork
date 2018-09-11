<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validator</title>
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<div class="main">
		<div class="container">
			<form class="validator block-grid block-center" onsubmit="return false;">
				<div class="wrapper">
						<span>Enter IP adress</span>
						<input type="text" name="ip">
						<span class="php-result" name='ip-result'></span>
						<span>Enter url adress</span>
						<input type="text" name="url">
						<span class="php-result" name='url-result'></span>
						<span>Enter email adress</span>
						<input type="text" name="email">
						<span class="php-result" name='email-result'></span>
						<span>Enter date (MM/DD/YYYY)</span>
						<input type="text" name="date">
						<span class="php-result" name='date-result'></span>
						<span>Enter time (HH:MM:SS)</span>
						<input type="text" name="time">
						<span class="php-result" name='time-result'></span>
					<br>
					<input type="submit" name="enter" value="Validate in PHP">
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="script/script.js"></script>
</body>
</html>