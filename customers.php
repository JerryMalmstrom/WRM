<script>
$( function() {
	//var showInternal = false;
	updateTable(false);
	userID = <?php echo $login_id ?>;
	
	$('#create-customer').on( "click", function() {
		$('[name=cID]').val(0);
		$('[name=name]').val('');
		$('[name=address]').val('');
		$('[name=phone]').val('');
		$('[name=email]').val('');
		$('[name=status]').val('');
		$('[name=comment]').val('');
		$('[name=rate]').val('');
		$('#delete').hide();
		
		$('#cModal').modal('show');
    });
	
	$( "body" ).on( "click", ".editCustomer", function( event ) {
		event.preventDefault();
		
		var data = {};
		
		$( this ).parent().parent().find('td').each(function() {
			data[$(this).attr('id')] = $(this).text();
		});
		console.log(data.rate);
		$('#rateI').val(data.rate).change();
		$('[name=cID]').val(data.cID);
		$('[name=name]').val(data.name);
		$('[name=address]').val(data.address);
		$('[name=phone]').val(data.phone);
		$('[name=email]').val(data.email);
		$('[name=status]').val(data.status);
		$('[name=comment]').val(data.comment);
		
		$('#delete').show();
		
		$('#cModal').modal('show');
	});
	
	$('#save').on( "click", function() {
		if ($('[name=cID]').val() === "0") {
			addCustomer();
		} else {
			updateCustomer();
		}
		
		
	});
	
	$('#delete').on( "click", function() {
		$('#sure').modal('show');			
	});
	
	$('#removeYes').on( "click", function() {
		$.post("save-to-db.php", { type: 'customer_remove', user: userID, cID: $('[name=cID]').val() })
		.done(function(result) {
			$('.ui.modal').modal('hide');
			updateTable();
			//console.log("Test");
		});
	});
	
	$('[name=search]').keyup(function() {
		searchCustomer();
	});
	
	$('[name=checkInternal]').change(function() {
		//showInternal = $('[name=checkInternal]').prop('checked');
		updateTable($('[name=checkInternal]').prop('checked'));
	});
	
	
	function updateTable(data) {
		//console.log(data);
		$( '#tableHolder' ).load( 'table.php', { showInternal:data }); 
	};
	
	function addCustomer() {
		$.post("save-to-db.php", { type: 'customer_add', user: userID, name: $('[name=name]').val(), address: $('[name=address]').val(), phone: $('[name=phone]').val(), status: $('[name=status]').val(), comment: $('[name=comment]').val() })
		.done(function() {
			$('#cModal').modal('hide');
			updateTable();
		});
	};
	
	function updateCustomer() {
		$.post("save-to-db.php", { type: 'customer_update', user: userID, cID: $('[name=cID]').val(), name: $('[name=name]').val(), address: $('[name=address]').val(), phone: $('[name=phone]').val(), email: $('[name=email]').val(), status: $('[name=status]').val(), comment: $('[name=comment]').val(), rate: $('[name=rate]').val() })
		.done(function(result) {
			$('#cModal').modal('hide');
			updateTable();
		});
			
	};
	
	function searchCustomer() {
		filter = $('[name=search]').val().toUpperCase();
		tr = $('#customers > tbody > tr');
		
		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[1];
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
		<div class="ui input">
			<div class="ui toggle checkbox">
				<label>Visa interna kunder</label>
				<input type="checkbox" tabindex="0" class="hidden" name="checkInternal">
			</div>
		</div>
	</div>

	<div class="ui container">
		<div id="tableHolder"></div>
	</div>
</div>

﻿<div id="cModal" class="ui modal">
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
						<label>Timpeng</label>
						<select class="ui fluid dropdown" id="rateI" name="rate">
							<?php
								$data = sql_read($db, "SELECT ID, rate FROM rates");
								while ($d = $data->fetch_assoc() ) {
									echo "<option value='" . $d['ID'] . "'>" . $d['rate'] . "</option>";
								}
							?>
						</select>
					</div>
					<div class="four wide field">			
						<input type="hidden" value="0" name="cID">
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="actions">
		<div id="delete" class="ui red delete button" style="float: left">
			<i class="warning icon"></i>
			Ta bort
		</div>
		<div id="sure" class="ui modal">
			<div class="header">
			<i class="warning icon"></i>
			Ta bort kund
			</div>
			<div class="description">
				<p>Är du <b>säker</b> på att du vill ta bord denna kund?</p>
			</div>
			<div class="actions">
				<div class="ui black deny button">
				Nej
				</div>
				<div id="removeYes" class="ui positive right labeled icon button">
				Ja
				<i class="checkmark icon"></i>
				</div>
			</div>
		</div>
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