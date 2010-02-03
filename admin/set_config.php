<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//admin/set_config.php

ob_start();
session_start();

	require_once "../includes/dbconnect.php";
	require_once "../includes/functions.php";
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
	$dateihandle = fopen("../includes/constant.php","w");

	fwrite($dateihandle, $daten);

	header('Location:index.php');
}
?>