<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'sa');
	define('DB_PASSWORD', '1853satan');
	define('DB_DATABASE', 'WRM-DB');
	//$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
	require  'src/Medoo.php';
	use Medoo\Medoo;

	// Initialize
	$db = new Medoo([
		'database_type' => 'mssql',
		'database_name' => DB_DATABASE,
		'server' => DB_SERVER,
		'username' => DB_USERNAME,
		'password' => DB_PASSWORD,
		'charset' => 'utf8'
	]);
	
	 
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