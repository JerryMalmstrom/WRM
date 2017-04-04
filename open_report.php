<?php

	require('config.php');
	require('functions.php');
	

	switch ($_POST["type"]) {
		case "report1":
			$r_fromdate = $_POST["fromdate"];
			$r_todate = $_POST["todate"];
			$r_users = $_POST["users"];
			$r_customers = $_POST["customers"];
			
			$parameters = "WHERE date >= '" . $r_fromdate . "' AND date <= '" . $r_todate . "'";
			
			if ($r_users != "") {
				$parameters .= " AND user IN (" . (string)$r_users . ")";
				$user = $db->query("SELECT name,ID FROM users WHERE ID IN ($r_users)");
				$r_users = "";
				$a_users = array();
				
				$x = 0;
				
				while ($c = $user->fetch_assoc()) {
					$a_users[$x]['ID'] = $c['ID'];
					$a_users[$x]['name'] = $c['name'];
					$r_users .= $c['name'] . ", ";
					$x++;
				}
			} else {
				$r_users = "Alla";
				
				$user = $db->query("SELECT name, ID FROM users");
				$a_users = array();
				
				$x = 0;
				
				while ($c = $user->fetch_assoc()) {
					$a_users[$x]['ID'] = $c['ID'];
					$a_users[$x]['name'] = $c['name'];
					$x++;
				}
				
			}
			
			if ($r_customers != "") {
				$parameters .= " AND customer IN (" . (string)$r_customers . ")";
				$cust = $db->query("SELECT name FROM customers WHERE ID IN ($r_customers)");
				$r_customers = "";
				while ($c = $cust->fetch_assoc()) {
					$r_customers .= $c['name'] . ", ";
				}
			} else {
				$r_customers = "Alla";
			}
			
			$query = "select hours, rate from events " . $parameters;
			
			$sql = $db->query($query);
			$sumH = 0;
			$sumR = 0;
			
			while ($r = $sql->fetch_assoc()) {
				$sumH += $r['hours'];
				$sumR += $r['hours'] * $r['rate'];
								
			}
			
			
			$query = "select e.user, SUM(e.hours), e.rate, u.name from events e LEFT JOIN users u ON u.ID = e.user " . $parameters . " GROUP BY e.user";
			$sql = $db->query($query);
			
			$ua = array( array(),array(),array() );
			
			while ($r = $sql->fetch_assoc()) {
				$x = $r['user'];
				$ua[$x]["name"] = $r['name'];
				$ua[$x]["hours"] = $r['SUM(e.hours)'];
			}
			
			
			break;
		default:
			break;
	}
	
	
	
?>


<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
	<head>
	<meta charset="UTF-8">
	<title>White Red Manager - Rapport</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
	<link rel='stylesheet' href='//fonts.googleapis.com/css?family=Open+Sans|Roboto' type='text/css'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.css">
	<link rel="stylesheet" href="theme.css" type="text/css">
	
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.js"></script>
	
	<style>
		h1 { margin-top: 40px!important;}
		h3 { margin-bottom: 30px;}
	</style>
	
	</head>
	<body>
	
	<h1 class="ui center aligned header">WRM Rapport</h1>
	<h2 class="ui center aligned header"><?php echo $r_fromdate . " - " . $r_todate; ?></h2>
	
	<div class="ui container">
		<table class="ui celled table">
			<thead>
				<th>Parameter</th>
				<th>Värde</th>
			</thead>
			<tbody>
				<tr>
					<td>Timmar</td>
					<td><?php echo $sumH; ?></td>
				</tr>
				<tr>
					<td>Intäkt</td>
					<td><?php echo $sumR; ?></td>
				</tr>
				<tr>
					<td>Användare</td>
					<td><?php echo $r_users; ?></td>
				</tr>
				<tr>
					<td>Kunder</td>
					<td><?php echo $r_customers; ?></td>
				</tr>
				
			</tbody>
		</table>
	</div>
	
	<div class="ui container">
		<table class="ui celled table">
			<thead>
				<th>Användare</th>
				<th>Timmar</th>
			</thead>
			<tbody>
				<?php
				foreach ($a_users as $u) {
					echo "<tr><td>" . $u['name'] . "</td><td>" . $ua[$u['ID']]['hours'] . "</td></tr>";
				} ?>
			</tbody>
		</table>
	</div>
	</body>
</html>