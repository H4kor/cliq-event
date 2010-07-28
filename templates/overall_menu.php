<!-- Statisches Element Menü(Hauptseite) -->
	<script language="JavaScript">
		$(document).ready(function () {
			$('#openmenu').click(function() {
				if( window.sichtbar === undefined ){
					sichtbar = 0;
				}
				
				if(sichtbar == 0){
					sichtbar = 1;
					$('#menu').css({ 'visibility': 'visible' });
				}else{
					sichtbar = 0
					$('#menu').css({ 'visibility': 'hidden' });
				}
					
			});
		});
	</script>

<a id="openmenu" >Menü öffnen</a>
<div id="menu">
<a href="<?php echo MAIN_FOLDER; ?>eventplaner.php">Eventplaner</a>
<a href="<?php echo MAIN_FOLDER; ?>chat.php?re_id=-1">Chat</a>
<a href="<?php echo MAIN_FOLDER; ?>statistics.php">Statistik</a>
<a href="<?php echo MAIN_FOLDER; ?>usercp/index.php">Control-Panel</a>
<?php if($_SESSION['rechte'] == 1){ ?>
	<a href="<?php echo MAIN_FOLDER; ?>admin/index.php">Admin-Panel</a>
<?php } ?>
<a href="<?php echo MAIN_FOLDER; ?>functions/logout.php">Logout</a>
</div>
