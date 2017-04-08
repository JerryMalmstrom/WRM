<?php
	$gUsers = [[]];
	array_pop($gUsers);
	
	$gCustomers = [[]];
	array_pop($gCustomers);
	
	$gRates = [[]];
	array_pop($gRates);
	
	
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
	
	// Timpriser
	
	$sql = sql_read($db, "select ID,rate from rates ORDER BY ID");
		
	while ($row = $sql->fetch_assoc()) {
		$x = $row['ID'];
		$gRates[$x]['ID'] = $x;
		$gRates[$x]['rate'] = $row['rate'];
	}
	
?>