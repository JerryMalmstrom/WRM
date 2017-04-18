<script>
$( function() {
	$('#show-report').on( "click", function() {
		$('#report_form').submit();
    });	
	
	startDate = $.fullCalendar.moment().startOf('month').format('YYYY-MM-DD');
	endDate = $.fullCalendar.moment().endOf('month').format('YYYY-MM-DD');
	
	$('[name=fromdate]').val(startDate);
	$('[name=todate]').val(endDate);
	
	$('[name=type]').on( "change", function() {
		switch($( this ).val()) {
			case 'customerlist':
				$('#fromtoField').hide();
				$('#usersField').hide();
				$('#customersField').show();
				$('#show-report').show();
				break;
			case 'planning':
				$('#fromtoField').show();
				$('#usersField').show();
				$('#customersField').show();
				$('#show-report').show();
				break;
			case 'userlist':
				$('#fromtoField').hide();
				$('#usersField').show();
				$('#customersField').hide();
				$('#show-report').show();
				break;
			case 'contractlist':
				$('#fromtoField').hide();
				$('#usersField').hide();
				$('#customersField').show();
				$('#show-report').show();
				break;
			default:;
		}
	});
	
	
	$('[name=fromdate]').on( "change", function(data) {
		endDate = $.fullCalendar.moment($('[name=fromdate]').val());
		endDate = endDate.endOf('month').format('YYYY-MM-DD');
		$('[name=todate]').val(endDate);
	});
	
});
</script>


<div class="ui grid">
	<div class="seven wide column">
		<form id="report_form" action="open_report.php" method="post" target="_blank">
			<div class="ui form">
				<div class="field">
					<label>Typ:</label>
					<div class="ui selection dropdown">
						<input name="type" type="hidden">
						<i class="dropdown icon"></i>
						<div class="default text">Välj typ av rapport</div>
						<div class="menu">
							<div class='item' data-value='planning'>Planering</div>
							<div class='item' data-value='customerlist'>Kundlista</div>
							<div class='item' data-value='userlist'>Användarlista</div>
							<div class='item' data-value='contractlist'>Kontraktlista</div>
						</div>
					</div>
				</div>
				<div id="fromtoField" class="field" style="display: none">
					<label>Från - Till</label>
					<div class="two fields">
						<div class="field">
							<input type="date" name="fromdate" value="">
						</div>
						<div class="field">
							<input type="date" name="todate" value="">
						</div>
					</div>
				</div>
				<div id="usersField" class="field" style="display: none">
					<label>Användare:</label>
					<div class="ui multiple selection dropdown">
						<input name="users" type="hidden">
						<i class="dropdown icon"></i>
						<div class="default text">Alla</div>
						<div class="menu">
							<?php foreach ($gUsers as $u) {
								echo "<div class='item' data-value='" . $u['ID'] . "'>" . strtoupper($u['username']) . "</div>";
							} ?>
						</div>
					</div>
				</div>
				<div id="customersField" class="field" style="display: none">
					<label>Typ av kunder:</label>
					<div class="ui multiple selection dropdown">
						<input name="customers" type="hidden">
						<i class="dropdown icon"></i>
						<div class="default text">Alla</div>
						<div class="menu">
							<div class='item' data-value='Intern'>Intern</div>
							<div class='item' data-value='Kund'>Kund</div>
							<div class='item' data-value='Prospekt'>Prospekt</div>
						</div>
					</div>
				</div>
				<br/>
				<button class="ui button" id="show-report"  style="display: none">Visa rapport</button>
			</div>
		</form>
	</div>
	
	<div class="nine wide column">
	</div>
</div>
