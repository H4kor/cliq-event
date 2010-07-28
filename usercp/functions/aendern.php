<?php

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