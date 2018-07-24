<?php

function __autoload($class_name)
{
	# List all the class directories in the array.
	$array_paths = array(
		APP_PATH.DIRECTORY_SEPARATOR,
	);
	foreach ($array_paths as $path) {
		$path = $path . $class_name . '.php';
		if (is_file($path)) {
			include_once $path;
		}
	}
}