<style>
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#customers-contain { width: 350px; margin: 20px 0; }
    div#customers-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#customers-contain table td, div#customers-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
</style>

<script>
$( function() {
	var dialog, form,
    emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
    name = $( "#name" ),
	username = $( "#username" ),
    email = $( "#email" ),
    password = $( "#password" ),
    allFields = $( [] ).add( username ).add( name ).add( email ).add( password ),
    tips = $( ".validateTips" );
 
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
			updateTips( "L�ngden p� " + n + " m�ste vara mellan " +
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
 
    function addCustomer() {
		var valid = true;
		var result_id = 0;
		allFields.removeClass( "ui-state-error" );
 
		valid = valid && checkLength( username, "anv�ndarnamn", 2, 16 );
		valid = valid && checkLength( name, "namn", 2, 80 );
		valid = valid && checkLength( email, "email", 6, 80 );
		valid = valid && checkLength( password, "l�senord", 2, 16 );
 
		valid = valid && checkRegexp( username, /^[a-z]([0-9a-z_\s])+$/i, "Anv�ndarnamnet kan bara vara a-z" );
		valid = valid && checkRegexp( name, /^[a-�]([0-9a-�_\s])+$/i, "Namnet kan bara vara A-� & a-�" );
		valid = valid && checkRegexp( email, emailRegex, "eg. user@whitered.se" );
		valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "L�senordet kan bara best� av a-z & 0-9" );
 
		if ( valid ) {
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
 
    dialog = $( "#dialog-form" ).dialog({
		autoOpen: false,
		height: 600,
		width: 400,
		modal: true,
		buttons: {
			"Skapa en kund": addCustomer,
			Cancel: function() {
				dialog.dialog( "close" );
			}
		},
		close: function() {
			form[ 0 ].reset();
			allFields.removeClass( "ui-state-error" );
		}
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
		event.preventDefault();
		addUser();
    });
 
    $( "#create-user" ).button().on( "click", function() {
		dialog.dialog( "open" );
    });
});
</script>

<div class="row">
	<div class="col-md-12">
	  <table id="customers" class="table table-striped ui-widget ui-widget-content">
		<thead>
		  <tr class="ui-widget-header ">
			<th>ID</th>
			<th>Namn</th>
			<th>Epost</th>
			<th>Roll</th>
			<th>F�rg</th>
		  </tr>
		</thead>
		<tbody>
		<?php
		$data = $db->select("Users", "*" , "");
		foreach ($data as $d)
		{
			echo "<tr><td>" . $d["ID"] .
				"</td><td>" . $d["name"] . 
				"</td><td>" . $d["email"] .
				"</td><td>" . $d["role"] .
				"</td><td style='background-color:" . $d["color"] . "'>" . $d["color"] .
				"</td></tr>";
		}
		?>
		</tbody>
	  </table>
	  
	  <div id="dialog-form" title="Skapa en anv�ndare">
		<p class="validateTips">Fyll i allt snyggt och fint</p>
	 
		<form>
		<fieldset>
		  <label for="name">Anv�ndarnamn</label>
		  <input type="text" name="username" id="username" value="ta" class="text ui-widget-content ui-corner-all">
		  <label for="name">Namn</label>
		  <input type="text" name="name" id="name" value="Test Anv�ndare" class="text ui-widget-content ui-corner-all">
		  <label for="email">Epost</label>
		  <input type="text" name="email" id="email" value="test.anvandare@whitered.se" class="text ui-widget-content ui-corner-all">
		  <label for="password">L�senord</label>
		  <input type="password" name="password" id="password" value="Abc123" class="text ui-widget-content ui-corner-all">
	 
		  <!-- Allow form submission with keyboard without duplicating the dialog button -->
		  <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
		</fieldset>
		</form>
		</div>
				
		<button id="create-user">Skapa en kund</button>
	</div>
</div>