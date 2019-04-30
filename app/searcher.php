<?php
	function is_first_less($first_string, $second_string){
		return strcmp($first_string, $second_string);
	}

	function read_up_to($handle, $terminator){
		$result = "";
		do{
			$c = fgetc($handle);
			if ($c != $terminator){
				$result = $result . $c;
			}
		} while ($c != $terminator);
		return $result;
	}

	function get_nearest_key($handle, $key_value_separator, $entry_separator, $initial_size){
		$c = fgetc($handle);
		$key = "";
		$value = "";
		
		while (ftell($handle) >= 0){
			if ((($c == $entry_separator) and (ftell($handle) < $initial_size - 1)) or (ftell($handle) == 0)){
				$key = read_up_to($handle, $key_value_separator);
				$value = read_up_to($handle, $entry_separator);
				return array(
					'key' => $key,
					'value' => $value
				);
			} else {
				if (ftell($handle) >= 2){
					fseek($handle, ftell($handle) - 2);
					$c = fgetc($handle);
				} else {
					fseek($handle, 0);
				}
			}
		}
	}

	function search($filename, $key, $key_value_separator = "\t", $entry_separator = "\x0A"){
		$initial_size = filesize($filename);
		$observed_part_size = intdiv(filesize($filename), 2);
		$observed_part_offset = intdiv(filesize($filename), 2);
		$handle = fopen($filename, 'r') or die('Cannot open file: ' . $filename);
		$i = -1;

		try{
			while ($observed_part_size > 2){
				$i++;
				$observed_part_size = ceil($initial_size / pow(2, $i + 2));
				fseek($handle, $observed_part_offset);
				$nearest_entry = get_nearest_key($handle, $key_value_separator, $entry_separator, $initial_size);
				$comp_result = is_first_less($key, $nearest_entry['key']);
				
				if ($comp_result == 0) {
					return $nearest_entry['value'];
				} else {
					$observed_part_offset += (($comp_result < 0) ? -1 : 1) * $observed_part_size;

					if ($observed_part_offset < 0){
						$observed_part_offset = 0;
					}
				}
			}
			return null;
		} finally {
			fclose($handle);
		}
	}
?>
