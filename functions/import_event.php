<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
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
//coming soon	
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
