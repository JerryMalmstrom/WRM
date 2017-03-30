<script>
$( function() {
	
	//$.post("save-to-db.php", { type: 'customer_add', username: username.val(), name: name.val(), email: email.val(), password: password.val(), company: 'Test', color: '1' });
			
	$( "#create-customer" ).button().on( "click", function() {
		$('.ui.modal').modal('show');
    });
	
	
	$('.ui.form').form({
    fields: {
		username: {
			identifier: 'username',
			rules: [
			{
				type   : 'exactLength[2]',
				prompt : 'Endast 2 bokstäver'
			}
			]
		},
		name: {
			identifier: 'name',
			rules: [
			{
				type   : 'empty',
				prompt : 'Fyll i ditt namn'
			}
			]
		},
		email: {
			identifier: 'email',
			rules: [
			{
				type   : 'email',
				prompt : 'Fyll i en korrekt mailadress'
			}
			]
		},
		password: {
        identifier: 'password',
        rules: [
          {
            type   : 'empty',
            prompt : 'Fyll i ett lösenord'
          },
          {
            type   : 'minLength[5]',
            prompt : 'Lösenordet måste vara minst {ruleValue} karaktärer'
          }
        ]
      },
      password2: {
        identifier: 'password2',
        rules: [
          {
            type   : 'match[password]',
            prompt : 'Skriv in samma lösenord två gånger'
          }
        ]
      }
    }
  })
;	

});
</script>

<div class="ui content">
	<div class="eight wide column" style="margin-bottom: 30px;">
		<button class="ui button" id="create-customer">Skapa kund</button>
	</div>
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
	</div>
</div>


<div class="ui modal">
	<i class="close icon"></i>
    <div class="header">
		Lägg till en kund
	</div>
	<div class="content">
		<div class="ui form">
			<div class="fields">
				<div class="six wide required field">
					<label>Namn</label>
					<input type="text" placeholder="Namn" name="name">
				</div>
				<div class="six wide field">
					<label>Adress</label>
					<input type="text" placeholder="Adress" name="address">
				</div>
				<div class="four wide field">
					<label>Telefon</label>
					<input type="text" placeholder="Telefon" name="phone">
				</div>
			</div>
			<div class="fields">
				<div class="sixteen wide field">
					<label>Kommentar</label>
					<textarea rows="2" name="comment"></textarea>
				</div>
			</div>
			<div class="fields">
				<div class="six wide required field">
					<label>Email</label>
					<input type="email" placeholder="Email" name="email">
				</div>
				<div class="six wide field">
					<label>Status</label>
					<select class="ui fluid dropdown" name="status">
						<option value="1">Kund</option>
						<option value="2">Prospekt</option>
					</select>
				</div>
				<div class="four wide required field">
					
				</div>
			</div>
		</div>
	</div>
	<div class="actions">
    <div id="cancel" class="ui red cancel inverted button">
      <i class="remove icon"></i>
      Avbryt
    </div>
    <div id="save" class="ui green save inverted button">
      <i class="checkmark icon"></i>
      Spara
    </div>
  </div>
</div>