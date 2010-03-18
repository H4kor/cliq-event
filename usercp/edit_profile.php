<?php
//edit_profil.php
session_start();

require_once "../includes/dbconnect.php";
require_once "../includes/functions.php";


if(!access(0)) die();

$result = get_table_where("benutzer", "*", "ID = '".$_SESSION['ID']."'");
while ($row = $result->fetch_assoc()) {
	$user = $row['NAME'];
	$email = $row['EMAIL'];
	$rechte = $row['RECHTE'];
	$icq = $row['ICQ'];
	$status = $row['STATUS'];
}
//AUSGABE

include ("templates/edit_profile.php");
?>

