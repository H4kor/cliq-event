<?php
//edit_profil.php
session_start();

require_once "../includes/dbconnect.php";
require_once "../includes/functions.php";


if(!access(0)) die();

$result = get_table_where("benutzer", "*", "ID = '".$_SESSION['ID']."'");
while ($row = $result->fetch_assoc()) {
	$user = $row['NAME'];
	$email = $row['EMAIL'];
	$rechte = $row['RECHTE'];
	$icq = $row['ICQ'];
	$status = $row['STATUS'];
}
//AUSGABE
?>

<?php 
//header einfügen
$seite = "Profil bearbeiten";
include "../static/header.html"; 
?>
<div class="menu"><a href="index.php">Zurück</a></div>

<h4>Dein Passwort ändern </h4>

<td class='formular'>
<form action="passwort.php" method="post" name="input">
Altes Passwort:
<input type="password" class="textfeld" size="17" name="alt"><br>
Neues Passwort:
<input type="password" class="textfeld" size="17" name="neu"><br>
Wiederholen:
<input type="password" class="textfeld" size="17" name="nochmal"><br>
<br>
<input type="submit" value="OK">
</form>

<hr>

<h4>Email-Adresse ändern</h4>

<td class='formular'>
<form action="email_aendern.php" method="post" name="input">
Email-Adresse:
<input type="text" class="textfeld" size="17" name="email" value="<?php echo $email ?>"><br>
<br>
<input type="submit" value="OK">
</form>

<hr>

<h4>Profil-Daten ändern</h4>

<td class='formular'>
<form action="profil_aendern.php" method="post" name="input">
ICQ:
<input type="text" class="textfeld" size="17" name="icq" value="<?php echo $icq ?>"><br>
<br>
<input type="submit" value="OK">
</form>

</body>
</html>
