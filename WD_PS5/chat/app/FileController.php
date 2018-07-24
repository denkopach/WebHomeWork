<?php

class FileController
{

	static function checkFileRW($file)
	{
		if (!FileController::checkFileExists($file)) {
			return false;
		}
		if (!is_writable($file)) {
			throw new Exception('file is not writable');
		}	
		return true;
	}

	static function checkFileExists($file)
	{
		if (!file_exists($file)) {
			throw new Exception('file does not exist');
		}
		return true;
	}
}
