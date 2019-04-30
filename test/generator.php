<?php
	function convert($value, $base){
		$remainders = array();
		while ($value > 0){
			array_unshift($remainders, $value % $base);
			$value = intdiv($value, $base);
		}
		if (count($remainders) == 0){
			array_push($remainders, 0);
		}
		return $remainders;
	}

	function letterize($value){
		$values = convert($value, 52);
		$result = "";
		//print_r($values);
		for ($i = 0; $i < count($values); $i++){
			if ($values[$i] < 26){
				$result = $result . chr(65 + $values[$i]);
			} else if ($values[$i] < 52) {
				$result = $result . chr(71 + $values[$i]);

			}
		}
		return $result;
	}

	
	/*
	function switch_to_next_key(&$key_encoded){
		for ($i = 0; $i < count($key_encoded); $i++){
			if ($key_encoded[$i] < 0){
				$key_encoded[$i] = 65;
				break;
			} else if ($key_encoded[$i] == 90) {
				$key_encoded[$i] = 97;
				break;
			} else if ($key_encoded[$i] < 122) {
				$key_encoded[$i] += 1;
				break;
			}
		}
	}
	*/
	function decode_key($key_encoded){
		$result = "";
		for ($i = 0; $i < count($key_encoded); $i++){
			if ($key_encoded[$i] > 0){
				$result = $result . chr($key_encoded[$i]);
			} else {
				return $result;
			}
		}
	}

	function inverse_string($string_to_inverse){
		$result = "";
		for ($i = strlen($string_to_inverse) - 1; $i >= 0; $i--){
			$result = $result . $string_to_inverse[$i];
		}
		return $result;
	}

	function generate_file($number_of_entries, $filename, $key_value_separator = "\t", $entry_separator = "\x0A"){
		

		//$key_encoded = array_fill(0, intdiv($number_of_entries, 52), -1);
		$key_encoded = -1;

		$keys = array();

		for ($i = 0; $i < $number_of_entries; $i++){
			$key_encoded += 1;			


			//switch_to_next_key($key_encoded);
			$key_decoded = letterize($key_encoded);//decode_key($key_encoded);
			//$key_decoded_inversed = inverse_string($key_decoded);
			
			array_push($keys, $key_decoded);
			
		}

		sort($keys);

		$handle = fopen($filename, 'a') or die('Cannot open file: ' . $filename);
		ftruncate($handle, 0);

		for ($i = 0; $i < $number_of_entries; $i++){
			fwrite($handle, $keys[$i] . "\t" . inverse_string($keys[$i]) . "\x0A");
		}

		fclose($handle);
	}
?>