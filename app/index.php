<?php
	require './searcher.php';
	require './tools.php';
	#require '../test/generator.php';
	require './echo.php';

	$filename = try_extract($_POST, 'filename', '../documents/test.txt');
	$key = try_extract($_POST, 'key', 'some_key');

	$value = search($filename, $key);
	echo_search_result($key, $value);
?>
