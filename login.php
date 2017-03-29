<?php
	require('config.php');
	require('functions.php');

	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form 
		  
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		  
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.css">
	<link rel="stylesheet" href="theme.css" type="text/css">
	
	<style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
	
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.js"></script>
	
	<script>
	$(document).ready(function() {
	  $('.ui.form').form({
			fields: {
				username: {
				identifier  : 'username',
				rules: [
				{
					type   : 'empty',
					prompt : 'Fyll i ditt användarnamn'
				}
			  ]
			},
			password: {
			  identifier  : 'password',
			  rules: [
				{
				  type   : 'empty',
				  prompt : 'Fyll i ditt lösenord'
				}
			  ]
			}
		  }
		})
	  ;
	})
	;
  </script>

	</head>
	<body>
	
		<div class="ui middle aligned center aligned grid">
			<div class="column">
				<h2 class="ui red image header">
					<img src="images/logo.gif" class="image">
					<div class="content">
					Logga in
					</div>
				</h2>
				<form class="ui large form" action = "" method = "post">
					<div class="ui stacked segment">
						<div class="field">
							<div class="ui left icon input">
								<i class="user icon"></i>
								<input type="text" name="username" placeholder="Användarnamn">
							</div>
						</div>
						<div class="field">
							<div class="ui left icon input">
								<i class="lock icon"></i>
								<input type="password" name="password" placeholder="Lösenord">
							</div>
						</div>
						<div class="ui fluid large red submit button">Login</div>
					</div>
					
					<?php if ($error) {
						echo "<div class='ui error message' style='display: inherit'>" . $error . "</div>";
					} else {
						echo "<div class='ui error message'></div>";
					}
					?>

				</form>
					   
				<div class="ui message">
					Har du hittat hit av misstag? <a href="http://www.google.se">Hoppa vidare</a>
				</div>
			</div>
		</div>

	</body>
</html>