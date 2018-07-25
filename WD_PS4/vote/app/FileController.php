<?php

class FileController
{

	static function checkFileWritable($file)
	{
		if (!FileController::checkFileExists($file)) {
			return false;
		}
		if (!is_writable($file)) {
			throw new Exception('ERROR! File is not writable');
		}	
		return true;
	}

	static function checkFileReadable($file)
	{
		if (!FileController::checkFileExists($file)) {
			return false;
		}
		if (!is_readable($file)) {
			throw new Exception('ERROR! File is not readable');
		}	
		return true;
	}

	static function checkFileExists($file)
	{
		if (!file_exists($file)) {
			throw new Exception('ERROR! File does not exist');
		}
		return true;
	}
}
