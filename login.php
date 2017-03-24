<?php

	include("config.php");
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form 
		  
		$username = $_POST['username'];
		$password = $_POST['password']; 
		  
		//$sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
		$sql = $db->select("Users", "ID" , [
			"AND"=>[
				"username"=>$username,
				"password"=>$password
			]
		]);
		
		$count = count($sql);
		  
		// If result matched $myusername and $mypassword, table row must be 1 row
			
		if($count == 1) {
			session_register("username");
			$_SESSION['login_user'] = $username;
			 
			header("location: index.php");
		} else {
			$error = "Your Login Name or Password is invalid";
		}
   }
?>

<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
	<head>
	<meta charset="UTF-8">
	<title>White Red Manager - Login</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
	<link rel='stylesheet' href='//fonts.googleapis.com/css?family=Open+Sans|Roboto' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  
	<link rel="stylesheet" href="theme.css" type="text/css">
	  
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script src="js/bootstrap.min.js"></script>
	
	</head>
   
   <body>
	
      <div align="center">
         <div style = "width:300px;">
            <div style = "padding:3px;"><b>Logga in</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Användarnamn  :</label><br/><input type = "text" name = "username" class = "box"/><br/><br />
                  <label>Lösenord  :</label><br/><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Logga in "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>