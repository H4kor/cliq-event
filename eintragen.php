<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */s
//eintragen.php
if(!access(0))die();
?>
<form target="_blank" action="import_eintragen.php" method="post">
Event<br>
<input type="text" size="17" name="event"><br>
Ort<br>
<input type="text" size="17" name="ort"><br>
Datum<br>
<input type="text" size="17" name="datum"><br>
Anzahl der Teilnehmer<br>
<input type="text" size="17" name="teilnehmer">
<br><br>
<input type="submit" value="OK">
</form>
