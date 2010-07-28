<?php
session_start();
require_once "includes/dbconnect.php";
require_once "includes/functions.php";

echo $_SERVER["SITE_HTMLROOT"];

/*
$heute			-> Datum von heute
$anzahl_events		-> Anzahl der augelesenen Events(Alle die in der Zukunft liegen)
$events_array		->Array mit Daten der ausgelesenen Events
					->Laufnummer(beginnend bei 0)
						->ID
						->EVENT
						->ORT
						->DATUM
						->UHRZEIT
						->ANZAHL
						->ANMERKUNG
						->BESITZERID
						->Teilnehmer(Array) ->Schlüssel = ID des Teilnehmers
												->datum
												->1 oder -1 für Teilnahme oder Absage
$benutzer_array		->Array  mit Namen aller Benutzer
					Key = ID des Benutzers
					Inhalt = Name des Benutzer
$benutzer_flip_array	->Selbe wie $benutzer_array jedoch Key und Inhalt vertauscht
$userids			->Array im IDs der Nutzer
					Key = Laufnummer beginnend bei 1 (Key 0 hat den Wert -1000)
					Inhalt = IDs
						IDs sind aufsteigend geordnet
$anzahl_benutzer		->Anzahl aller Nutzer
$tabelle			->2D-Array das die auszugebende Elemente enthält
$mehr 			->$anzahl_events(nach Abänderung) + 5
$weniger			->$anzahl_events(nach Abänderung) - 5
$rolspan			->$anzahl_benutzer +2
*/

if(!access(0)) die();
require("includes/classes_events.php");


//Zeit herausfinden (wird in index.php erledigt);
date_default_timezone_set("Europe/Paris");
$heute = date("Y-m-d");

//Tabellen_array erstellen
$tabelle = array();

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
		$events_array[$counter]["Teilnehmer"][$row2['BENUTZERID']] = array("datum" 	=> $row2['DATUM'],
																		   "ok" 	=> $row2['TEILNAHME']);
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
	$benutzer_array[$row['ID']]=$row;
	$benutzer_array_to_flip[$row['ID']]=$row['NAME'];
	$userids[] = $row['ID'];
}

//Array kopieren jedoch Schlüssel und Inhalt vertauschen
$benutzer_flip_array = array_flip($benutzer_array_to_flip);


//Formular in die erste Zelle
$tabelle[0][0] = new formular_output();

//Benutzer in die erste Spalte ab 2. Zeile
foreach ($benutzer_array as $benutzer):
	if($benutzer['AWAY'] == 0)
		$tabelle[][0] = new user_output($benutzer['NAME'], $benutzer_flip_array[$benutzer['NAME']], "FALSE");
	else
		$tabelle[][0] = new user_output($benutzer['NAME'], $benutzer_flip_array[$benutzer['NAME']], "TRUE");
endforeach;
	$tabelle[][0] = new count_headline_output();
	$tabelle[][0] = new comments_headline_output();
	
//Events in die erste Zeile ab 2.Spalte	
for($i=0;$i<$anzahl_events;$i++){
	
	//Teilnehm- und Abmeldebutton festlegen
	$result = get_table_where("teilnahmen", "*", "EVENTID = ".$events_array[$i]['ID']." 
												  AND BENUTZERID = ".$benutzer_flip_array[$_SESSION['name']]."");
	if (!$result->num_rows) {
		$temp_logged = "FALSE";
	}else{
		$temp_logged = "TRUE";
	}
	
	//Objekt in Tabelle einfügen			
	$tabelle[0][] = new event_output($events_array[$i]['EVENT'], 
									$events_array[$i]['ORT'], 
									$benutzer_array[$events_array[$i]['BESITZERID']]["NAME"],
									date( "d.m.y", strtotime($events_array[$i]['DATUM'])), 
									$events_array[$i]['UHRZEIT'], 
									$events_array[$i]['ANZAHL'], 
									$events_array[$i]['ANMERKUNG'], 
									$temp_logged, 
									$events_array[$i]['ID']);
	
	//Für jeden Benutzer überprüfen ob er teilnimmt und in die Tabelle eintragen
	//Teilnahmen mitzählen und ans Ende der Tabelle schreiben
	$anzahl_teilnahmen = 0;
	for($k=1;$k<=$anzahl_benutzer;$k++){
		if(isset($events_array[$i]['Teilnehmer'][$userids[$k]])){
			if($events_array[$i]['Teilnehmer'][$userids[$k]]['ok'] == 1){
				$tabelle[$k][$i+1]=new participation_output("ok", "JA", date( "d.m.y", strtotime($events_array[$i]['Teilnehmer'][$userids[$k]]['datum'])) );
				$anzahl_teilnahmen++;
			}else{
				$tabelle[$k][$i+1]=new participation_output("not_ok", "NEIN", date( "d.m.y", strtotime($events_array[$i]['Teilnehmer'][$userids[$k]]['datum'])) );
			}
		}else{
			$tabelle[$k][$i+1]=new participation_output("", "", "" );
		}
	}
	if($anzahl_teilnahmen >= $events_array[$i]['ANZAHL']){
		$tabelle[$k][$i+1] = new count_output($anzahl_teilnahmen, "TRUE");
	}else{
		$tabelle[$k][$i+1] = new count_output($anzahl_teilnahmen, "FALSE");
	}
	
	$result = get_table_where("kommentare", "*", "`EVENTID` = '".$events_array[$i]['ID']."'");

	$anzahl_kommentare = $result->num_rows;
	$tabelle[$k+1][$i+1] = new comments_link_output($anzahl_kommentare, $events_array[$i]['ID']);
			
}

//Anzahl der angezeigten Events anzeigen
$anzeigen = 3 ;

if($anzahl_events < $anzeigen && !isset($_GET['more']))
	$anzeigen = $anzahl_events;
if(isset($_GET['more'])){
	$anzeigen = $_GET['more'];
	if($anzeigen > $anzahl_events)
		$anzeigen = $anzahl_events;
}
if($anzeigen < 0)
	$anzeigen = 0;

$mehr = $anzeigen+3;
$weniger = $anzeigen-3;
$rolspan = $anzahl_benutzer+2;


//AUSGABE
include("templates/eventplaner.php");
?>