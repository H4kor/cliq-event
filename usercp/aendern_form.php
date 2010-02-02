<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//usercp/aendern_form.php
session_start();

include "../includes/dbconnect.php";
include "../includes/functions.php";

$result = get_table_where("events", "*", "ID = '".$_GET['event']."'");
while ($row = $result->fetch_assoc()) {  
	$event = $row;
}

if($event['BESITZERID'] != $_SESSION['ID'])
	die("KEIN MISSBRAUCH!!!!!!!!!!!");
?>

<?php 
//header einfügen
$seite = "Eventplaner";
include "../static/header.html"; 
?>

<h2> User-Control-Panel </h2>
<h4> Event bearbeiten</h4>

<form action="aendern.php" method="post" name="input">
<input type="hidden" value="<?php echo $_GET['event']; ?>" class="textfeld" size="17" name="id">
<table>
<tr>
	<td>Event</td>
	<td><input type="text" value="<?php echo $event['EVENT']; ?>" class="textfeld" size="17" name="event"></td>
</tr>
<tr>
	<td>Ort</td>
	<td><input type="text" value="<?php echo $event['ORT']; ?>" class="textfeld" size="17" name="ort"></td>
</tr>
<tr>
	<td>Datum</td>
	<td><input type="text" value="<?php echo $event['DATUM']; ?>" readonly class="textfeld" size="17" name="datum" value="">
		
		<script language="JavaScript">
		new tcal ({
			// form name
			'formname': 'input',
			// input name
			'controlname': 'datum'
		});
		</script></td>
</tr>
<tr>
	<td>Uhrzeit</td>
	<td><input type="text" value="<?php echo $event['UHRZEIT']; ?>" class="textfeld" size="17" name="uhrzeit"></td>
</tr>
<tr>
	<td>Anmerkung</td>
	<td><input type="text" value="<?php echo $event['ANMERKUNG']; ?>" class="textfeld" size="17" maxlength="140" name="anmerkung"></td>
</tr>
<tr>
	<td>Anzahl der Teilnehmer</td>
	<td><input type="text" value="<?php echo $event['ANZAHL']; ?>" class="textfeld" size="17" name="teilnehmer"></td>
</tr>
<tr>
	<td colspan="2">
	<input align="center" type="submit" value="OK">
	</td>
</tr>
</table>
</form>
</body>
</html>