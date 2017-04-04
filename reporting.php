<script>
$( function() {
	$('#show-report').button().on( "click", function() {
		$('#report_form').submit();
    });	
	
	$('.ui.dropdown').dropdown();
	
	startDate = $.fullCalendar.moment().startOf('month').format();
	endDate = $.fullCalendar.moment().endOf('month').format();
	
	$('[name=fromdate]').val(startDate);
	$('[name=todate]').val(endDate);
	
});
</script>

<div class="ui content">
	<div class="eight wide column" style="margin-bottom: 30px;">
		<form id="report_form" action="open_report.php" method="post" target="_blank">
			<div class="ui form">
				<div class="fields">
					<div class="field">
						<label>Från:</label>
						<input type="date" name="fromdate" value="">
						<label>Till:</label>
						<input type="date" name="todate" value="">
						<label>Användare:</label>
						<div class="ui multiple selection dropdown">
							<input name="users" type="hidden">
							<i class="dropdown icon"></i>
							<div class="default text">Alla</div>
							<div class="menu">
								<div class="item" data-value="2">JeM</div>
								<div class="item" data-value="3">OG</div>
								<div class="item" data-value="4">JM</div>
								<div class="item" data-value="5">SI</div>
							</div>
						</div>
						
						<label>Kunder:</label>
						<div class="ui multiple selection dropdown">
							<input name="customers" type="hidden">
							<i class="dropdown icon"></i>
							<div class="default text">Alla</div>
							<div class="menu">
								<div class="item" data-value="1">White Red</div>
								<div class="item" data-value="2">Uddevalla</div>
								<div class="item" data-value="3">Borealis</div>
								<div class="item" data-value="4">Berras Kakor</div>
							</div>
						</div>
						<br/>
						<input type="hidden" name="type" value="report1">
						<button class="ui button" id="show-report">Visa rapport</button>
					</div>
					
				</div>
			</div>
		</form>
	</div>
	
	<div class="sixteen wide column">
	

	</div>
</div>
