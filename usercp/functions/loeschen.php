<?php
//functions/loeschen.php

ob_start();
session_start();
include "../../includes/dbconnect.php";
include "../../includes/functions.php";
if(access(0)){
	$sql = 'DELETE 
				FROM events 
				WHERE BESITZERID = '.$_SESSION['ID'].'
					AND ID = '.$_GET['event'].'
				LIMIT 1';
	$result = $db->query($sql);
	if (!$result) {
    die ('Etwas stimmte mit dem Query nicht: '.$db->error);

	var_dump($db, $result);   
	}
	header('Location:../index.php');
}
?>