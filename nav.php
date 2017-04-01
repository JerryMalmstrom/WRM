<!-- Fixed navbar -->
<div class="ui stackable menu" style="margin-bottom: 30px">
	<div class="ui container">
		<a class="item" href="index.php"><i class="home icon"></i>White Red Manager</a>
		<a class="item" href="?page=calendar"><i class="calendar icon"></i>Kalender</a>
		<a class="item" href="?page=users"><i class="user icon"></i>Användare</a>
		<a class="item" href="?page=customers"><i class="blind icon"></i>Kunder</a>
		<a class="item" href="?page=reporting"><i class="bar chart icon"></i>Rapporter</a>
		
		<div class="right menu">
			<a class="item" href="?page=profile"><img class="ui avatar image" src="<?php echo $login_image; ?>"> <?php echo $login_name; ?></a>
			<a class="ui compact red basic button item" href="logout.php">Logga ut</a>
		</div>
	</div>
</div>