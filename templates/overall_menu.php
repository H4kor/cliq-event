<!-- Statisches Element Menü(Hauptseite) -->
<div class="menu">
<a href="../eventplaner.php">Eventplaner</a>
<a href="../chat.php?re_id=-1">Chat</a>
<a href="../statistics.php">Statistik</a>
<a href="../usercp/index.php">Control-Panel</a>
<?php if($_SESSION['rechte'] == 1){ ?>
	<a href="../admin/index.php">Admin-Panel</a>
<?php } ?>
<a href="../functions/logout.php">Logout</a>
</div>
