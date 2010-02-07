<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//usercp/ausgabe.php

//Zeit herausfinden
date_default_timezone_set("Europe/Paris");
$heute = date("Y-m-d");
//Events abrufen, nur events in der zukunft
$result = get_table_where_order("events", "*", "`events`.`DATUM` >= '".$heute."' AND BESITZERID = '".$_SESSION['ID']."'" ,"`events`.`DATUM` ASC");


$anzahl_events = $result->num_rows;
$events_array = array();

//Inhalt der Datenbank in ein Array schreiben
//Zu jedem Event abfragen wer sich beteiligt
$count =0;
while ($row = $result->fetch_assoc()) {  
	$events_array[$count] = $row;
	$result2 = get_table_where("teilnahmen", "*", "`EVENTID` = ".$row['ID']." ");
	$events_array[$count]['teilnahmen']=$result2->num_rows;
	$count ++;
}

for($i=0;$i<$anzahl_events;$i++){
	
	
	$event_string = "<td class='event'><b class='yellow'>Event:<br> </b></font>".$events_array[$i]['EVENT']."<br>\n
					<b class='yellow'>Ort:<br> </b>".$events_array[$i]['ORT']."<br><br>\n
					<b class='yellow'>Datum: </b>".date( "d.m.y", strtotime($events_array[$i]['DATUM']))."<br>\n
					<b class='yellow'>Uhrzeit:<br> </b>".$events_array[$i]['UHRZEIT']."<br><br>\n
					<b class='yellow'>erford. Teilnehmer: </b>".$events_array[$i]['teilnahmen']." / ".$events_array[$i]['ANZAHL']."<br><br>\n
					<div class='anmerkung'><b class='yellow'>Anmerkung:<br> </b>".$events_array[$i]['ANMERKUNG']."</div><br>\n";
	
	//Löschbutton einfügen
	$event_string = $event_string."<a class=\"loeschen\" href=\"../functions/loeschen.php?event=".$events_array[$i]['ID']."\" >LÖSCHEN</a>";
	//Bearbeiten einfügen
	$event_string = $event_string."<a href=\"aendern_form.php?event=".$events_array[$i]['ID']."\" >Bearbeiten</a>";
	//Rundmail einfügen
/* 	
	if($events_array[$i]['ANZAHL'] <= $events_array[$i]['teilnahmen'])
		$event_string = $event_string."<a href=\"rundmail.php?event=".$events_array[$i]['ID']."\" >Teilnehmer informieren</a>";
	else
		$event_string = $event_string."<br><br>";
 */	
	//String beenden
	$event_string = $event_string."</td>";

	
	//String in Tabelle einfügen			
	$tabelle[] = $event_string;
}

//Status
$results = get_table_where("benutzer", "STATUS", "ID = '".$_SESSION['ID']."'");

while ($row = $results->fetch_assoc()) {
	$status = $row['STATUS'];
}


//Ausgabe
?>

<?php 
//header einfügen
$seite = "Eventplaner";
include "../static/header.html"; 
?>
<div class="menu">
<a href="../index.php">Zurück</a>
<?php if($_SESSION['rechte'] == 1){ ?>
	<a href="../admin/index.php">Admin-Panel</a>
<?php } ?>
</div>

<p> </p>
<h2> User-Control-Panel </h2>


<form action="update_profil.php" method="post" name="input">
Dein Status:<input type="text" class="textfeld" size="140" name="status" value="<?php echo $status ?>">
<input type="submit" value="OK">
</form>

<h4> Deine angemeldeten Events</h4>
<table border="10">
<?php
echo"<tr>\n";
	for($i=0;$i<=$anzahl_events;$i++){
			echo $tabelle[$i];
	}
echo"</tr>\n";
?>
</table>
<br>
<div  align="center"><a href="edit_profil.php">Profil bearbeiten</a></div>


</body>
</html>