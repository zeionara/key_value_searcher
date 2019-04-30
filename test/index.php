<?php
	require '../app/searcher.php';
	require './generator.php';
	require './measurer.php';
	require '../app/echo.php';
	require '../app/tools.php';
	require './random.php';

	$filename = try_extract($_POST, 'filename', '../documents/test.txt');
	$number_of_keys_to_generate = try_extract($_POST, 'number_of_keys_to_generate', 1000);
	$number_of_keys_to_test = try_extract($_POST, 'number_of_keys_to_test', 10);
	$echo_execution_time = try_extract($_POST, 'echo_execution_time', false);
	$incorrect_key = try_extract($_POST, 'incorrect_key', '{{');

	$response = array();

	#echo '<br/>Generating file...';
	$response['file_generated'] = generate_file($number_of_keys_to_generate, $filename);
	
	#echo '<br/>Searching for correct keys...';
	$int_keys = get_random_integers($number_of_keys_to_test, 0, $number_of_keys_to_generate);
	$response['request_correct_keys'] = array();
	for ($i = 0; $i < $number_of_keys_to_test; $i++){
		$key = letterize($int_keys[$i]);
		
		$response['request_correct_keys'][$key] = array();
		assert(!is_null(measure_and_echo($filename, letterize($int_keys[$i]), $response['request_correct_keys'][$key], $echo_execution_time)));
	}
	
	#echo '<br/>Searching for an incorrect key...';
	$response['request_incorrect_keys'] = array();
	$response['request_incorrect_keys'][$incorrect_key] = array();
	assert(is_null(measure_and_echo($filename, $incorrect_key, $response['request_incorrect_keys'][$incorrect_key], $echo_execution_time)));

	echo json_encode($response) . "\n";
?>
