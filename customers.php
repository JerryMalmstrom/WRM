<script>
$( function() {
	
	updateTable();
	
	$('#create-customer').button().on( "click", function() {
		$('.ui.modal').modal('show');
    });	
	
	
	$('.ui.form').form({
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
		addCustomer();
	});
	
	$('#update').button().on( "click", function() {
		updateTable();
	});
	
	
	
	function updateTable() {
		$( "#tableHolder" ).load( 'table.php' );
	}
	
	function addCustomer() {
		userID = <?php echo $login_id ?>;
		
		$.post("save-to-db.php", { type: 'customer_add', user: userID, name: $('[name=name]').val(), address: $('[name=address]').val(), phone: $('[name=phone]').val(), status: $('[name=status]').val(), comment: $('[name=comment]').val() })
		.done(function() {
			$('.ui.modal').modal('hide');
			updateTable();
		});
	};
});
</script>

<div class="sixteen wide column">

	<div class="eight wide column" style="margin-bottom: 30px;">
		<button class="ui button" id="create-customer">Skapa kund</button>
		<button class="ui button" id="update">Updatera</button>
	</div>

	<div class="ui container">
	<div id="tableHolder"></div>
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