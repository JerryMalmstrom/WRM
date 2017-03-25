<?php
	
	switch ($_POST["type"]) {
		case "event":
			$db->insert("Events",[
			"user" => $_POST["user"],
			"date" => $_POST["date"],
			"hours" => $_POST["hours"],
			"customer" => $_POST["customer"]]);
			break;
		case "user_add":
			$db->insert("Users",[
			"username" => $_POST["username"],
			"name" => $_POST["name"],
			"role" => "User",
			"email" => $_POST["email"],
			"password" => $_POST["password"],
			"company" => $_POST["company"],
			"color" => $_POST["color"]]);
			break;
		case "user_update":
			$db->update("Users",[
				"username" => $_POST["username"],
				"name" => $_POST["name"],
				"email" => $_POST["email"],
				"company" => $_POST["company"],
				"color" => $_POST["color"]
			],[
				"username" => $login_session
			]);
			
			break;
			
		default:
			break;
	}
?>