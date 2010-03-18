<?php
//usercp/admin_geben.php
ob_start();
session_start();
if($_SESSION['rechte'] == 1){
	include "../../includes/dbconnect.php";
	include "../../includes/functions.php";

				$sql = "UPDATE `benutzer` 
				SET `RECHTE` = '1' 
				WHERE `benutzer`.`ID` =".$_GET['id']." 
				LIMIT 1 ; ;" ;
				$result = $db->query($sql);
				if (!$result) {
				    die ('Etwas stimmte mit dem Query nicht: '.$db->error);
					var_dump($db, $result);   
				}
	header('Location:../benutzer_verwalten.php');
}else
die("");
	
?>
