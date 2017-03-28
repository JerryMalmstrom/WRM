<script>
	$(document).ready(function() {
		// page is now ready, initialize the calendar...
		
		$('.ui.dropdown').dropdown();
		
		$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			/*$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				hours: $('[name=hours]').val(),
				customer: $('[name=customer]').val(),
				user: $('[name=hours]').attr("data-uid"),
				color: "#5cb85c",
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});*/

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});		
		
		$('#calendar').fullCalendar({
			editable: true,
			droppable: true,
			events: {
				url: 'json-events-feed.php',
				type: 'POST', // Send post data

				error: function() {
					alert('There was an error while fetching events.');
				}
			},
			drop: function(date) {
				//alert("Dropped on " + date.format());
				
			},
			eventReceive: function(event) {
				/*alert("Date: " + event.start.format() + "\n" +
					"User: " + event.user + "\n" + 
					"Customer: " + event.customer + "\n" +
					"Hours: " + event.hours + "\n");*/
				$.post("save-to-db.php", { 
					type: 'event',
					user: event.user,
					date: event.start.format(),
					customer: event.customer,
					hours: event.hours })
					.done(function( data ) {
						alert( data );
					});
			},
			
		});
		
		$('[name=customer],[name=hours]').change(function () {
			$('.external').text('<?php echo strtoupper($login_session) ?>' + " : " + $('[name=customer] option:selected').text() + " : " + $('[name=hours]').val());
			
			$('#external-events .fc-event').each(function() {
				$(this).data('event', {
					title: $.trim($(this).text()), // use the element's text as the event title
					hours: $('[name=hours]').val(),
					customer: $('[name=customer]').val(),
					user: $('[name=hours]').attr("data-uid"),
					color: "<?php echo $login_color ?>",
					stick: true // maintain when user navigates (see docs on the renderEvent method)
				});
			});
		})
		
		
	});
</script>

<?php
	//$data = $db->select("Customers", "*" , "");	
	$sql = $db->query("select * from customers");
		
?>

<div class="ten wide column">
	<div class="ui segment" id='external-events'>
		
		<select class="ui search dropdown" name="customer">
		<option value="">Kund</option>
		<?php 
			while ($d = $sql->fetch_assoc()) {
				echo "<option value='" . $d['ID'] . "'>" . $d['name'] . "</option>";
			}
		?>
		</select>
		
		<select class="ui compact selection dropdown" data-uid="<?php echo $login_id; ?>" name="hours">
			<option value="">Timmar</option>
			<option value=1>1h</option>
			<option value=2>2h</option>
			<option value=3>3h</option>
			<option value=4>4h</option>
			<option value=5>5h</option>
			<option value=6>6h</option>
			<option value=7>7h</option>
			<option value=8>8h</option>
		</select>
		<div class='ui fc-event external' style='background-color: <?php echo $login_color ?>; border-color: <?php echo $login_color ?>'>-</div>
		
	</div>
</div>

<div class="six wide column">
	<button class="ui labeled icon button"><i class="trash icon"></i>Ta bort</button>
</div>

<div class="sixteen wide column">
	<div id='calendar'></div>
</div>