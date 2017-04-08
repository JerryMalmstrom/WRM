<?php

	// Fix for removed Session functions 
	function fix_session_register(){ 
		function session_register(){ 
			$args = func_get_args(); 
			foreach ($args as $key){ 
				$_SESSION[$key]=$GLOBALS[$key]; 
			} 
		} 
		function session_is_registered($key){ 
			return isset($_SESSION[$key]); 
		} 
		function session_unregister($key){ 
			unset($_SESSION[$key]); 
		} 
	} 
	if (!function_exists('session_register')) fix_session_register(); 


	function feed_log($db, $user, $title, $description) {
		$query = "INSERT INTO feed (user,title,description) VALUES ('$user','$title','$description')";
		$sql = $db->query($query);
	}
	
	function sql_read($db, $query) {
		$sql = $db->query($query);
		return $sql;
	}


?>