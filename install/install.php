<?php
//install/install.php


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//DE" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
<html>
<head>
	<meta name="robots" content="noindex">
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<title>Unsere Clique - Installation </title>
</head>
<body>
<h2>Willkommen bei der Installation</h2>

<div>Bitte füllen sie das Formular aus um die Installtion durchzuführen</div><br><hr>

<form action="install_finish.php" method="POST">
	<?php 
	if( $_SESSION['fehler'] == "vergessen" )
		echo "<div>Es fehlt mindestens eine Eingabe</div>";
	?>
	
	<div>Titel des Eventplaners:</div><input class="textfeld" type="text" size="32" name="titel"><br>
	
	<hr>
	
	<div>Datenbank:</div><input class="textfeld" type="text" size="32" name="dbname"><br>
	<div>Datenbanknutzer:</div><input class="textfeld" type="text" size="32" name="dbuser"><br>
	<div>Datenbankpasswort:</div><input class="textfeld" type="text" size="32" name="dbpassword"><br>
	<?php 
	if( $_SESSION['fehler'] == "datenbank" )
		echo "<div>Die Verbindung zur Datenbank war nicht möglich. Bitte Eingaben überprüfen</div>";
	?>
	<hr>
		
	<div>Adminname:</div><input class="textfeld" type="text" size="32" name="adminname"><br>
	<div>Adminpasswort:</div><input class="textfeld" type="text" size="32" name="adminpassword"><br>
	
	<hr>	
	
	<div>Hauptemail*:</div><input class="textfeld" type="text" size="32" name="email"><br>
	<div>SMTP-Server*:</div><input class="textfeld" type="text" size="32" name="smtp"><br>
	
	<hr>
	<div>* ist optional</div>
	<input type="submit" name="Name" value="Erstellen">
</form>


</body>
</html>