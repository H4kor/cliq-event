<?php
/* Clique-Eventplaner - Ein Eventplaner f�r Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//admin/config.php

session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//DE" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
<html>
<head>
	<meta name="robots" content="noindex">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script language="JavaScript" src="../calendar_db.js"></script>
	<link rel="stylesheet" href="../calendar.css">
	
	<title><?php echo TITEL; ?> - Admin - Konfiguration </title>
</head>
<body>
<a class="menu" href="../index.php">Zur�ck</a>
<div style="float:left">
<p>�</p>
<!--
<h2> Konfiguration </h2>


<h4>Email-Einstellung</h4>

<td class='formular'>
<form action="set_config.php" method="post" name="input">
Titel:<br>
<input type="text" class="textfeld" size="17" name="title" value="<?php echo TITEL; ?>"><br>
Haupt-Email-Adresse:<br>
<input type="text" class="textfeld" size="17" name="email" value="<?php echo MAIN_EMAIL; ?>"><br>
SMTP-Server:<br>
<input type="text" class="textfeld" size="17" name="smtp" value="<?php echo SMTP; ?>"><br>
<br>
<input type="submit" value="OK">
</form>
-->
<br>
</body>
</html>