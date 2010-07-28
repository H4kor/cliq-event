<?php

//usercp/update_profil.php

ob_start();
session_start();
require_once "../../includes/dbconnect.php";
require_once "../../includes/functions.php";

if(!access(0)) die();
	var_dump($_POST['away']);
	if(isset($_POST['away']))
		$away = 1;
	else
		$away = 0;
	$result = get_table_where("benutzer", "*", "ID = ".$_SESSION['ID']." ");
	if ($result->num_rows) {
			$passwort = md5($_POST['neu']);
			$sql = "UPDATE benutzer 
					SET `STATUS` =  '".$_POST['status']."',
						`AWAY` = '".$away."'
					WHERE ID = ".$_SESSION['ID']." 
					LIMIT 1" ;
			$result = $db->query($sql);
			header('Location:../index.php');
	}else{
		die("Es ein Fehler unterlaufen");
	}

?>