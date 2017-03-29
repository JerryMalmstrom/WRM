<script>
	$(document).ready(function() {
		// page is now ready, initialize the calendar...
		
		$('.ui.dropdown').dropdown();
		
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
				//alert("Eventid: " + event.id);
				
				//id=calEvent.id;
				
				$('#modalmessage').text(calEvent.date + " - " + calEvent.title);
				
				$('.ui.basic.modal').modal({
					onDeny    : function(){
						return false;
					},
					onApprove : function() {
						$('#calendar').fullCalendar('removeEvents', calEvent._id);
						$.post("save-to-db.php", { 
						type: 'event_remove',
						user: <?php echo $login_id ?>,
						id: calEvent.id});
					}
				}).modal('show');
				
				/*$( "#dialog" ).dialog({
                  resizable: false,
                  height:200,
                  width:500,
                  modal: false,
                  title: 'Ta bort?',
                  buttons: {
					CLOSE: function() {
						$("#dialog").dialog( "close" );
                    },
                    "DELETE": function() {
						$('#calendar').fullCalendar('removeEvents', calEvent._id);
                    }
					}
				});*/
				
				
				
			},
			eventReceive: function(event) {
				$.post("save-to-db.php", { 
					type: 'event_add',
					user: event.user,
					date: event.start.format(),
					customer: event.customer,
					hours: event.hours })
					.done(function( data ) {
						//alert( data );
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