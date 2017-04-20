<?php
	define('DB_SERVER', 'jmark01');
	define('DB_USERNAME', 'wrm');
	define('DB_PASSWORD', '1qaz2wsx');
	define('DB_DATABASE', 'WRM-DB');
	
	
	$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	if ($db->connect_errno) {
		echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
	}
	
	$db->set_charset("utf8");
	
?>
