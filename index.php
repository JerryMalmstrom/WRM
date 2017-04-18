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
	<link rel="stylesheet" href="//cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.css" type="text/css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.1/fullcalendar.min.css" type="text/css">
	<link rel="stylesheet" href="jqui/jquery-ui.min.css" type="text/css">
	<link rel="stylesheet" href="theme.css" type="text/css">
	
	<script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="jqui/jquery-ui.min.js"></script>
	<script src="jqui/jquery.ui.touch-punch.min.js"></script>
	<script src="//cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/locale/sv.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.1/fullcalendar.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.1/locale/sv.js"></script>
	<script src="js/tablesort.js"></script>
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