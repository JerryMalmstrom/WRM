<script>
$( function() {
	var form,
    emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
    name = $( "#name" ),
	username = $( "#username" ),
    email = $( "#email" ),
    allFields = $( [] ).add( username ).add( name ).add( email ).add( company ).add( color ), tips = $( ".validateTips" );
 
    function updateTips( t ) {
		tips
        .text( t )
        .addClass( "ui-state-highlight" );
		setTimeout(function() {
			tips.removeClass( "ui-state-highlight", 1500 );
		}, 500 );
    }
 
    function checkLength( o, n, min, max ) {
		if ( o.val().length > max || o.val().length < min ) {
			o.addClass( "ui-state-error" );
			updateTips( "Längden på " + n + " måste vara mellan " +
			min + " och " + max + "." );
			return false;
		} else {
			return true;
		}
    }
 
    function checkRegexp( o, regexp, n ) {
		if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			updateTips( n );
			return false;
		} else {
			return true;
		}
    }
	
	function updateUser() {
		var valid = true;
		allFields.removeClass( "ui-state-error" );
 
		valid = valid && checkLength( name, "namn", 2, 80 );
		valid = valid && checkLength( email, "email", 6, 80 );
		valid = valid && checkRegexp( username, /^[a-z]([0-9a-z_\s])+$/i, "Användarnamnet kan bara vara a-z" );
		valid = valid && checkRegexp( name, /^[a-ö]([0-9a-ö_\s])+$/i, "Namnet kan bara vara A-ö & a-ö" );
		valid = valid && checkRegexp( email, emailRegex, "eg. user@whitered.se" );
 
		if ( valid ) {
			$.post("save-to-db.php", { type: 'user_update', username: username.val(), name: name.val(), email: email.val(), company: company.val(), color: color.val() });
		}
		return valid;
    }
 
    $( "#update-user" ).button().on( "click", function() {
		updateUser();
    });
});
</script>

<div class="row">
	<div class="col-md-12">
	  <form>	  
	  <table id="user" class="table table-striped ui-widget ui-widget-content">
		<thead>
		  <tr class="ui-widget-header ">
			<th>Rad</th>
			<th>Värde</th>
		  </tr>
		</thead>
		<tbody>
		<?php
		$data = $db->select("Users", "*" , [
			"username"=>$login_session
		]);
		
		
		foreach ($data as $d)
		{
			echo "<tr><td>ID</td><td>" . $d["ID"] . "</td></tr>";
			echo "<tr><td>Användarnamn</td><td><input name='username' type='text' value='" . $d["username"] . "'></td></tr>";
			echo "<tr><td id='name'>Namn</td><td><input name='name' type='text' value='" . $d["name"] . "'></td></tr>";
			echo "<tr><td id='email'>Email</td><td><input name='email' type='email' value='" . $d["email"] . "'></td></tr>";
			echo "<tr><td id='company'>Företag</td><td><input name='company' type='text' value='" . $d["company"] . "'></td></tr>";
			echo "<tr><td>Roll</td><td>" . $d["role"] . "</td></tr>";
			echo "<tr><td id='color'>Färg</td><td><input size='200' type='color' name='color' value='" . trim($d["color"]) . "'></td></tr>";
			echo "<tr><td>Bild</td><td>" . $d["profileImage"] . "</td></tr>";
		}
		?>
		</tbody>
	</table>
	<button id="update-user">Uppdatera</button>
	</form>
</div>