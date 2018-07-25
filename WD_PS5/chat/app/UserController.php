<?php

class UserController
{	

	static function authorization($login, $pass) {
		try {
			if (!UserController::checkName($login)) {
				$_SESSION['loginErr'][] = 'логин должен быть два или более символов';
			}
			if (!UserController::checkPassword($pass)) {
				$_SESSION['loginErr'][] = 'пароль должен быть шесть или более символов';
			}
			if (!empty($_SESSION['loginErr'])) {
				return false;
			}
			$usersArr = UserController::getArrayFromDB();
			if (isset($usersArr[$login])) {
				if ($usersArr[$login] === $pass) {
					return true;
				} else {
					$_SESSION['loginErr'][] = 'неверный пароль';
					return false;
				}
			} else {
				return UserController::addNewUser($login, $pass);
			}
		} catch (Exception $err){
			$_SESSION['err'][] = $err->getMessage();
			return false;
		}
	}
	static function addNewUser($login, $pass) {
		global $configs;
		$filename = $configs->users;
		try {
			$usersArr = UserController::getArrayFromDB();
			$usersArr[$login] = $pass;
			file_put_contents($filename,json_encode($usersArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
		} catch (Exception $err) {
			$_SESSION['err'][] = $err->getMessage();
			return false;
		}
		return true;
	}
	private static function getArrayFromDB() {
		global $configs;
		$filename = $configs->users;
		if (!FileController::checkFileWritable($filename)) {
			return false;
		}
		return json_decode(file_get_contents($filename), true);
	}

	private static function checkName($name) {
		if (strlen($name) >= 2) {
			return true;
		}
		return false;
	}
	
	private static function checkPassword($password) {
		if (strlen($password) >= 6) {
			return true;
		}
		return false;
	}
}
