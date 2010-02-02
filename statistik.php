<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */


//statistik.php

session_start();

include "includes/dbconnect.php";
include "includes/functions.php";
if(!access(0))die();
//Datum herrausfinden
date_default_timezone_set("Europe/Paris");
$heute = date("Y-m-d");

$result = get_table("benutzer", "*", "`benutzer`.`ID` ASC");

$benutzer_array = array();
$anzahl_benutzer = $result->num_rows;
//$userids[] = -1000;
while ($row = $result->fetch_assoc()) {
	$benutzer_array[$row['ID']]['name']=$row['NAME'];
	$benutzer_array[$row['ID']]['Name']=$row['NAME'];
	
	$result2 = get_table_where("events", "*", "`BESITZERID` = ".$row['ID']." ");
	$benutzer_array[$row['ID']]['events']=$result2->num_rows;
	
	$result2 = get_table_where("teilnahmen", "*", "`BENUTZERID` = ".$row['ID']." ");
	$benutzer_array[$row['ID']]['teilnahmen']=$result2->num_rows;
	
	$alt = strtotime($row['LAST_LOGIN']) ;
	$aktuell = strtotime($heute) ;
	$differenz = $aktuell - $alt;
	$differenz = $differenz / 86400;

	$benutzer_array[$row['ID']]['last_login']= "";
	$benutzer_array[$row['ID']]['last_login'] .= $differenz." Tage";
		
}

?>

<?php 
//header einfügen
$seite = "Eventplaner";
include "static/header.html"; 
?>


<h2 align="center"> Statistik </h2>
Heute ist der : <?php echo date( "d.m.y", strtotime($heute)); ?>
<table border="10">
<tr>
	<td>
		Name
	</td>
	<td>
		Zeit seit letztem Login
	</td>
	<td>
		gestartete Events
	</td>
	<td>
		Teilnahmen
	</td>
</tr>

<?php
foreach ($benutzer_array as $benutzer):
?>
<tr>
	<td>
		<?php echo $benutzer['name']; ?>
	</td>
	<td>
		<?php echo $benutzer['last_login']; ?>
	</td>
	<td>
		<?php echo $benutzer['events']; ?>
	</td>
	<td>
		<?php echo $benutzer['teilnahmen']; ?>
	</td>
</tr>
<?php
endforeach;
?>

</table>
<br>

<div class="menu">
<a href="index.php">Zurück</a>
</div>

</body>
</html>