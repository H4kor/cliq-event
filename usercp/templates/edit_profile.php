<?php 
//usercp/templates/edit_profile.php

//header einf�gen
$seite = "Profil bearbeiten";
include "../templates/overall_header.php"; 
?>
<div class="menu"><a href="index.php">Zur�ck</a></div>

<h4>Dein Passwort �ndern </h4>

<td class='formular'>
<form action="functions/passwort.php" method="post" name="input">
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

<h4>Email-Adresse �ndern</h4>

<td class='formular'>
<form action="functions/email_aendern.php" method="post" name="input">
Email-Adresse:
<input type="text" class="textfeld" size="17" name="email" value="<?php echo $email ?>"><br>
<br>
<input type="submit" value="OK">
</form>

<hr>

<h4>Profil-Daten �ndern</h4>

<td class='formular'>
<form action="functions/profil_aendern.php" method="post" name="input">
ICQ:
<input type="text" class="textfeld" size="17" name="icq" value="<?php echo $icq ?>"><br>
<br>
<input type="submit" value="OK">
</form>

</body>
</html>
