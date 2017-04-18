<?php
	
	require('config.php');
	require('functions.php');
	
	$reportURL = "";

	switch ($_POST["type"]) {
		case "planning":
			$reportURL = "planning.html";
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
		case "userlist":
			$reportURL = "userlist.html";
			$r_users = $_POST["users"];
			$a_users = array();
			
			if ($r_users != "") {
				$user = $db->query("SELECT username, name, ID FROM users WHERE ID IN ($r_users) ORDER BY name");
				$r_users = "";
				
				$x = 0;
				
				while ($c = $user->fetch_assoc()) {
					$a_users[$x]['ID'] = $c['ID'];
					$a_users[$x]['username'] = $c['username'];
					$a_users[$x]['name'] = $c['name'];
					$x++;
				}
			} else {
				$user = $db->query("SELECT username, name, ID FROM users ORDER BY name");
				
				$x = 0;
				
				while ($c = $user->fetch_assoc()) {
					$a_users[$x]['ID'] = $c['ID'];
					$a_users[$x]['username'] = $c['username'];
					$a_users[$x]['name'] = $c['name'];
					$x++;
				}
			}
			break;
		case "customerlist":
			$reportURL = "customerlist.html";
			$r_customers = str_replace(",","','",$_POST["customers"]);
			$a_customers = array();
			
			if ($r_customers != "") {
				$cust = $db->query("SELECT ID, name, status FROM customers WHERE status IN ('$r_customers') ORDER BY name");
				$x = 0;
				
				while ($c = $cust->fetch_assoc()) {
					$a_customers[$x]['ID'] = $c['ID'];
					$a_customers[$x]['name'] = $c['name'];
					$a_customers[$x]['status'] = $c['status'];
					$x++;
				}
			} else {
				$cust = $db->query("SELECT ID, name, status FROM customers ORDER BY name");
				$x = 0;
				
				while ($c = $cust->fetch_assoc()) {
					$a_customers[$x]['ID'] = $c['ID'];
					$a_customers[$x]['name'] = $c['name'];
					$a_customers[$x]['status'] = $c['status'];
					$x++;
				}
			}
			break;
		case "contractlist":
			$reportURL = "contractlist.html";
			$r_customers = str_replace(",","','",$_POST["customers"]);
			$a_customers = array();
			
			if ($r_customers != "") {
				$cust = $db->query("SELECT c.ID AS ID, c.name AS name, c.status AS status, k.start AS start, k.end AS end FROM customers c " . 
				"INNER JOIN contracts k ON k.customer = c.ID " . 
				"WHERE status IN ('$r_customers') ORDER BY name");
				$x = 0;
				
				while ($c = $cust->fetch_assoc()) {
					$a_customers[$x]['name'] = $c['name'];
					$a_customers[$x]['start'] = $c['start'];
					$a_customers[$x]['end'] = $c['end'];
					$x++;
				}
			} else {
				$cust = $db->query("SELECT c.ID AS ID, c.name AS name, k.start AS start, k.end AS end FROM customers c " . 
				"INNER JOIN contracts k ON k.customer = c.ID " . 
				"ORDER BY name");
				$x = 0;
				
				while ($c = $cust->fetch_assoc()) {
					$a_customers[$x]['name'] = $c['name'];
					$a_customers[$x]['start'] = $c['start'];
					$a_customers[$x]['end'] = $c['end'];
					$x++;
				}
			}
			break;
		default:
			break;
	}
?><!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
	<head>
	<meta charset="UTF-8">
	<title>White Red Manager - Rapport</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
	<link rel='stylesheet' href='//fonts.googleapis.com/css?family=Open+Sans|Roboto' type='text/css'>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
	<link rel="stylesheet" href="theme.css" type="text/css">
	
	<script src="//code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>
	<script src="js/tablesort.js"></script>
	
	<style>
		h1 { margin-top: 40px!important;}
		h3 { margin-bottom: 30px;}
	</style>
	
	<script>
	$(function() {
		$('table').tablesort();
	});
	</script>
	
	</head>
	
	<?php require($reportURL); ?>
		
</html>