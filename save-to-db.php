<?php

	require('config.php');
	require('functions.php');
	

	switch ($_POST["type"]) {
		case "event_move":
			$q_user = $_POST["user"];		
			$q_id = $_POST["id"];
			$q_date = $_POST["date"];
									
			$query = "UPDATE events SET date = '$q_date' WHERE id = '$q_id'";
				
			$sql = $db->query($query);
			
			feed_log($db, $q_user, "flyttade ett event","Event: $q_id till $q_date");
			
			break;
		case "event_add":
							
			$q_user = $_POST["user"];
			$q_date = $_POST["date"];
			$q_hours = $_POST["hours"];
			$q_cust = $_POST["customer"];
			
			$sql1 = $db->query("select rate from rates where userID = '$q_user' AND customerID = '$q_cust'");
			
			while ($rates = $sql1->fetch_assoc()) {
				$q_rate = $rates['rate'];
			} 
			
			//echo "User:" . $q_user . ", Rate:" . $q_rate;
			
			$query = "INSERT INTO events (user,date,hours,customer,rate) VALUES ('$q_user','$q_date','$q_hours','$q_cust','$q_rate')";
				
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
			/*$db->insert("Users",[
			"username" => $_POST["username"],
			"name" => $_POST["name"],
			"role" => "User",
			"email" => $_POST["email"],
			"password" => $_POST["password"],
			"company" => $_POST["company"],
			"color" => $_POST["color"]]);*/
			
			$q_user = $_POST["user"];
			
			$query = "INSERT INTO users (username, name, role, email, password, company, color) VALUES ('$_POST['username']','$_POST['name']','$_POST['role']','$_POST['email']','$_POST['password']', '$_POST['company']', '$_POST['color']')";
			$sql = $db->query($query);
						
			feed_log($db, $q_user, "lade till en användare","Användare: $_POST['name']");
			
			
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
		
			$q_name = $_POST["name"];
			$q_address = $_POST["address"];
			$q_phone = $_POST["phone"];
			$q_status = $_POST["status"];
			$q_comment = $_POST["comment"];
			$q_user = $_POST["user"];
			
			$query = "INSERT INTO customers (name, address, phone, status, comment) VALUES ('$q_name','$q_address','$q_phone','$q_status','$q_comment')";
			
			$sql = $db->query($query);
						
			feed_log($db, $q_user, "lade till en kund","Kund: $q_name");
			
			break;
			
		default:
			break;
	}
	
	
	
?>