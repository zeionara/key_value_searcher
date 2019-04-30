<?php
	function get_random_integers($count, $min, $max){
		if ($max - $min < $count){
			throw new Exception('Too many numbers requested');
		}

		$result = array();
		for ($i = 0; $i < $count; $i++){
			do{
				$random_int = rand($min, $max);
			} while (in_array($random_int, $result));
			array_push($result, $random_int);
		}
		return $result;
	}
?>