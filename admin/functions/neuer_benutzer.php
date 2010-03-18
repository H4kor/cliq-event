<?php
ob_start();
session_start();

	require_once "../../includes/dbconnect.php";
	require_once "../../includes/functions.php";
if(access(1)){
	if($_POST['name'] != "" && $_POST['password'] != "")
	{
		$sql = "INSERT INTO benutzer (NAME, PASSWORT, RECHTE, EMAIL) VALUES ('".$_POST['name']."', '".md5($_POST['password'])."', '0', '".$_POST['email']."')";
		$result = $db->query($sql);
		if (!$result)
			die ('Etwas stimmte mit dem Query nicht: '.$db->error);
	}
	header('Location:../benutzer_verwalten.php');
}else
die("");
?>