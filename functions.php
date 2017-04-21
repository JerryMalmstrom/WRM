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
	
	function data_read($db, $type) {
		switch ($type) {
			case "users":
				// Users
				$sql = sql_read($db, "select ID,username,name,role,description,email,company,profileID,profileImage,color from users ORDER BY name");
				
				$tempUsers = [[]];
				array_pop($tempUsers);
				
				$x = 0;
				
				while ($row = $sql->fetch_assoc()) {
					$tempUsers[$x]['ID'] = $x;
					$tempUsers[$x]['username'] = $row['username'];
					$tempUsers[$x]['name'] = $row['name'];
					$tempUsers[$x]['role'] = $row['role'];
					$tempUsers[$x]['description'] = $row['description'];
					$tempUsers[$x]['email'] = $row['email'];
					$tempUsers[$x]['company'] = $row['company'];
					$tempUsers[$x]['profileID'] = $row['profileID'];
					$tempUsers[$x]['profileImage'] = $row['profileImage'];
					$tempUsers[$x]['color'] = $row['color'];
					$x += 1;
				}
				
				return $tempUsers;
				
				break;
				
			case "customers":
				// Kunder
				$sql = sql_read($db, "select ID,name,address,phone,email,status,comment,rate from customers ORDER BY name");
				
				$tempCustomers = [[]];
				array_pop($tempCustomers);
				
				while ($row = $sql->fetch_assoc()) {
					$x = $row['ID'];
					$tempCustomers[$x]['ID'] = $x;
					$tempCustomers[$x]['name'] = $row['name'];
					$tempCustomers[$x]['address'] = $row['address'];
					$tempCustomers[$x]['phone'] = $row['phone'];
					$tempCustomers[$x]['email'] = $row['email'];
					$tempCustomers[$x]['status'] = $row['status'];
					$tempCustomers[$x]['comment'] = $row['comment'];
					$tempCustomers[$x]['rate'] = $row['rate'];
				}
				
				return $tempCustomers;
				
				break;
				
			case "rates":
				// Timpriser
		
				$sql = sql_read($db, "select ID,rate from rates ORDER BY ID");
				
				$tempRates = [[]];
				array_pop($tempRates);
				
				while ($row = $sql->fetch_assoc()) {
					$x = $row['ID'];
					$tempRates[$x]['ID'] = $x;
					$tempRates[$x]['rate'] = $row['rate'];
				}
				
				return $tempRates;
				
				break;
			default:;
		}
	}
	
	


?>