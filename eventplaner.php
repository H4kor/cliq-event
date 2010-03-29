<?php

session_start();
require_once "includes/dbconnect.php";
require_once "includes/functions.php";
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
						->Teilnehmer(Array) ->Schl�ssel = ID des Teilnehmers
												->datum
												->1 oder -1 f�r Teilnahme oder Absage
$benutzer_array		->Array  mit Namen aller Benutzer
					Key = ID des Benutzers
					Inhalt = Name des Benutzer
$benutzer_flip_array	->Selbe wie $benutzer_array jedoch Key und Inhalt vertauscht
$userids			->Array im IDs der Nutzer
					Key = Laufnummer beginnend bei 1 (Key 0 hat den Wert -1000)
					Inhalt = IDs
						IDs sind aufsteigend geordnet
$anzahl_benutzer		->Anzahl aller Nutzer
$tabelle			->2D-Array das die auszugebende Elemente enth�lt
$mehr 			->$anzahl_events(nach Ab�nderung) + 5
$weniger			->$anzahl_events(nach Ab�nderung) - 5
$rolspan			->$anzahl_benutzer +2
*/

if(!access(0)) die();
require("includes/classes_events.php");

//Alle Gruppen des Users auslesen
$groups = array();
$result = get_table_where("groups_member", "GROUPID", "USERID = ".$_SESSION['ID']."");
while ($row = $result->fetch_assoc()) { 
	$groups[] = $row['GROUPID'];
}


//Zeit herausfinden (wird in index.php erledigt);
date_default_timezone_set("Europe/Paris");
$heute = date("Y-m-d");

//Tabellen_array erstellen
$tabelle = array();

//Events abrufen, nur events in der zukunft
$result = get_table_where_order("events", "*", "`events`.`DATUM` >= '".$heute."'" ,"`events`.`DATUM` ASC");

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
$anzahl_benutzer = 0;
$userids = array();
$userids[] = -1000;
while ($row = $result->fetch_assoc()) {
	$groups_user = array();
	$result2 = get_table_where("groups_member", "GROUPID", "USERID = ".$row['ID']."");
	while ($row2 = $result2->fetch_assoc()) { 
		$groups_user[] = $row2['GROUPID'];
	}
	$test_groups = array_intersect($groups, $groups_user);
	if( !empty($test_groups) || $row['ID'] == $_SESSION['ID']){ 
		$benutzer_array[$row['ID']]=$row;
		$benutzer_array_to_flip[$row['ID']]=$row['NAME'];
		$userids[] = $row['ID'];
		$anzahl_benutzer++;
	}
}

//Array kopieren jedoch Schl�ssel und Inhalt vertauschen
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
foreach($events_array as $event_temp){
	$groups_event = array();
	$result2 = get_table_where("groups_events", "GROUPID", "EVENTID = ".$event_temp['ID']."");
	while ($row2 = $result2->fetch_assoc()) { 
		$groups_event[] = $row2['GROUPID'];
	}
	$test_groups = array_intersect($groups, $groups_event);

	if( !empty($test_groups)){ 
		//Teilnehm- und Abmeldebutton festlegen
		$result = get_table_where("teilnahmen", "*", "EVENTID = ".$event_temp['ID']." 
													  AND BENUTZERID = ".$benutzer_flip_array[$_SESSION['name']]."");
		if (!$result->num_rows) {
			$temp_logged = "FALSE";
		}else{
			$temp_logged = "TRUE";
		}
		
		//Objekt in Tabelle einf�gen			
		$tabelle[0][] = new event_output($event_temp['EVENT'], 
										$event_temp['ORT'], 
										$benutzer_array[$event_temp['BESITZERID']]["NAME"],
										date( "d.m.y", strtotime($event_temp['DATUM'])), 
										$event_temp['UHRZEIT'], 
										$event_temp['ANZAHL'], 
										$event_temp['ANMERKUNG'], 
										$temp_logged, 
										$event_temp['ID']);
		
		//F�r jeden Benutzer �berpr�fen ob er teilnimmt und in die Tabelle eintragen
		//Teilnahmen mitz�hlen und ans Ende der Tabelle schreiben
		$anzahl_teilnahmen = 0;
		for($k=1;$k<=$anzahl_benutzer;$k++){
			if(isset($event_temp['Teilnehmer'][$userids[$k]])){
				if($event_temp['Teilnehmer'][$userids[$k]]['ok'] == 1){
					$tabelle[$k][]=new participation_output("ok", "JA", date( "d.m.y", strtotime($event_temp['Teilnehmer'][$userids[$k]]['datum'])) );
					$anzahl_teilnahmen++;
				}else{
					$tabelle[$k][]=new participation_output("not_ok", "NEIN", date( "d.m.y", strtotime($event_temp['Teilnehmer'][$userids[$k]]['datum'])) );
				}
			}else{
				$tabelle[$k][]=new participation_output("", "", "" );
			}
		}
		if($anzahl_teilnahmen >= $event_temp['ANZAHL']){
			$tabelle[$k][] = new count_output($anzahl_teilnahmen, "TRUE");
		}else{
			$tabelle[$k][] = new count_output($anzahl_teilnahmen, "FALSE");
		}
		
		$result = get_table_where("kommentare", "*", "`EVENTID` = '".$event_temp['ID']."'");

		$anzahl_kommentare = $result->num_rows;
		$tabelle[$k+1][] = new comments_link_output($anzahl_kommentare, $event_temp['ID']);
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
$rolspan = $anzahl_benutzer+2;


//AUSGABE
include("templates/eventplaner.php");
?>