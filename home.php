<div class="column">
	<div class="ui container">
	<p>Feed</p>
		<div class="ui feed">
		
		<?php
			$query = "select * from vfeed limit 0,10";
			$sql = $db->query($query);

			while ($row = $sql->fetch_assoc()) {
				?>
				<div class="event">
					<div class="label">
						<img src="<?php echo "/WRM" . str_replace(".png", "_small.jpg", $row['profileImage']);?>">
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
				<?php } ?>
		</div>
	</div>
</div>