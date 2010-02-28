<?php
// ausgabe.php

/*Variablen

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

Varibalen ENDE*/
if(!access(0)) die();

//Tabellen_array erstellen
$tabelle = array();

//Fügt die Events, Benutzer, Teilnahmen in die Tabelle ein
include "ausgabe_events.php";

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
?>
<?php 
//header einfügen
$seite = "Eventplaner";
include "static/header.html"; 
?>

<h2 align="center"> Eventplaner </h2>
Heute ist der : <?php echo date( "d.m.y", strtotime($heute)); ?>

<table border="10">
	<?php
	//Alles ausgeben	
	for($i=0;$i<=$anzahl_benutzer+2;$i++){
		echo"<tr>\n";
		for($k=0;$k<=$anzahl_events;$k++){
			echo $tabelle[$i][$k];
		}
			if($i==0){

		}
		echo"</tr>\n";
	}
	?>
</table>
			<a href="index.php?more= <?php echo $mehr; ?> ">mehr</a>
			<a href="index.php?more= <?php echo $weniger; ?> ">weniger</a>
<br>
<?php include "static/menu.html"; ?>
</body>
</html>