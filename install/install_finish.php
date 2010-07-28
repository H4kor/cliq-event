<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//DE" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
<html>
<head>
	<meta name="robots" content="noindex">
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<title>Unsere Clique - Installation </title>
</head>
<body>
<?php
//install/install_finish.php

$titel = $_POST["titel"];
$dbname = $_POST["dbname"];
$dbuser = $_POST["dbuser"];
$dbpassword = $_POST["dbpassword"];
$adminname = $_POST["adminname"];
$adminpassword = $_POST["adminpassword"];
$email = $_POST["email"]; 
$smtp = $_POST["smtp"]; 

//getting main folder
$str = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
$arr = explode( "/", $str);
array_pop($arr);
array_pop($arr);
$main_folder = "http://";
foreach ($arr as $part):
	$main_folder .= $part."/";
endforeach;

if($dbname != "" && $dbuser != "" && $adminname != "" && $adminpassword != "" && $titel != "")
{
	$db = @new mysqli('localhost', $dbuser, $dbpassword, $dbanme);
	if (mysqli_connect_errno()) 
	{
		$_SESSION['fehler'] = "datenbank";
		header('Location:install.php');		
	}else
	{
		include "constant_erstellen.php";
		include "db_anlegen.php";
		include "admin_anlegen.php";
		
		echo "<br><br><br><h3>Die Installation wurde erfolgreich abgeschlossen.<br> 
			  Bitte LÖSCHEN sie den GESAMTEN \"install\"-Ordner. <br> 
			  Ansonsten kann dieser ausgenutzt werden um den Eventplaner zu schädigen.</h3>";
	}	
}else{
	$_SESSION['fehler'] = "vergessen";
	header('Location:install.php');
}

?>
</body>
</html>