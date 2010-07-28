<?php

//usercp/passwort.php

ob_start();
session_start();
require_once "../../includes/dbconnect.php";
require_once "../../includes/functions.php";

if(!access(0)) die();

	$result = get_table_where("benutzer", "*", "ID = ".$_SESSION['ID']." AND PASSWORT = '".md5($_POST['alt'])."'");
	if ($result->num_rows) {
		if(isset($_POST['neu']) && $_POST['neu'] == $_POST['nochmal']){
			$passwort = md5($_POST['neu']);
			$sql = "UPDATE benutzer 
					SET PASSWORT = '".$passwort."' 
					WHERE ID = ".$_SESSION['ID']." 
					LIMIT 1" ;
			$result = $db->query($sql);
			$_SESSION['password'] = $passwort;
			header('Location:../index.php');
		}else{
			die("Die Passwörter stimmen nicht überein");
		}
	}else{
		die("Das alte Passwort wurde falsch eingegeben");
	}




?>