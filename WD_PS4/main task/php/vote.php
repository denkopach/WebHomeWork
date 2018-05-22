<?php

	include 'valueForVote.php';

	foreach ($valueForVote as $key => $value) {
		echo '<input type="radio" name="vote" value="' . $key . '">' . $value . '<br>';
	}
?>