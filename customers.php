<script>
/*$( function() {
	
			$.post("save-to-db.php", { type: 'customer_add', username: username.val(), name: name.val(), email: email.val(), password: password.val(), company: 'Test', color: '1' });
			
			
			$( "#customers tbody" ).append( "<tr>" +
			"<td>NY</td>" +
			"<td>" + username.val() + "</td>" +
			"<td>" + name.val() + "</td>" +
			"<td>" + email.val() + "</td>" +
			"<td>User</td>" +
			"<td>1</td>" +
			"</tr>" );
			
			dialog.dialog( "close" );
		}
		return valid;
    }
 

});*/
</script>

<div class="sixteen wide column">
	<div class="ui container">
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

	<button id="create-user">Skapa en kund</button>
</div>

<div class="ui basic modal">
  <div class="ui icon header">
    <i class="trash icon"></i>
    Lägg till kund
  </div>
  <div class="content">
    <p>Vill du lägga till en kund?</p>
	<p id="modalmessage"></p>
  </div>
  <div class="actions">
    <div id="no" class="ui red basic cancel inverted button">
      <i class="remove icon"></i>
      Nej
    </div>
    <div id="yes" class="ui green ok inverted button">
      <i class="checkmark icon"></i>
      Ja
    </div>
  </div>
</div>
</div>