<?php 
//admin/templates/admin_config.php
//header einfügen
$seite = "Konfiguration";
include "../templates/overall_header.php"; 
?>

<a class="menu" href="index.php">Zurück</a>
<div style="float:left">
<p> </p>

<h2> Konfiguration </h2>

<td class='formular'>
<form action="functions/set_config.php" method="post" name="input">
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