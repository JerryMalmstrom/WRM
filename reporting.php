<script>
$( function() {
	$('#show-report').button().on( "click", function() {
		$('#report_form').submit();
    });	
	
	startDate = $.fullCalendar.moment().startOf('month').format('YYYY-MM-DD');
	endDate = $.fullCalendar.moment().endOf('month').format('YYYY-MM-DD');
	
	$('[name=fromdate]').val(startDate);
	$('[name=todate]').val(endDate);
	
});
</script>


<?php

	$sql = sql_read($db, "SELECT ID, username FROM users ORDER BY username");
	$sql2 = sql_read($db, "SELECT ID, name FROM customers ORDER BY name");
	
?>

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
								<?php while ($u = $sql->fetch_assoc())	{
									echo "<div class='item' data-value='" . $u['ID'] . "'>" . strtoupper($u['username']) . "</div>";
								} ?>
							</div>
						</div>
						
						<label>Kunder:</label>
						<div class="ui multiple selection dropdown">
							<input name="customers" type="hidden">
							<i class="dropdown icon"></i>
							<div class="default text">Alla</div>
							<div class="menu">
								<?php while ($c = $sql2->fetch_assoc())	{
									echo "<div class='item' data-value='" . $c['ID'] . "'>" . $c['name'] . "</div>";
								} ?>
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
