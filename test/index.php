<?php
	require '../app/searcher.php';
	require './generator.php';
	require '../app/echo.php';

	$filename = '../documents/big_test.txt';
	$number_of_entries = 1000000;

	function measure_and_echo($filename, $key, $echo = true){
		$start_time = microtime(true);
		$value = search($filename, $key);
		$execution_time = microtime(true) - $start_time;
		if ($echo){
			echo_search_result($key, $value);
			echo_execution_time($execution_time);
		}
	}

	echo '<br/>Generating file...';
	generate_file($number_of_entries, $filename);
	echo '<br/>Searching for every correct key...';

	/*for ($i = 0; $i < 10; $i++){
		assert(is_null(measure_and_echo($filename, letterize($i))), false);
	}*/
	
	echo '<br/>Searching for an incorrect key...';
	assert(!measure_and_echo($filename, '{{'));
?>
