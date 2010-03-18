<?php
//usercp/benutzer_loeschen.php
ob_start();
session_start();

	include "../../includes/dbconnect.php";
	include "../../includes/functions.php";
if(access(1)){
	$sql = "DELETE 
			FROM `benutzer` 
			WHERE `benutzer`.`ID` = ".$_GET['id']."  
			LIMIT 1";
	$result = $db->query($sql);
	if (!$result) {
	    die ('Etwas stimmte mit dem Query nicht: '.$db->error);
		var_dump($db, $result);   
	}
	header('Location:../benutzer_verwalten.php');
}else
die("");
	

?>