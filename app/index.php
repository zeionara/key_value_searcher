<?php
	require './searcher.php';
	require './tools.php';
	require './echo.php';

	$filename = try_extract($_POST, 'filename', '../documents/test.txt');
	$key = try_extract($_POST, 'key', 'some_key');

	echo json_encode(array(
		'key' => $key,
		'value' => search($filename, $key)
	)) . "\n";
?>
