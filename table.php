<table id="customers" class="ui single line table">
	<thead>
		<tr>
			<th>Namn</th>
			<th>Adress</th>
			<th>Telefon</th>
			<th>Status</th>
			<th>Kontakter</th>
			<th>Kommentar</th>
		</tr>
	</thead>
	<tbody>
	<?php
		require('config.php');
		require('functions.php');
	
		//$data = $db->query("SELECT * FROM vcustomers");
		$data = $db->query("select c.ID AS ID,c.name AS name,c.address AS address,c.phone AS phone,c.status AS status,c.comment AS comment,(select count(0) from users where (users.company = c.ID)) AS contacts from customers c");
		while ($d = $data->fetch_assoc())
		{
			echo "<tr><td>" . $d["name"] . 
				"</td><td>" . $d["address"] .
				"</td><td><a href='tel:" . $d["phone"] . "'>" . $d["phone"] . "</a>" .
				"</td><td>" . $d["status"] .
				"</td><td>" . $d["contacts"] .
				"</td><td>" . $d["comment"] .
				"</td></tr>";
		}
?>
</tbody>
</table>