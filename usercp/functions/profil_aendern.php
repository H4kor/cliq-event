<?php

//usercp/profil_aendern.php

ob_start();
session_start();
require_once "../../includes/dbconnect.php";
require_once "../../includes/functions.php";

if(!access(0)) die();

	$result = get_table_where("benutzer", "*", "ID = ".$_SESSION['ID']." ");
	if ($result->num_rows) {
			$passwort = md5($_POST['neu']);
			$sql = "UPDATE benutzer 
					SET ICQ = '".$_POST['icq']."' 
					WHERE ID = ".$_SESSION['ID']." 
					LIMIT 1" ;
			$result = $db->query($sql);
			header('Location:../index.php');
	}else{
		die("Es ein Fehler unterlaufen");
	}

?>