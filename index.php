<?php
// index.php
ob_start();
session_start();

require_once "includes/dbconnect.php";
require_once "includes/functions.php";


//Datum herrausfinden
date_default_timezone_set("Europe/Paris");
$heute = date("Y-m-d");

if(isset($_POST['name']) && isset($_POST['password'])){
	if(trim($_POST['name']) != "" || trim($_POST['password']) != ""){
		$result = get_table_where("benutzer", "*", "NAME = '".$_POST['name']."' 
												AND PASSWORT = '".md5($_POST['password'])."'");
		if($result->num_rows == 1){
			while ($row = $result->fetch_assoc()) {  
				$_SESSION['ID'] = $row['ID'];
				$_SESSION['rechte'] = $row['RECHTE'];
				$_SESSION['email'] = $row['EMAIL'];
			}
			$_SESSION['name'] = $_POST['name'];
			$_SESSION['password'] = md5($_POST['password']);	
			$_SESSION['status'] = "logged_in";
		}else{
			$_SESSION['status'] = "failed";
		}	
	}else{
		$_SESSION['status'] = "failed";
	}
}

if($_SESSION['status'] == "failed"){
	echo "<h1>Die Eingaben waren falsch!</h1>";
}

if(!isset($_SESSION['name']) && !isset($_SESSION['password'])){
	include "templates/login.php";
}else{
	if($_SESSION['status'] == "logged_in"){
		header('Location:eventplaner.php');
		update_timestamp($_SESSION['ID']);
	}
}

?>