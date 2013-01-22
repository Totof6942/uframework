<?php

spl_autoload_register(function ($className) {
	// Strip whitespace and backslash from the beginning of $className
	$className = ltrim($className, '\\');

	// Name of $className with her relative path
	$fileName  = '';

	// Namespace of $className
	$namespace = '';

	// Test if there are backslashes and find the position of the last backslash
	if ($lastNsPos = strrpos($className, '\\')) {
		// Get the namespace of $className
		$namespace = substr($className, 0, $lastNsPos);

		// Get the class name
		$className = substr($className, $lastNsPos + 1);

		// Formats the path of the class from the namespace
		$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}

	// If $className contains any "_", they are replaced with DIRECTORY_SEPARATOR
	// and '.php' is added at the end of $fileName
	$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

	// Relative path to 'src' directory
	$pahtSrc = 'src'.DIRECTORY_SEPARATOR;

	// Relative path to 'tests' directory
	$pahtTests = 'tests'.DIRECTORY_SEPARATOR;

	// First, test if the class is in "src" directory, secondly, in "tests" directory
	if (file_exists(__DIR__.DIRECTORY_SEPARATOR.$pahtSrc.$fileName)) {
		require $pahtSrc.$fileName;
	}
	else if (file_exists(__DIR__.DIRECTORY_SEPARATOR.$pahtTests.$fileName)){
		require $pahtTests.$fileName;
	}
	else {
		echo sprintf('Class "%s" not found in "src" and "tests" directories.', $fileName);
	}

});
