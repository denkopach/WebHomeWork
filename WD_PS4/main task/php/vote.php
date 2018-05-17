<?php 
	include 'valueForVote.php';

	echo '<div class="task">
		Select your favorite <br>programming language:
		<form method="post">';
	echo '<div class="vote-radio">';
	foreach ($valueForVote as $key => $value) {
		echo '<input type="radio" name="vote" value="' . $key . '" onchange="updateButtonState()">' . $value . '<br>';
	}

	echo '</div><div class="vote-signature">*make your choice';
	echo '<input class="button-vote" type="submit" name="vote-enter" value="Vote">
		</form></div>
		</div>';

	if(addVote()){
		echo '<script type="text/javascript">window.location = "vote-result.php"</script>';
	}

	function addVote(){
		if(isset($_POST['vote-enter'])){

			$filename = 'json/data.json';
			if(file_exists($filename)){
				$file = file_get_contents($filename, true);
				$taskList = json_decode($file,TRUE);
			}
			$taskList[$_POST['vote']] += 1;

			file_put_contents($filename,json_encode($taskList));
			return true;
		}

		return false;
	}
?>