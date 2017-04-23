<div class="ui centered grid">
	<div class="eight wide column">
		<div class="ui container">
			<div class="ui feed">
			
			<?php
				$sql = sql_read($db, "select f.ID AS ID,f.user AS user,f.date AS date,f.title AS title,f.description AS description,u.name AS name,u.profileImage AS profileImage from (feed f left join users u on((u.ID = f.user))) order by f.date desc limit 0,10");

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
			</div>
		</div>
	</div>
	<div class="seven wide column">
		<div class="ui container">
			<div class="ui list">
				<a class="item" href="https://redovisa.timeapp.se/login" target="_blank">
					<i class="right triangle icon"></i>
					<div class="content">
						<div class="header">TimeApp</div>
						<div class="description">https://redovisa.timeapp.se/login</div>
					</div>
				</a>
				<a class="item" href="https://gilit.sharepoint.com/sites/bellman/SitePages/Startsida.aspx" target="_blank">
					<i class="right triangle icon"></i>
					<div class="content">
						<div class="header">Sharepoint</div>
						<div class="description">https://gilit.sharepoint.com/sites/bellman/SitePages/Startsida.aspx</div>
					</div>
				</a>
				<a class="item" href="https://www.dropbox.com/home/WhiteRed-publik" target="_blank">
					<i class="right triangle icon"></i>
					<div class="content">
						<div class="header">Dropbox</div>
						<div class="description">https://www.dropbox.com/home/WhiteRed-publik</div>
					</div>
				</a>
				<a class="item" href="https://login.microsoftonline.com" target="_blank">
					<i class="right triangle icon"></i>
					<div class="content">
						<div class="header">Office 365</div>
						<div class="description">https://login.microsoftonline.com</div>
					</div>
				</a>				
			</div>
		</div>
		<br/>
	</div>
</div>

<script>
	$('div.date').each(function() {
		Ntext = $.fullCalendar.moment($( this ).text().trim());
		$( this ).text(Ntext.fromNow());
		
	});
	
	//$.fullCalendar.moment('<?php echo $row['date']; ?>').fromNow();

</script>