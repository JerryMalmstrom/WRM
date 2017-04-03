<script>
	$(document).ready(function() {
		// page is now ready, initialize the calendar...
		
		$('#external-events .fc-event').each(function() {
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
			eventClick: function(calEvent, jsEvent, view) {
				$('#modalmessage').text(calEvent.date + " - " + calEvent.title);
				$('.ui.basic.modal').modal({
					onDeny : function(){
						
					},
					onApprove : function() {
						$.post("save-to-db.php", { 
						type: 'event_remove',
						user: <?php echo $login_id ?>,
						id: calEvent.id}).done(function() {
							$('#calendar').fullCalendar( 'refetchEvents');
						});
					}
				}).modal('show');
								
				//console.log(calEvent);
				
			},
			eventReceive: function(event, date) {
				$.post("save-to-db.php", { 
					type: 'event_add',
					user: event.user,
					date: event.start.format(),
					customer: event.customer,
					hours: event.hours })
					.done(function( data ) {
						
					});
				event.date = event.start.format();
				
			},
			eventResize: function(event, delta, revertFunc) {
				nrofDays = (delta/3600/24000); //1
				
				dateF = moment(event.end);
				
				for (x=0;x<nrofDays;x++) {
					$.post("save-to-db.php", {type: 'event_add',user: event.user,date: dateF.subtract(1, 'days').format(),customer: event.customer,	hours: event.hours })
					.done(function() {$('#calendar').fullCalendar( 'refetchEvents')});
				}
				
				$('#calendar').fullCalendar('removeEvents', event.id);
				
				$('#calendar').fullCalendar( 'refetchEvents');
				
			},
			eventDragStart: function(event, jsEvent) {
				$('.external').attr("data-tooltip", "");		
			},
			eventDrop: function(event, delta, revertFunc) {
				$.post("save-to-db.php", { 
					type: 'event_move',
					id: event.id,
					user: <?php echo $login_id ?>,
					date: event.start.format(),
					});	
			}
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
	$sql = $db->query("select * from customers");
?>

<div class="ui grid">
	<div class="eight wide column">
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
	</div>
	<div class="four wide column" id='external-events'>
		<div class='ui fc-event external' style='background-color: <?php echo $login_color ?>; border-color: <?php echo $login_color ?>'>-</div>
	</div>
</div>

<div class="sixteen wide column">
	<div id='calendar'></div>
</div>

<div class="ui basic modal">
  <div class="ui icon header">
    <i class="trash icon"></i>
    Ta bort
  </div>
  <div class="content">
    <p>Vill du ta bort dessa timmar?</p>
	<p id="modalmessage"></p>
  </div>
  <div class="actions">
    <div id="no" class="ui red basic cancel inverted button">
      <i class="remove icon"></i>
      Nej
    </div>
    <div id="yes" class="ui green ok inverted button">
      <i class="checkmark icon"></i>
      Ja
    </div>
  </div>
</div>