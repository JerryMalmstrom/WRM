<div class="ui centered grid">
	<div class="eight wide column">
		<div class="ui container">
			<div class="ui feed" id="feed">
						
			</div>
			<div class="ui pagination menu">
				<a class="active item" OnClick="setActive(this)">1</a>
				<a class="item" OnClick="setActive(this)">2</a>
				<a class="item" OnClick="setActive(this)">3</a>
				<a class="item" OnClick="setActive(this)">4</a>
				<a class="item" OnClick="setActive(this)">5</a>
				<a class="item" OnClick="setActive(this)">6</a>
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
		
	function updateTable(Cpage) {
		$( '#feed' ).load( 'log.php', { page: Cpage }); 
		
	}
	function setActive(item) {
		updateTable(item.text);
		$('.item').removeClass('active');
		$('.item').filter(function () {
            return this.text == item.text;
        }).addClass('active');		
	}
	
	$(function() {
		updateTable("1");
	});
</script>