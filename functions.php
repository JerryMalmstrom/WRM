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
				
				while ($row = $sql->fetch_assoc()) {
					$x = $row['ID'];
					$gUsers[$x]['ID'] = $x;
					$gUsers[$x]['username'] = $row['username'];
					$gUsers[$x]['name'] = $row['name'];
					$gUsers[$x]['role'] = $row['role'];
					$gUsers[$x]['description'] = $row['description'];
					$gUsers[$x]['email'] = $row['email'];
					$gUsers[$x]['company'] = $row['company'];
					$gUsers[$x]['profileID'] = $row['profileID'];
					$gUsers[$x]['profileImage'] = $row['profileImage'];
					$gUsers[$x]['color'] = $row['color'];
				}
				break;
				
			case "customers":
				// Kunder
				$sql = sql_read($db, "select ID,name,address,phone,email,status,comment,rate from customers ORDER BY name");
				
				while ($row = $sql->fetch_assoc()) {
					$x = $row['ID'];
					$gCustomers[$x]['ID'] = $x;
					$gCustomers[$x]['name'] = $row['name'];
					$gCustomers[$x]['address'] = $row['address'];
					$gCustomers[$x]['phone'] = $row['phone'];
					$gCustomers[$x]['email'] = $row['email'];
					$gCustomers[$x]['status'] = $row['status'];
					$gCustomers[$x]['comment'] = $row['comment'];
					$gCustomers[$x]['rate'] = $row['rate'];
				}
				break;
				
			case "rates":
				// Timpriser
		
				$sql = sql_read($db, "select ID,rate from rates ORDER BY ID");
					
				while ($row = $sql->fetch_assoc()) {
					$x = $row['ID'];
					$gRates[$x]['ID'] = $x;
					$gRates[$x]['rate'] = $row['rate'];
				}
				break;
			default:;
		}
	}

?>