<?php
	require('config.php');
	require('functions.php');

	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form 
		  
		$username = $_POST['username'];
		$password = $_POST['password']; 
		  
		$query = "SELECT id FROM users WHERE username = '$username' and password = '$password'";
		
		if (!$sql = $db->query($query)) {
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
		
		if($sql->num_rows == 1) {
			session_register("username");
			$_SESSION['login_user'] = $username;
			 
			header("location: index.php");
		} else {
			$error = "Ditt användarnamn eller lösenord är felaktigt";
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