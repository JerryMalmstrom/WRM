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
	
		$data = $db->query("SELECT * FROM vcustomers");
		while ($d = $data->fetch_assoc())
		{
			echo "<tr><td>" . $d["name"] . 
				"</td><td>" . $d["address"] .
				"</td><td>" . $d["phone"] .
				"</td><td>" . $d["status"] .
				"</td><td>" . $d["contacts"] .
				"</td><td>" . $d["comment"] .
				"</td></tr>";
		}
?>
</tbody>
</table>