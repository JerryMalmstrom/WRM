<script>
$( function() {
	//$.post("save-to-db.php", { type: 'user_update', username: username.val(), name: name.val(), email: email.val(), company: company.val(), color: color.val() });
	
	$( '[name=fileToUpload]' ).on( 'change', function() {
		//updateUser();
		//var file_data = $('[name=fileToUpload]').files[0];   
		var formData = new FormData(); 
		formData.append('file', $('input[type=file]')[0].files[0]);
		formData.append('dir', 'images/users/');
		
		uploadFile(formData);
    });
	
	
	function uploadFile(fData) {
		$.ajax({
				url: 'save-to-file.php',
				type: 'post',
				dataType: 'text',
				cache: false,
				data: fData,
				contentType: false,
				processData: false,
		})
		.done(function(fileURL) {
			//console.log(fileURL);
			$('#pImage').attr('src', fileURL);
		});		
	}
	
	$( '#update-user' ).button().on( "click", function() {
		userID = <?php echo $login_id ?>;
		$.post("save-to-db.php", { type: 'user_update', user: userID, username: $('#username').val(), password: $('#password').val(), name: $('#name').val(), email: $('#email').val(), company: $('[name=customer] option:selected').val(), color: $('#color').val(), image: $('#pImage').attr('src') })
		.done(function() {
			alert("Uppdaterad");
		});
	});	
	
	
});
</script>

<div class="ui content">
	<div class="ui container">
		<form>
			<div class="ui form" >
				<form action="save-to-file.php" method="post" enctype="multipart/form-data">
				<table id="user" class="ui single line table">
					<thead>
					  <tr>
						<th>Rad</th>
						<th>Värde</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						$sql = $db->query("SELECT * FROM users WHERE users.username='$login_session'");
											
						while ($d = $sql->fetch_assoc())	{
							?>
							<tr><td>ID</td><td><?php echo $d["ID"]; ?></td></tr>
							<tr><td>Användarnamn</td><td><input id='username' type='text' value=<?php echo "'" . $d["username"] . "'"; ?>></td></tr>
							<tr><td>Lösenord</td><td><input id='password' type='password' value='******'></td></tr>
							<tr><td>Namn</td><td><input id='name' type='text' value=<?php echo "'" . $d["name"] . "'"; ?>></td></tr>
							<tr><td>Email</td><td><input id='email' type='text' value=<?php echo "'" . $d["email"] . "'"; ?>></td></tr>
							<tr><td>Företag</td><td><select class="ui search dropdown" name="company">
							<?php 
							foreach ($gCustomers as $c) {
								echo "<option value='" . $c['ID'] . "'>" . $c['name'] . "</option>";
							} 
							?>
							</select></td></tr>
							<tr><td>Roll</td><td><?php echo $d["role"]; ?></td></tr>
							<tr><td>Färg</td><td><input type='color' id='color' value=<?php echo "'" . trim($d["color"]) . "'"; ?>></td></tr>
							<tr><td>Bild</td><td><img id='pImage' width='300px' src=<?php echo "'" . $d["profileImage"] . "'"; ?>></br><input type='file' name='fileToUpload'></td></tr>
							<?php //" . $d["profileImage"] . " 
						}
					?>
					</tbody>
				</table>
				</form>
			</div>
		</form>
		</br>
	<button class="ui button" id="update-user">Uppdatera användare</button>
	</div>
</div>