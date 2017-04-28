<?php
	require('config.php');
	require('functions.php');
	require('settings.php');
	
	if ($_POST["page"] == "1") {
		$limit = 0;
	}
	else {
		$limit = (intval($_POST["page"]) * 10);
	}
	
	$sql = sql_read($db, "select f.ID AS ID,f.user AS user,f.date AS date,f.title AS title,f.description AS description,u.name AS name,u.profileImage AS profileImage from (feed f left join users u on((u.ID = f.user))) order by f.date desc limit $limit,10");
	
	while ($row = $sql->fetch_assoc()) {
		?>
		<div class="event">
			<div class="label">
				<img src="<?php echo str_replace(".png", "_small.jpg", $row['profileImage']); ?>">
			</div>
			<div class="content">
				<div class="summary">
					<a class="user">
						<?php echo $row['name']; ?>
					</a> <?php echo $row['title']; ?>
					<div class="date">
						<?php echo $row['date']; ?>
					</div>
				</div>
				<div class="meta">
					<?php echo $row['description']; ?>
				</div>
			</div>
		</div>
		<div class="ui fitted divider"></div>
		<?php } ?>
		
		
		
<script>
$('div.date').each(function() {
			Ntext = $.fullCalendar.moment($( this ).text().trim());
			$( this ).text(Ntext.fromNow());
		});
</script>