<?php

class ChatController
{

	static function addMsg($msg)
	{
		global $configs;
		$filename = $configs->messages;
		try {
			FileController::checkFileWritable($filename);
		} catch (Exception $err) {
			$_SESSION['err'][] = $err->getMessage();
			return false;
		}
		
		$file = file_get_contents($filename, true);
		$msgs = json_decode($file,true);
		$msgs[] = [
				"name" => $_SESSION['login'],
				"time" => time(), 
				"msg"=> htmlspecialchars($msg),
			];

		file_put_contents($filename,json_encode(
			$msgs, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}

	static function getMsg()
	{
		try {
			global $configs;
			$filename = $configs->messages;
			if (!FileController::checkFileReadable($filename)) {
				return false;
			}
		} catch (Exception $err) {
			$_SESSION['err'][] = getMessage($err);
			return false;
		}
	}
}