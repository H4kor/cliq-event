<?php
//teilnehmen.php
ob_start();
session_start();
include "../includes/dbconnect.php";
include "../includes/functions.php";
if(access(0)){
	$heute = date("Y-m-d");
	$result = get_table_where("teilnahmen", "*", "BENUTZERID = '".$_SESSION['ID']."' 
											  AND EVENTID = '".$_GET['event']."'");
	if($result->num_rows == 1){
		echo"Nicht erfolgreich";
	}else{
		$sql = 'INSERT INTO
	            teilnahmen(BENUTZERID, EVENTID, TEILNAHME, DATUM)
				VALUES
					("'.$_SESSION['ID'].'","'.$_GET['event'].'","'.$_GET['set'].'", "'.$heute.'");';
		$result = $db->query($sql);
		if (!$result) {
	    die ('Etwas stimmte mit dem Query nicht: '.$db->error);
		}
			var_dump($db, $result);   
	}
	header('Location:../index.php');
}
?>

