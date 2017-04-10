<script>
$(document).ready(function () {
    var url = window.location;
    // Will only work if string in href matches with location
        //$('.menu a[href="' + url + '"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs
        $('.menu a').filter(function () {
            return this.href == url;
        }).addClass('active');
});
</script>

<!-- Fixed navbar -->
<div class="ui container">
	<div class="ui stackable menu">
		<a class="item" href="index.php"><i class="home icon"></i>WRM</a>
		<a class="item" href="?page=calendar"><i class="calendar icon"></i>Kalender</a>
		<a class="item" href="?page=users"><i class="user icon"></i>Användare</a>
		<a class="item" href="?page=customers"><i class="blind icon"></i>Kunder</a>
		<a class="item" href="?page=reporting"><i class="bar chart icon"></i>Rapporter</a>

		<div class="right menu">
			<div class="ui dropdown item">
				<?php echo $login_name; ?> <i class="dropdown icon"></i>
				<div class="menu">
					<a class="item" href="?page=profile">Profil</a>
					<a class="item" href="logout.php">Logga ut</a>
				</div>
			</div>
			<a class="item"><img class="ui avatar image" src="<?php echo $login_image; ?>"></a>
		</div>
	</div>
</div>