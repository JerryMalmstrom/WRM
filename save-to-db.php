<?php

	require('config.php');
	require('functions.php');
	

	switch ($_POST["type"]) {
		case "event_add":
							
			$q_user = $_POST["user"];
			$q_date = $_POST["date"];
			$q_hours = $_POST["hours"];
			$q_cust = $_POST["customer"];
						
			$query = "INSERT INTO events (user,date,hours,customer) VALUES ('$q_user','$q_date','$q_hours','$q_cust')";
				
			$sql = $db->query($query);
			
			feed_log($db, $q_user, "lade till ett event","Event: $q_hours på kund");
			
			break;
		case "event_remove":
			$q_user = $_POST["user"];
			$q_id = $_POST["id"];
			
			$query = "DELETE FROM events WHERE id = $q_id";
			
			$sql = $db->query($query);
			
			feed_log($db, $q_user, "tog bort ett event","Event: $q_id");
			
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
		case "customer_update":
			$db->update("Customers",[
				"name" => $_POST["name"]
			],[
				"ID" => $_POST["ID"]
			]);
			break;
		case "customer_add":
			$db->insert("Customers",[
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