<?php
if(empty($access)) {								//attempt to access the file directly
    header("location:/"); 
} else if (isset($_POST['btmExt'])) { 				//logout
	session_destroy();
	include 'php/login-block.php';
} else if (authIsTrue() || $_SESSION['user']) { 	//authorized
	include 'php/chat-block.php';
	include 'php/updChat.php';
} else {											//an exception
	include 'php/login-block.php';
}

function authIsTrue() {
	$login = $_POST['login'];
	$pass = $_POST['pass'];

	if (!isset($login) || !isset($pass)) {
		return false;
	}
	$filename = 'json/login.json';
	if (file_exists($filename)) {
		$file = file_get_contents($filename);
		$arr = json_decode($file, true);
		if ($arr[$login] && $arr[$login] === $pass) {
			$_SESSION['user'] = $login;
			return true;
		} if (!$arr[$login]) {
			$arr[$login] = $pass;
			file_put_contents($filename,json_encode($arr));
			$_SESSION['user'] = $login;
			return true;
		} if ($arr[$login] && $arr[$login] !== $pass) {
			echo "<script>alert(\"Неверный логин/пароль\");</script>"; 
			return false;
		} else {
			return false;
		}
	} else {
		$userLogin[$login] = $pass;
		$fp = fopen($filename, "w");
		fwrite($fp, json_encode($userLogin));
		fclose($fp);
		$_SESSION['user'] = $login;
		return true;
	}
}