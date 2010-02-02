<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
// ausgabe.php

//Zeit herausfinden
date_default_timezone_set("Europe/Paris");
$heute = date("Y-m-d");
//Events abrufen, nur events in der zukunft
$result = get_table_where_order("events", "*", "`events`.`DATUM` >= '".$heute."'" ,"`events`.`DATUM` ASC");


$anzahl_events = $result->num_rows;
$events_array = array();
									
//Inhalt der Datenbank in ein Array schreiben
//Zu jedem Event abfragen wer sich beteiligt
$counter = 0;
while ($row = $result->fetch_assoc()) {  
	$events_array[$counter] = $row;

	$result2 = get_table_where("teilnahmen", "*", "EVENTID = ".$row['ID']."");
	//Abfrage der Beteiligung
	while ($row2 = $result2->fetch_assoc()) {
		$events_array[$counter]["Teilnehmer"][$row2['BENUTZERID']] = $row2['BENUTZERID'];
	}
	$counter++;	
}


//Alle Benutzer auslesen und in einem Array speichern sortiert nach der ID
$result = get_table("benutzer", "*", "`benutzer`.`ID` ASC");
if (!$result) {
    die ('Etwas stimmte mit dem Query nicht: '.$db->error);
}

$benutzer_array = array();
$anzahl_benutzer = $result->num_rows;
while ($row = $result->fetch_assoc()) {
	$benutzer_array[$row['ID']]=$row['NAME'];
}

//Array kopieren jedoch Schlüssel und Inhalt vertauschen
$benutzer_flip_array = array_flip($benutzer_array);


//Tabellen_array erstellen
$tabelle = array();

//Formular in die erste Zelle
$tabelle[0][0] = "
<td class='formular'>
<form action=\"import.php\" method=\"post\" name=\"input\">
Event<br>
<input type=\"text\" class=\"textfeld\" size=\"17\" name=\"event\"><br>
Ort<br>
<input type=\"text\" class=\"textfeld\" size=\"17\" name=\"ort\"><br>
Datum<br>
<input type=\"text\" readonly class=\"textfeld\" size=\"17\" name=\"datum\" value=\"\">
	
	<script language=\"JavaScript\">
	new tcal ({
		// form name
		'formname': 'input',
		// input name
		'controlname': 'datum'
	});
	</script>

Uhrzeit<br>
<input type=\"text\" class=\"textfeld\" size=\"17\" name=\"uhrzeit\"><br>
Anmerkung<br>
<input type=\"text\" class=\"textfeld\" size=\"17\" maxlength=\"140\" name=\"anmerkung\"><br>
Anzahl der Teilnehmer<br>
<input type=\"text\" class=\"textfeld\" size=\"17\" name=\"teilnehmer\">
<br><br>
<input type=\"submit\" value=\"OK\">
</form>
";

//Benutzer in die erste Spalte ab 2. Zeile
foreach ($benutzer_array as $benutzer):
	$tabelle[][0] = "<td class='benutzer'>".$benutzer."</td>";
endforeach;
	$tabelle[][0] = "<td class='anzahltest'>Anzahl Teilnehmer</td>";
	
//Events in die erste Zeile ab 2.Spalte	
for($i=0;$i<$anzahl_events;$i++){
	
	
	$event_string = "<td class='event'><b class='yellow'>Event:<br> </b></font>".$events_array[$i]['EVENT']."<br>\n
					<b class='yellow'>Ort:<br> </b>".$events_array[$i]['ORT']."<br><br>\n
					<b class='yellow'>Initiator:<br> </b>".$benutzer_array[$events_array[$i]['BESITZERID']]."<br><br>\n
					<b class='yellow'>Datum: </b>".date( "d.m.y", strtotime($events_array[$i]['DATUM']))."<br>\n
					<b class='yellow'>Uhrzeit:<br> </b>".$events_array[$i]['UHRZEIT']."<br><br>\n
					<b class='yellow'>erford. Teilnehmer: </b>".$events_array[$i]['ANZAHL']."<br><br>\n
					<div class='anmerkung'><b class='yellow'>Anmerkung:<br> </b>".$events_array[$i]['ANMERKUNG']."</div><br>\n";
					
	
	//Für den Ersteller den Löschbutton einfügen
	/*
	$result = get_table_where("events", "*", "ID = ".$events_array[$i]['ID']." AND BESITZERID = ".$_SESSION['ID']."");
	if ($result->num_rows) {
		$event_string = $event_string."<a class=\"loeschen\" href=\"loeschen.php?event=".$events_array[$i]['ID']."\" >LÖSCHEN</a>";
	}
	*/
	
	//Für alle den Teilnehm- und Abmeldebutton einfügen
	$result = get_table_where("teilnahmen", "*", "EVENTID = ".$events_array[$i]['ID']." AND BENUTZERID = ".$benutzer_flip_array[$_SESSION['name']]."");
	if (!$result->num_rows) {
		$event_string = $event_string."<a href=\"teilnehmen.php?event=".$events_array[$i]['ID']."\" >teilnehmen</a>\n";
	}else{
		$event_string = $event_string."<a href=\"abmelden.php?event=".$events_array[$i]['ID']."\" >abmelden</a>\n";
	}
	
//String beenden
$event_string = $event_string."</td>";

	
	//String in Tabelle einfügen			
	$tabelle[0][] = $event_string;
	
	//Für jeden Benutzer überprüfen ob er teilnimmt und in die Tabelle eintragen
	//Teilnahmen mitzählen und ans Ende der Tabelle schreiben
	$anzahl_teilnahmen = 0;
	for($k=1;$k<=$anzahl_benutzer;$k++){
		if(isset($events_array[$i]['Teilnehmer'][$k])){
			$tabelle[$k][$i+1]="<td class='ok'>OK</td>\n";
			$anzahl_teilnahmen++;
		}else{
			$tabelle[$k][$i+1]="<td class='nicht'>.</td>\n";
		}
	}
	if($anzahl_teilnahmen >= $events_array[$i]['ANZAHL']){
		$tabelle[$k][$i+1] = "<td class='genug' >$anzahl_teilnahmen - findet statt</td>\n";
	}else{
		$tabelle[$k][$i+1] = "<td class='wenig' >$anzahl_teilnahmen</td>\n";
	}
		
}

//Anzahl der angezeigten Events anzeigen
if($anzahl_events > 5 && !isset($_GET['more']))
	$anzahl_events = 5;
if(isset($_GET['more']) && $_GET['more'] < $anzahl_events){
	$anzahl_events = $_GET['more'];
	if($anzahl_events < 5)
		$anzahl_events = 5;
}
$mehr = $anzahl_events+5;
$weniger = $anzahl_events-5;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//DE" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
<html>
<head>
	<meta name="robots" content="noindex">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script language="JavaScript" src="calendar_db.js"></script>
	<link rel="stylesheet" href="calendar.css">
	
	<title>Unsere Clique - WIR unter UNS </title>
</head>
<body>

<h2 align="center"> Eventplaner </h2>
<h4> Heute ist der : <?php echo $heute; ?>
<table border="10">
<?php
//Alles ausgeben	
for($i=0;$i<=$anzahl_benutzer+1;$i++){
	echo"<tr>\n";
	for($k=0;$k<=$anzahl_events;$k++){
		echo $tabelle[$i][$k];
	}
		if($i==0){
		echo "<th rowspan=\"14\"><a href=\"index.php?more=". $mehr ."\">mehr</a>\n";
		echo "<a href=\"index.php?more=". $weniger ."\">weniger</a></th>\n";
	}
	echo"</tr>\n";
}

?>
<tr>

</tr>
</table>
<br>
<div class="menu">
<a href="logout.php">Logout</a>
<a href="usercp/index.php">Control-Panel</a>
</div>






</body>
</html>