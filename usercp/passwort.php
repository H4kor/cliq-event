<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//usercp/passwort.php

ob_start();
session_start();
require_once "../includes/dbconnect.php";
require_once "../includes/functions.php";


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
			header('Location:index.php');
		}else{
			die("Die Passwörter stimmen nicht überein");
		}
	}else{
		die("Das alte Passwort wurde falsch eingegeben");
	}




?>