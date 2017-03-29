<?php

	session_start();
   
	$user_check = $_SESSION['login_user'];
   
	if(!isset($_SESSION['login_user'])){
		header("location:login.php");
	}
   
	$sql = "select * from users where username = '$user_check'";
	
	
	if (!$ses_sql = $db->query($sql)) {
		// Oh no! The query failed. 
		echo "Sorry, the website is experiencing problems.";

		// Again, do not do this on a public site, but we'll show you how
		// to get the error information
		echo "Error: Our query failed to execute and here is why: \n";
		echo "Query: " . $sql . "\n";
		echo "Errno: " . $db->errno . "\n";
		echo "Error: " . $db->error . "\n";
		exit;
	}
	
	if ($ses_sql->num_rows < 1) {
			echo "We could not find a match for ID $user_check, sorry about that. Please try again.";	
	}
		
	$s = $ses_sql->fetch_assoc();
	
	$login_session = $s['username'];
	$login_name = $s['name'];
	$login_color = $s['color'];
	$login_id = $s['ID'];
	$login_image = $s['profileImage'];
	$login_image = "/WRM" . str_replace(".png", "_small.jpg", $login_image);
	
?>