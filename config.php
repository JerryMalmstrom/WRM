<?php
	define('DB_SERVER', 'SERVER');
	define('DB_USERNAME', 'USER');
	define('DB_PASSWORD', 'PASSWORD');
	define('DB_DATABASE', 'DATABASE');
	
	
	$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	if ($db->connect_errno) {
		echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
	}
	
	$db->set_charset("utf8");
	
?>
