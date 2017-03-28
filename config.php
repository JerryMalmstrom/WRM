<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'WRM-DB');
	
	
	$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	if ($db->connect_errno) {
		echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
	}
	
	$db->set_charset("utf8");
		 
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

	
?>