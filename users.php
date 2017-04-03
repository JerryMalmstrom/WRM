<script>
$( function() {
	
    function addUser() {
		$.post("save-to-db.php", { type: 'user_add', username: username.val(), name: name.val(), email: email.val(), password: password.val(), company: company.val(), color: color.val() });
	}
		
	$( "#create-user" ).button().on( "click", function() {
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
  });
	
});
</script>

<div class="ui content">
	<div class="eight wide column" style="margin-bottom: 30px;">
		<button class="ui button" id="create-user">Skapa användare</button>
	</div>
	
	<div class="ui three stackable cards">
	<?php
			$query = "select * from users";
			$sql = $db->query($query);
					
			while ($d = $sql->fetch_assoc())
			{				
	?>
				<div class="card">
					<div class="image">
						<a class="ui left corner label">
							<i class="male icon"></i>
						</a>
						<img src="<?php echo $d["profileImage"]; ?>">
					</div>
					<div class="content">
						<div class="header"><?php echo $d["name"]; ?></div>
						<div class="meta">
							<?php echo $d["company"]; ?>
						</div>
						<div class="description">
							<?php echo $d["description"]; ?>
						</div>
					</div>
					<div class="extra content">
						<span class="right floated">
							<a class="ui label" style="color: #FFF;background-color: <?php echo $d["color"]; ?>;border-color: <?php echo $d["color"]; ?>;"><?php echo $d["color"]; ?></a>
						</span>
						<span>
							<i class="user icon"></i>
							<?php echo $d["role"]; ?>
						</span>
					</div>
				</div>

	<?php
			}
	?>

	</div>
</div>


<div class="ui modal">
	<i class="close icon"></i>
    <div class="header">
		Lägg till en användare
	</div>
	<div class="content">
		<form>
		<div class="ui form">
			<div class="fields">
				<div class="six wide required field">
					<label>Användarnamn</label>
					<input type="text" placeholder="Användarnamn" name="username">
				</div>
				<div class="six wide required field">
					<label>Namn</label>
					<input type="text" placeholder="Namn" name="name">
				</div>
				<div class="four wide required field">
					<label>Roll</label>
					<select class="ui fluid dropdown" name="role">
						<option value="User">Användare</option>
						<option value="Admin">Admin</option>
					</select>
				</div>
			</div>
			<div class="fields">
				<div class="sixteen wide field">
					<label>Beskrivning</label>
					<textarea rows="2" name="description"></textarea>
				</div>
			</div>
			<div class="fields">
				<div class="six wide required field">
					<label>Email</label>
					<input type="email" placeholder="Email" name="email">
				</div>
				<div class="five wide required field">
					<label>Lösenord</label>
					<input type="password" placeholder="Lösenord" name="password">
				</div>
				<div class="five wide required field">
					<label>Lösenord (igen)</label>
					<input type="password" placeholder="Lösenord" name="password2">
				</div>
			</div>
			<div class="fields">
				<div class="six wide field">
					<label>Företag</label>
					<select class="ui fluid dropdown" name="company">
						<option value="1">White Red</option>
						<option value="2">Borealis</option>
					</select>
				</div>
				<div class="five wide field">
					<label>Bild</label>
					<input type="text" placeholder="Bild" name="profileImage">
				</div>
				<div class="five wide field">
					<label>Färg</label>
					<input type="text" placeholder="Färg" name="color">
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