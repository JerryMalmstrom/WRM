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
			
			$sql1 = $db->query("select c.ID, r.rate as rate from customers c JOIN rates r ON r.ID = c.rate WHERE c.ID = $q_cust");
			
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
			
			$q_username = $_POST["username"];
			$q_name = $_POST["name"];
			$q_role = $_POST["role"];
			$q_email = $_POST["email"];
			$q_password = $_POST["password"];
			$q_company = $_POST["company"];
			$q_color = $_POST["color"];
			
			
			$q_user = $_POST["user"];
			
			$query = "INSERT INTO users (username, name, role, email, password, company, color)
			VALUES ('$q_username','$q_name','$q_role','$q_email','$q_password', '$q_company', '$q_color')";
			$sql = $db->query($query);
						
			feed_log($db, $q_user, "lade till en användare","Användare: $q_name");
			
			
			break;
		case "user_update":
			$q_username = $_POST["username"];
			$q_name = $_POST["name"];
			$q_email = $_POST["email"];
			$q_company = 1; //$_POST["company"];
			$q_color = $_POST["color"];
			$q_image = $_POST["image"];
			
			$q_user = $_POST["user"];
			
			$query = "UPDATE users SET username = '$q_username', name = '$q_name', email = '$q_email', company = '$q_company', color = '$q_color', profileImage = '$q_image' WHERE ID = '$q_user'";
			
			$sql = $db->query($query);
						
			feed_log($db, $q_user, "uppdaterade sin användarprofil","");
			
			break;
		case "customer_update":
			$q_name = $_POST["name"];
			$q_address = $_POST["address"];
			$q_phone = $_POST["phone"];
			$q_status = $_POST["status"];
			$q_comment = $_POST["comment"];
			$q_user = $_POST["user"];
			$q_id = $_POST["cID"];
			$q_rate = $_POST["rate"];
			
			$query = "UPDATE customers SET (name = '$q_name', address = '$q_address', phone = '$q_phone', status = '$q_status', comment = '$q_comment', rate = $q_rate) WHERE ID = $q_id";
			
			$sql = $db->query($query);
						
			feed_log($db, $q_user, "ändrade en kund","Kund: $q_name");
			
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
			
		case "customer_remove":
			$q_user = $_POST["user"];
			$q_id = $_POST["cID"];
			
			$query = "DELETE FROM customers WHERE id = $q_id";
			
			$sql = $db->query($query);
			
			feed_log($db, $q_user, "tog bort en kund","Kund: $q_id");
			
			break;
			
		default:
			break;
	}
	
	
	
?>