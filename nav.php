<!-- Fixed navbar -->
<div class="ui attached stackable menu">
	<div class="ui container">
		<a class="item" href="index.php"><i class="home icon"></i>White Red Manager</a>
		<a class="item" href="?page=calendar"><i class="calendar icon"></i>Kalender</a>
		<a class="item" href="?page=users"><i class="user icon"></i>Användare</a>
		<a class="item" href="?page=customers"><i class="blind icon"></i>Kunder</a>
		
		<div class="right menu">
			<a class="item" href="?page=profile"><?php echo $login_name; ?></a>
			<a class="ui compact red basic button item" href="logout.php">Logga ut</a>
		</div>
	</div>
</div>
	
	
	