<script>
	$(document).ready(function() {
		// page is now ready, initialize the calendar...

		$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				hours: 8,
				customer: 3,
				user: 2,
				color: "#5cb85c",
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

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
				//alert("ToSave, Date: " + event.start.format());
				$.post("save-to-db.php", { type: 'event', user: event.user, date: event.start.format(), customer: event.customer, hours: event.hours });
			}
		});
	});
</script>

<div id='external-events'>
	<div class='fc-event' style='background-color: <?php echo $login_color ?>; border-color: <?php echo $login_color ?>'>Borealis: 8h</div>
	<p style="clear: both" />
</div>

<div id='calendar'></div>