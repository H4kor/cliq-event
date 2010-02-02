<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//kommentare.php
session_start();

require_once "includes/dbconnect.php";
require_once "includes/functions.php";
require_once "includes/constant.php";

if(!access(0))die();

$ausgabe = "";

	$event = "";
	$result2 = get_table_where("events", "*", "`ID` = ".$_GET['id']."");
	while ($row2 = $result2->fetch_assoc()) {  
		$event = $row2['EVENT'];
	}

$result = get_table_where_order("kommentare", "*", "`EVENTID` = ".$_GET['id'].""," `DATUM` DESC");
while ($row = $result->fetch_assoc()) {  
	$name = "";
	$result2 = get_table_where("benutzer", "*", "`ID` = ".$row['BENUTZERID']."");
	while ($row2 = $result2->fetch_assoc()) {  
		$name = $row2['NAME'];
	}
	$ausgabe .= "
	Von: ".$name."
	<br><br>
	".$row['KOMMENTAR']."<br><hr><br>";
}


?>

<?php
//header einfügen
$seite = "Kommentare";
include "static/header.html"; 

?>
<!-- TinyMCE -->
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<!-- /TinyMCE -->


<h2>Kommentare zu <?php echo $event; ?></h2>

<h4>Kommentar schreiben</h4>

<td class='formular'>
<form action="import_kommentar.php?id= <?php echo $_GET['id'] ?> " method="post" name="input">
Kommentar<br>
<textarea cols="40" rows="5" class="textfeld" name="kommentar">
Hier Kommentar schreiben
</textarea>
<br>
<input type="submit" value="OK">
</form>

<hr>
<?php
echo $ausgabe;
?>

</body>
</html>
