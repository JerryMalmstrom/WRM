<table id="customers" class="ui single line table">
	<thead>
		<tr>
			<th style="display: none">ID</th>
			<th>Namn</th>
			<th>Adress</th>
			<th>Telefon</th>
			<th>Email</th>
			<th>Status</th>
			<th>Kontakter</th>
			<th>Kommentar</th>
			<th>Timpris</tr>
		</tr>
	</thead>
	<tbody>
	<?php
		require('config.php');
		require('functions.php');
	
		$data = sql_read($db, "select c.ID AS ID,c.name AS name,c.address AS address,c.phone AS phone,c.email as email,c.status AS status,c.comment AS comment, r.rate as rate,(select count(0) from users where (users.company = c.ID)) AS contacts from customers c " .
		"LEFT JOIN rates r ON r.ID = c.rate ORDER BY name");
		while ($d = $data->fetch_assoc())
		{
			echo "<tr style='display: none'><td id='id'>" . $d["ID"] . "</td></tr>" .
				"<tr><td id='name'><a href='#' class='editCustomer'>" . $d["name"] . 
				"</a></td><td id='address'>" . $d["address"] .
				"</td><td id='phone'><a href='tel:" . $d["phone"] . "'>" . $d["phone"] . "</a>" .
				"</td><td id='email'><a href='mailto:" . $d["email"] . "'>" . $d["email"] . "</a>" .
				"</td><td id='status'>" . $d["status"] .
				"</td><td>" . $d["contacts"] .
				"</td><td id='comment'>" . $d["comment"] .
				"</td><td id='rate'>" . $d["rate"] .
				"</td></tr>";
		}
?>
</tbody>
</table>