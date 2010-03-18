<?php 
//usercp/templates/usercp.php

//header einfügen
$seite = "Eventplaner";
include "../templates/overall_header.php"; 
?>

<p> </p>
<h2> User-Control-Panel </h2>


<form action="functions/update_profil.php" method="post" name="input">
	Dein Status:
	<input type="text" class="textfeld" size="140" name="status" value="<?php echo $status ?>">
	<br><input type="checkbox" <?php if($away == 1)echo "checked" ?> name="away" value="1"> Abwesend?
	<br><input type="submit" value="OK">
</form>

<h4> Deine angemeldeten Events</h4>
<table border="10">
<?php
echo"<tr>\n";
	for($i=0;$i<$anzahl_events;$i++){
			$tabelle[$i]->output();
	}
echo"</tr>\n";
?>
</table>
<br>
<div  align="center"><a href="edit_profile.php">Profil bearbeiten</a></div>

<?php include "../templates/overall_menu.php"; ?>

</body>
</html>