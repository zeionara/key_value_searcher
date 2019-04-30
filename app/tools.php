<?php
	function try_extract($array, $index, $default){
		return (array_key_exists($index, $array) ? htmlspecialchars($array[$index]) : $default);
	}
?>