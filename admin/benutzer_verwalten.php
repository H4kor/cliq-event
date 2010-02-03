<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
session_start();
require_once "../includes/dbconnect.php";
require_once "../includes/functions.php";
require_once "../includes/constant.php";

 

if(!access(1)) die();
	//admin/benutzer_verwalten.php

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
				".$benutzer['EMAIL']."
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

	//header einfügen
$seite = "Benutzer verwalten";
include "../static/header.html"; 

?>

<a class="menu" href="index.php">Zurück</a>
<div style="float:left">
<p> </p>

<p> </p>
<h2> Benutzerliste </h2>
<?php echo $ausgabe; ?>

<h4>Neuen Benutzer anlegen</h4>

<form action="neuer_benutzer.php" method="POST">
	<div>Name:</div><input class="textfeld" type="text" size="32" name="name">
	<div>Passwort:</div><input class="textfeld" type="text" size="32" name="password"><br>
	<div>Email:</div><input class="textfeld" type="text" size="32" name="email"><br>
	<input type="submit" name="Name" value="Erstellen">
</form>


</body>
</html>




