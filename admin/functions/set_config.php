<?php
//admin/set_config.php

ob_start();
session_start();

	require_once "../../includes/dbconnect.php";
	require_once "../../includes/functions.php";
if(access(1)){
	$daten = "
	<?php
	define('TITEL', '".$_POST['title']."');
	define('DBNAME', '".DBNAME."');
	define('DBUSER', '".DBUSER."');
	define('DBPASSWORD', '".DBPASSWORD."');
	define('SMTP', '".$_POST['smtp']."');
	define('MAIN_EMAIL', '".$_POST['email']."');
	?>
	";
	$dateihandle = fopen("../../includes/constant.php","w");

	fwrite($dateihandle, $daten);

	header('Location:../config.php');
}
?>