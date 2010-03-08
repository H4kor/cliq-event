<?php
//functios/import_chat.php
ob_start();
session_start();
include "../includes/dbconnect.php";
include "../includes/functions.php";
if(access(0)){

	if($_POST['text'] != "")
	{
		if(isset($_GET['re_id']))
			$re_id = $_GET['re_id'];
		else
			$re_id = -1;
		$text = str_replace("\n", "<br>", $_POST['text']);
		$sql = 'INSERT INTO
	                chat(RE_TO, OWNER_ID, TEXT)
	            VALUES
	                ('.$re_id.','.$_SESSION['ID'].' , ?)';
	    $stmt = $db->prepare($sql);
	    if (!$stmt) {
	        die ('Es konnte kein SQL-Query vorbereitet werden: '.$db->error);
	    }
	    $stmt->bind_param('s', $text);
	    if (!$stmt->execute()) {
	        die ('Query konnte nicht ausgeführt werden: '.$stmt->error);
	    }
	}
	header('Location:../chat.php?re_id=-1');
}
?>
