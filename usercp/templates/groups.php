<?php
//usercp/templates/groups.php

//header einfügen
$seite = "Gruppenverwaltung";
include "../templates/overall_header.php"; 
?>

<h2>Gruppenverwaltung</h2>

<h3>Bu bist in folgenden Gruppen Mitglied</h3>
<table border="10">
	<?php
	//Alles ausgeben	
	foreach($aktive_groups as $group):
	?>
	<tr>
	<td>
		Gruppe: <?php echo $group['NAME']; ?><br>
		Notiz: <?php echo $group['NOTE']; ?><br>
	</td>
	<td>
		<a>Gruppe verlassen</a>
	</td>
	<td>
		<a>Gruppe verwalten</a>
	</td>
	</tr>
	<?php
	endforeach;
	?>
</table>
<br>
<h3>Offene Gruppeneinladungen/-anfragen</h3>

<h3>Neue Gruppe eröffnen</h3>

<form action="functions/create_group.php" method="post">
<b>Name:</b>
<input type="text" class="textfeld" size="17" name="name" value=""><br>
<b>Notiz:</b>
<input type="text" class="textfeld" size="17" name="note" value=""><br>
<br>
<input type="submit" value="OK">
</form>
