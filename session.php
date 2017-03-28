<?php
	include('config.php');
	session_start();
   
	$user_check = $_SESSION['login_user'];
   
	//$ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
	$ses_sql = $db->select("Users", "*" , ["username"=>$user_check]);
   
	foreach ($ses_sql as $s)
	{
		$login_session = $s['username'];
		$login_name = $s['name'];
		$login_color = $s['color'];
		$login_id = $s['ID'];
	}
   
	if(!isset($_SESSION['login_user'])){
		header("location:login.php");
	}
?>