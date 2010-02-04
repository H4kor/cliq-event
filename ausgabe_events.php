<?php
//Zeit herausfinden (wird in index.php erledigt);
global $heute;
global $tabelle;
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
		$events_array[$counter]["Teilnehmer"][$row2['BENUTZERID']] = $row2['DATUM'];
	}
	$counter++;	
}

//Alle Benutzer auslesen und in einem Array speichern sortiert nach der ID
$result = get_table("benutzer", "*", "`benutzer`.`ID` ASC");

$benutzer_array = array();
$anzahl_benutzer = $result->num_rows;
$userids = array();
$userids[] = -1000;
while ($row = $result->fetch_assoc()) {
	$benutzer_array[$row['ID']]=$row['NAME'];
	$userids[] = $row['ID'];
}

//Array kopieren jedoch Schlüssel und Inhalt vertauschen
$benutzer_flip_array = array_flip($benutzer_array);


//Formular in die erste Zelle
$tabelle[0][0] = "
<td class='formular'>
<form action=\"import_event.php\" method=\"post\" name=\"input\">
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
	$tabelle[][0] = "<td class='benutzer'><a href='ausgabe_profil.php?user=".$benutzer_flip_array[$benutzer]."'>".$benutzer."</a></td>";
endforeach;
	$tabelle[][0] = "<td class='anzahltest'>Anzahl Teilnehmer</td>";
	$tabelle[][0] = "<td class='anzahltest'>Kommentare</td>";
	
//Events in die erste Zeile ab 2.Spalte	
for($i=0;$i<$anzahl_events;$i++){
	
	$event_string = "<td class='event'><b class='yellow'>Event: </b></font>".$events_array[$i]['EVENT']."<br>\n
					<b class='yellow'>Ort: </b>".$events_array[$i]['ORT']."<br><br>\n
					<b class='yellow'>Initiator: </b>".$benutzer_array[$events_array[$i]['BESITZERID']]."<br><br>\n
					<b class='yellow'>Datum: </b>".date( "d.m.y", strtotime($events_array[$i]['DATUM']))."<br>\n
					<b class='yellow'>Uhrzeit: </b>".$events_array[$i]['UHRZEIT']."<br><br>\n
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
	$result = get_table_where("teilnahmen", "*", "EVENTID = ".$events_array[$i]['ID']." 
												  AND BENUTZERID = ".$benutzer_flip_array[$_SESSION['name']]."");
	if (!$result->num_rows) {
		$event_string = $event_string."<a href=\"anmelden.php?event=".$events_array[$i]['ID']."\" >teilnehmen</a>\n";
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
		if(isset($events_array[$i]['Teilnehmer'][$userids[$k]])){
			$tabelle[$k][$i+1]="<td class='ok'>OK ".date( "d.m.y", strtotime($events_array[$i]['Teilnehmer'][$userids[$k]]))."</td>\n";
			$anzahl_teilnahmen++;
		}else{
			$tabelle[$k][$i+1]="<td class='nicht'> </td>\n";
		}
	}
	if($anzahl_teilnahmen >= $events_array[$i]['ANZAHL']){
		$tabelle[$k][$i+1] = "<td class='genug' >$anzahl_teilnahmen - findet statt</td>\n";
	}else{
		$tabelle[$k][$i+1] = "<td class='wenig' >$anzahl_teilnahmen</td>\n";
	}
	
	$result = get_table_where("kommentare", "*", "`EVENTID` = '".$events_array[$i]['ID']."'");

	$anzahl_kommentare = $result->num_rows;
	if($anzahl_kommentare != 1)
		$tabelle[$k+1][$i+1] = "<td><a href='kommentare.php?id=".$events_array[$i]['ID']."'>".$anzahl_kommentare." Einträge</a></td>";
	else
		$tabelle[$k+1][$i+1] = "<td><a href='kommentare.php?id=".$events_array[$i]['ID']."'>1 Eintrag</a></td>";
		
}
?>