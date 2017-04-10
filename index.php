<?php
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$start = $time;
?>
<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
	<head>	
	<meta charset="UTF-8">
	<title>White Red Manager</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
	<link rel='stylesheet' href='//fonts.googleapis.com/css?family=Open+Sans|Roboto' type='text/css'>
	<link rel='stylesheet' href='css/fullcalendar.css' />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.css">
	<link rel="stylesheet" href="theme.css" type="text/css">
	
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.js"></script>
	
	<script src='lib/moment.min.js'></script>
	<script src='js/fullcalendar.js'></script>
	<script src='js/locale/sv.js'></script>
	
	</head>
	<body>
	
	<?php
	
		$gUsers = [[]];
		array_pop($gUsers);
		
		$gCustomers = [[]];
		array_pop($gCustomers);
		
		$gRates = [[]];
		array_pop($gRates);
	
		require('config.php');
		require('functions.php');
		require('session.php');
		require('nav.php');
		require('settings.php');
		
		$gUsers = data_read($db, "users");
		$gCustomers = data_read($db, "customers");
		$gRates = data_read($db, "rates");		
	?>
	
	
	
	<div class="ui container">
	
		<?php 
			if($_GET) {
				require($_GET['page'] . ".php");
			}
			else {
				require("home.php");
			}
		?>
		
	</div>
	
	<div class="ui container">
		<?php 
			require("footer.php");
		?>
	</div>
	
	</body>
</html>

