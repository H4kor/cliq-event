<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//admin/config.php

session_start();
require_once "../includes/dbconnect.php";
require_once "../includes/functions.php";
require_once "../includes/constant.php";

?>

<?php 
//header einfügen
$seite = "Konfiguration";
include "../static/header.html"; 
?>

<a class="menu" href="index.php">Zurück</a>
<div style="float:left">
<p> </p>

<h2> Konfiguration </h2>

<td class='formular'>
<form action="set_config.php" method="post" name="input">
Titel:<br>
<input type="text" class="textfeld" size="17" name="title" value="<?php echo TITEL; ?>"><br>
	
	<div>Datenbank:</div><input class="textfeld" type="text" size="32" name="dbname" value="<?php echo DBNAME; ?>"><br>
	<div>Datenbanknutzer:</div><input class="textfeld" type="text" size="32" name="dbuser"  value="<?php echo DBUSER; ?>"><br>
	<div>Datenbankpasswort:</div><input class="textfeld" type="password" size="32" name="dbpassword" value="<?php echo DBPASSWORD; ?>"><br>
	
Haupt-Email-Adresse:<br>
<input type="text" class="textfeld" size="17" name="email" value="<?php echo MAIN_EMAIL; ?>"><br>
SMTP-Server:<br>
<input type="text" class="textfeld" size="17" name="smtp" value="<?php echo SMTP; ?>"><br>
<br>
<input type="submit" value="OK">
</form>

<br>
</body>
</html>