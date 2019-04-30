<?php
	function measure_and_echo($filename, $key, &$response, $echo = true){
		if ($echo){
			$start_time = microtime(true);
		}
		$value = search($filename, $key);
		$response['value'] = search($filename, $key);
		if ($echo){
			$response['search_time'] = microtime(true) - $start_time;
			//echo_execution_time(microtime(true) - $start_time);
		}
		return $value;
	}
?>