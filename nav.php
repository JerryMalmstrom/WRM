<!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">White Red Manager</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!--<li class="active"><a href="#">Hem</a></li>-->
			<li><a href="?page=calendar">Kalender</a></li>
            <li><a href="?page=users">Användare</a></li>
            <li><a href="?page=customers">Kunder</a></li>
			<li style="width: 150px">&nbsp;&nbsp;&nbsp;</li>
			<li><a href="?page=profile"><?php echo $login_name; ?></a></li>
			<li><a href="logout.php">Logga ut</a>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>