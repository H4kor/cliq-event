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
		
	$event_object = new usercp_event_output($events_array[$i]['EVENT'], 
											$events_array[$i]['ORT'], 
											date( "d.m.y", strtotime($events_array[$i]['DATUM'])), 
											$events_array[$i]['UHRZEIT'], 
											$events_array[$i]['teilnahmen'],
											$events_array[$i]['ANZAHL'],
											$events_array[$i]['ANMERKUNG'],
											$events_array[$i]['ID']);

	//String in Tabelle einfügen			
	$tabelle[] = $event_object;
}

//Status
$results = get_table_where("benutzer", "STATUS, AWAY", "ID = '".$_SESSION['ID']."'");

while ($row = $results->fetch_assoc()) {
	$status = $row['STATUS'];
	$away =  $row['AWAY'];
}


//Ausgabe
include ("templates/usercp.php");
?>
