<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
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