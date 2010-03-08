<?php
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

<h2>Kommentare zu <?php echo $event; ?></h2>

<div class="menu">
	<a href="index.php">Zurück</a>
</div>

<h4>Kommentar schreiben</h4>

<td class='formular'>
<form action="functions/import_kommentar.php?id= <?php echo $_GET['id'] ?> " method="post" name="input">
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
