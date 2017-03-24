<?php
	require  'src/Medoo.php';
	use Medoo\Medoo;

	// Initialize
	$db = new Medoo([
		'database_type' => 'mssql',
		'database_name' => 'WRM-DB',
		'server' => 'localhost',
		'username' => 'sa',
		'password' => '1853satan',
		'charset' => 'utf8'
	]);
	
	switch ($_POST["type"]) {
		case "event":
			$db->insert("Events",[
			"user" => $_POST["user"],
			"date" => $_POST["date"],
			"hours" => $_POST["hours"],
			"customer" => $_POST["customer"]]);
			break;
		case "user":
			$db->insert("Users",[
			"username" => $_POST["username"],
			"name" => $_POST["name"],
			"role" => "User",
			"email" => $_POST["email"],
			"password" => $_POST["password"],
			"company" => $_POST["company"],
			"color" => $_POST["color"]]);
			break;
		default:
			break;
	}
?>