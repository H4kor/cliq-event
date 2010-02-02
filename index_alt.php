<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
// index.php
include "includes/dbconnect.php";

$sql = 'SELECT
			*
		FROM
			events';
$result = $db->query($sql);
if (!$result) {
    die ('Etwas stimmte mit dem Query nicht: '.$db->error);
}

$anzahl_events = $result->num_rows;
$events_array = array();

while ($row = $result->fetch_assoc()) {  
	$events_array[$row['ID']] = $row;
	
	$sql2 = 'SELECT
				*
			FROM	
				teilnahmen
			WHERE
				EVENTID = "'.$row['ID'].'"';
	$result2 = $db->query($sql2);
	while ($row2 = $result2->fetch_assoc()) {
		$events_array[$row['ID']]["Teilnehmer"][$row2['BENUTZERID']] = $row2['BENUTZERID'];
	}

	
}
//var_dump($events_array);


$sql = 'SELECT
			*
		FROM
			benutzer';
$result = $db->query($sql);
if (!$result) {
    die ('Etwas stimmte mit dem Query nicht: '.$db->error);
}

$benutzer_array = array();
$anzahl_benutzer = $result->num_rows;
while ($row = $result->fetch_assoc()) {  
	$benutzer_array[$row['ID']]=$row['NAME'];
}
//var_dump($benutzer_array);

//Tabellen_array erstellen
$tabelle = array();

$tabelle[0][0] = " ";
foreach ($events_array as $event):
	$tabelle[0][] = "<b>Event:</b>".$event['EVENT']."<br><br>\n
					<b>Ort:</b>".$event['ORT']."<br><br>\n
					<b>Datum:</b>".$event['DATUM']."<br><br>\n
					<b>Anzahl:</b>".$event['ANZAHL']."";
endforeach;

foreach ($benutzer_array as $benutzer):
	$tabelle[][0] = $benutzer;
endforeach;

foreach ($events_array as $event):
	//var_dump($event);
	for($i=1;$i<=$anzahl_benutzer;$i++){
		if(isset($event["Teilnehmer"][$i])){
			$tabelle[$i][$event["ID"]]="OK";
		}else{
			$tabelle[$i][$event["ID"]]="NICHT";
		}
	}
endforeach;

//var_dump($tabelle);
?>


<html>
<head>
</head>
<body>
<h2> Events </h2>
<table border="1">
<?php
for($i=0;$i<=$anzahl_events;$i++){
	echo"<tr>\n";
	for($k=0;$k<=$anzahl_benutzer;$k++){
		echo "<td>".$tabelle[$i][$k]."</td>\n";
	}
	echo"</tr>\n";
}
?>
</table>

</body>
</html>