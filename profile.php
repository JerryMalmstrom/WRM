<script>
$( function() {
	//$.post("save-to-db.php", { type: 'user_update', username: username.val(), name: name.val(), email: email.val(), company: company.val(), color: color.val() });
	
	$( "#update-user" ).button().on( "click", function() {
		//updateUser();	
    });
	
});
</script>

<div class="ui content">
	<div class="ui container">
	  <table id="user" class="ui single line table">
		<thead>
		  <tr>
			<th>Rad</th>
			<th>Värde</th>
		  </tr>
		</thead>
		<tbody>
		<?php
		
		$sql = $db->query("SELECT * FROM users WHERE username='$login_session'");
		
		
		while ($d = $sql->fetch_assoc())	{
			echo "<tr><td>ID</td><td>" . $d["ID"] . "</td></tr>";
			echo "<tr><td>Användarnamn</td><td><input id='username' type='text' value='" . $d["username"] . "'></td></tr>";
			echo "<tr><td>Namn</td><td><input id='name' type='text' value='" . $d["name"] . "'></td></tr>";
			echo "<tr><td>Email</td><td><input id='email' type='text' value='" . $d["email"] . "'></td></tr>";
			echo "<tr><td>Företag</td><td><input id='company' type='text' value='" . $d["company"] . "'></td></tr>";
			echo "<tr><td>Roll</td><td>" . $d["role"] . "</td></tr>";
			echo "<tr><td>Färg</td><td><input type='color' id='color' value='" . trim($d["color"]) . "'></td></tr>";
			echo "<tr><td>Bild</td><td>" . $d["profileImage"] . "</td></tr>";
		}
		?>
		</tbody>
	</table>
	<button class="ui button" id="update-user">Uppdatera användare</button>
	</div>
</div>