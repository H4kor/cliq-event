<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//login.php
?>
<?php 
//header einfügen
$seite = "Login";
include "templates/overall_header.php"; 
?>


<h2> Bitte einloggen um Zugang zum Portal zu erhalten </h2>

<form action="index.php" method="POST">
	<div>Name:</div><input class="textfeld" type="text" size="32" name="name">
	<div>Passwort:</div><input class="textfeld" type="password" size="32" name="password"><br>
	<input type="submit" name="Name" value="Login">
</form>
</body>
</html>