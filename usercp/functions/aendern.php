<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//usercp/aendern.php
ob_start();
session_start();
if($_SESSION['RECHTE'] != -1){
	include "../../includes/dbconnect.php";
	include "../../includes/functions.php";

				$sql = "UPDATE `events` 
					SET `EVENT` = '".$_POST['event']."',
						`ORT` = '".$_POST['ort']."',
						`DATUM` = '".$_POST['datum']."',
						`ANZAHL` = '".$_POST['teilnehmer']."',
						`UHRZEIT` = '".$_POST['uhrzeit']."',
						`ANMERKUNG` = '".$_POST['anmerkung']."' 
						WHERE `ID` = ".$_POST['id']." 
						LIMIT 1 ;" ;
				$result = $db->query($sql);
				if (!$result) {
					die ('Etwas stimmte mit dem Query nicht: '.$db->error);
					var_dump($db, $result);   
				}
	header('Location:../index.php');
}else
die("KEIN MISSBRAUCH!!!!!!!!!!!!!!!!!!!!!!!!!!!");
	

?>