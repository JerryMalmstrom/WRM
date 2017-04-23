<table id="customers" class="ui sortable celled table">
	<thead>
		<tr>
			<th style="display: none">ID</th>
			<th>Namn</th>
			<th>Adress</th>
			<th>Telefon</th>
			<th>Email</th>
			<th>Status</th>
			<th>Kontakter</th>
			<th>Kontrakt</th>
			<th>Kommentar</th>
		</tr>
	</thead>
	<tbody>
	<?php
		require('config.php');
		require('functions.php');
		
		$internal = $_POST['showInternal'];
		
		if ($internal == 'false')	{
			$data = sql_read($db, "select c.ID AS ID,c.name AS name,c.address AS address,c.phone AS phone,c.email as email,c.status AS status,c.comment AS comment, r.ID as rate,(select count(0) from users where (users.company = c.ID)) AS contacts, (select count(0) from contracts where (contracts.customer = c.ID)) AS contracts from customers c " .
			"LEFT JOIN rates r ON r.ID = c.rate " .
			"WHERE status <> 'Intern' " .
			"ORDER BY name");
		} else {
			$data = sql_read($db, "select c.ID AS ID,c.name AS name,c.address AS address,c.phone AS phone,c.email as email,c.status AS status,c.comment AS comment, r.ID as rate,(select count(0) from users where (users.company = c.ID)) AS contacts, (select count(0) from contracts where (contracts.customer = c.ID)) AS contracts from customers c " .
			"LEFT JOIN rates r ON r.ID = c.rate " .
			"ORDER BY name");
		}
	
		
		while ($d = $data->fetch_assoc())
		{
			if ($d["contracts"] > 0)	{
				$link = "<a href='open_report.php?type=contractlist' target='_blank'>" . $d["contracts"] . "</a>";
			} else {
				$link = $d["contracts"];
			}
			
			echo "<tr><td id='cID' style='display: none'>" . $d["ID"] . "</td>" .
				"<td id='name'><a href='#' class='editCustomer'>" . $d["name"] . 
				"</a></td><td id='address'>" . $d["address"] .
				"</td><td id='phone'><a href='tel:" . $d["phone"] . "'>" . $d["phone"] . "</a>" .
				"</td><td id='email'><a href='mailto:" . $d["email"] . "'>" . $d["email"] . "</a>" .
				"</td><td id='status'>" . $d["status"] .
				"</td><td>" . $d["contacts"] .
				"</td><td>" . $link .
				"</td><td id='comment'>" . $d["comment"] .
				"</td><td id='rate' style='display: none'>" . $d["rate"] .
				"</td></tr>";
		}
		
		
		
?>
</tbody>
</table>