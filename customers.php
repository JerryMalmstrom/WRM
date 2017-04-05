<script>
$( function() {
	
	updateTable();
	
	$('#create-customer').button().on( "click", function() {
		$('[name=ID]').val(1);
		$('.ui.modal').modal('show');
    });	
	
	$( "body" ).on( "click", ".editCustomer", function( event ) {
		event.preventDefault();
		
		$('[name=ID]').val(0);
		
		var data = {};
		
		$( this ).parent().parent().find('td').each(function() {
			data[$(this).attr('id')] = $(this).text();
		});
		
		//console.log(data.rate);
		
		$('[name=ID]').val(data.id);
		$('[name=name]').val(data.name);
		$('[name=address]').val(data.address);
		$('[name=phone]').val(data.phone);
		$('[name=email]').val(data.email);
		$('[name=status]').val(data.status);
		$('[name=comment]').val(data.comment);
		$('[name=rate]').val(data.rate);
		
		$('.ui.modal').modal('show');
	});
	
	$('.ui.form').form({
		on: 'blur',
		fields: {
			name: {
				identifier: 'name',
				rules: [
				{
					type   : 'empty',
					prompt : 'Fyll i bolagsnamn'
				}
				]
			}
		}
	});
	
	$('#save').button().on( "click", function() {
		if ($('[name=ID]').val() === 1) {
			addCustomer();
		} else {
			updateCustomer();
		}
		
	});
	
	$('[name=search]').keyup(function() {
		searchCustomer();
	});
	
	
	function updateTable() {
		$( '#tableHolder' ).load( 'table.php' );
	};
	
	function addCustomer() {
		userID = <?php echo $login_id ?>;
		
		$.post("save-to-db.php", { type: 'customer_add', user: userID, name: $('[name=name]').val(), address: $('[name=address]').val(), phone: $('[name=phone]').val(), status: $('[name=status]').val(), comment: $('[name=comment]').val() })
		.done(function() {
			$('.ui.modal').modal('hide');
			updateTable();
		});
	};
	
	function updateCustomer() {
		userID = <?php echo $login_id ?>;
		
		$.post("save-to-db.php", { type: 'customer_update', cID: $('[name=ID]').val(), user: userID, name: $('[name=name]').val(), address: $('[name=address]').val(), phone: $('[name=phone]').val(), email: $('[name=email]').val(), status: $('[name=status]').val(), comment: $('[name=comment]').val(), rate: $('[name=rate]').val() })
		.done(function(result) {
			$('.ui.modal').modal('hide');
			//updateTable();
			console.log(result);
		});
	};
	
	function searchCustomer() {
		filter = $('[name=search]').val().toUpperCase();
		tr = $('#customers > tbody > tr');
		
		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			} 
		}
	};
	
});

</script>

<div class="sixteen wide column">
	<div class="eight wide column" style="margin-bottom: 30px;">
		<button class="ui button" id="create-customer">Skapa kund</button>
		<div class="ui input">
			<input type="text" placeholder="Sök kund" name="search">
		</div>
	</div>

	<div class="ui container">
		<div id="tableHolder"></div>
	</div>
</div>

﻿<div class="ui modal">
	<i class="close icon"></i>
    <div class="header">
		Lägg till/ändra en kund
	</div>
	<div class="content">
		<form id="customers_form">
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
					<div class="six wide required field">
						<label>Status</label>
						<select class="ui fluid dropdown" name="status">
							<option value="Intern">Intern</option>
							<option value="Kund">Kund</option>
							<option value="Prospekt">Prospekt</option>
						</select>
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
						<label>Rate</label>
						<input type="text" placeholder="0" name="rate">
					</div>
					<div class="four wide field">			
						<input type="hidden" value=0 name="ID">
					</div>
				</div>
			</div>
		</form>
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