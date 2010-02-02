<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//usercp/admin.php

$result = get_table("benutzer", "*", "`benutzer`.`ID` ASC");

while ($row = $result->fetch_assoc()) {
	$benutzer_array[]=$row;
}

$ausgabe = "<table border=\"10\">";

foreach ($benutzer_array as $benutzer):
	if($benutzer['RECHTE'] == 1)
		$recht = "Admin";
	else
		$recht = "Benutzer";
	$ausgabe .= 
	"
	
	<tr>
		<td>
			".$benutzer['ID']."
		</td>
		<td>
			".$benutzer['NAME']."
		</td>
		<td>
			".$recht."
		</td>
		<td>
			<a href=\"benutzer_loeschen.php?id=".$benutzer['ID']."\">Benutzer Löschen</a>
		</td>
		<td>";
	if($benutzer['RECHTE'] != 1)
		$ausgabe .= "<a href=\"admin_geben.php?id=".$benutzer['ID']."\">Zum Admin machen</a>";
	else
		$ausgabe .= "<a href=\"admin_nehmen.php?id=".$benutzer['ID']."\">Zum Miglied machen</a>";
		
	$ausgabe .="	
		</td>
	</tr>	
	";

endforeach;

$ausgabe .= "</table>";

?>
<div style="float:right">
<p> </p>
<h2> Admin Panel </h2>
<?php echo $ausgabe; ?>

<h4>Neuen Benutzer anlegen</h4>

<form action="neuer_benutzer.php" method="POST">
	<div>Name:</div><input class="textfeld" type="text" size="32" name="name">
	<div>Passwort:</div><input class="textfeld" type="text" size="32" name="password"><br>
	<input type="submit" name="Name" value="Erstellen">
</form>
</div>




