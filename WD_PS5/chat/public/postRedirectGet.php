<?php

if ($_POST) {
		define('ROOT', dirname(dirname(__FILE__)));
		$configs = include(ROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'/config.php');

		if (isset($_POST['btnExt'])) {
			$_SESSION = array();
		}

		if (isset($_POST['userMsg'])) {
			$userMsg = $_POST['userMsg'];	
			try {
				ChatController::addMsg($userMsg);	
			} catch (Exception $err) {
				$_SESSION['err'] = $err->getMessage();
			}
		};

		if (isset($_POST['submit-auth'])) {
			if (empty($_POST['login'])) {
				$_SESSION['loginErr'][] = 'введите логин';
			}
			if (empty($_POST['pass'])) {
				$_SESSION['loginErr'][] = 'введите пароль';
			}
			if (empty($_SESSION['loginErr'])) {
				$login = $_POST['login'];
				$pass = $_POST['pass'];
				if (isset($login) && isset($pass)) {
					if (UserController::authorization($login, $pass)) {
						$_SESSION['auth'] = true;
						$_SESSION['login'] = $login;
					}
				};
			}
		}

		if (isset($_POST['updChat'])) {
			function getAllMassege()
			{
				$file = file_get_contents(DB_PATH.DIRECTORY_SEPARATOR.'messages.json');
				return json_decode($file,true);
			}

			$msgObj = array_filter(getAllMassege(), function($val){
				return $val['time'] > time() - 3600;
			});
			echo json_encode($msgObj);
			die();
		}
}
   header("Location: /");
   exit();