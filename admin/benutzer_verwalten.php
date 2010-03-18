<?php

session_start();
require_once "../includes/dbconnect.php";
require_once "../includes/functions.php";
require_once "../includes/classes_admin.php";


if(!access(1)) die();
	//admin/benutzer_verwalten.php

	$result = get_table("benutzer", "*", "`benutzer`.`ID` ASC");

	while ($row = $result->fetch_assoc()) {
		$benutzer_array[]=$row;
	}

	$output = array();

	foreach ($benutzer_array as $benutzer):
		$output[] = new admin_user_output($benutzer['ID'],
										$benutzer['NAME'],
										$benutzer['RECHTE'],
										$benutzer['EMAIL']);
	endforeach;

	//OUTPUT
	include("templates/admin_user.php");
	
?>





