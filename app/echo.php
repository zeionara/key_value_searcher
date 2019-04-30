<?php
	function echo_search_result($key, $value){
		if ($value){
			echo '<br/>Wohoo! We have got the value for key ' . $key . ' - it is <b>' . $value . '</b>!';
		} else {
			echo '<br/>Hmm, it seems that there is no key <b>' . $key . '</b> in the given document...';
		}
	}

	function echo_execution_time($execution_time){
		echo '<br/>Execution took ' . $execution_time . ' seconds.';
	}
?>