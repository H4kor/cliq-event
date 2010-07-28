<?php
//functions/import_event.php
ob_start();
session_start();
include "../includes/dbconnect.php";
include "../includes/functions.php";
if(access(0)){
	$event = $_POST["event"];
	$ort = $_POST["ort"];
	$datum = $_POST["datum"];
	$teilnehmer = $_POST["teilnehmer"];
	$uhrzeit = $_POST["uhrzeit"];
	$anmerkung = $_POST["anmerkung"];
	$besitzerid = $_SESSION['ID'];

	if($event != "" && $ort != "" && $datum != "" && $teilnehmer != "")
	{
		$sql = "INSERT 
				INTO events (EVENT, ORT, DATUM, ANZAHL, UHRZEIT, ANMERKUNG, BESITZERID) 
				VALUES (?, ?, '".$datum."', ?, ?, ?, '".$besitzerid."')";
	    $stmt = $db->prepare($sql);
	    if (!$stmt) {
	        die ('Es konnte kein SQL-Query vorbereitet werden: '.$db->error);
	    }
	    $stmt->bind_param('ssiss', $event, $ort, $teilnehmer, $uhrzeit, $anmerkung);
	    if (!$stmt->execute()) {
	        die ('Query konnte nicht ausgeführt werden: '.$stmt->error);
	    }
	}
//TODO send email to all members	
/* 	$empfaenger = '';
	$betreff = 'Neues Event ';
	$nachricht = 'Event: '.$event.'!\ '.
				'Ort: '.$ort.'!\ '.
				'Datum: '.$datum.'!\ '.
				'Uhrzeit: '.$uhrzeit.'!\ '.
				'Anmerkung: '.$anmerkung.'!\ ';

	mail($empfaenger, $betreff, $nachricht);
 */
 header('Location:../index.php');
 }
?>
