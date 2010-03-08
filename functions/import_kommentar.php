<?php
//functios/import_kommentar.php
ob_start();
session_start();
include "../includes/dbconnect.php";
include "../includes/functions.php";
if(access(0)){

	if($_GET['id'] != "" && $_POST['kommentar'] != "")
	{
		$kommentar = str_replace("\n", "<br>", $_POST['kommentar']);
		$sql = 'INSERT INTO
	                kommentare(EVENTID, BENUTZERID, KOMMENTAR)
	            VALUES
	                ('.$_GET['id'].','.$_SESSION['ID'].' , ?)';
	    $stmt = $db->prepare($sql);
	    if (!$stmt) {
	        die ('Es konnte kein SQL-Query vorbereitet werden: '.$db->error);
	    }
	    $stmt->bind_param('s', $kommentar);
	    if (!$stmt->execute()) {
	        die ('Query konnte nicht ausgeführt werden: '.$stmt->error);
	    }
	}
	header('Location:../index.php');
}
?>
