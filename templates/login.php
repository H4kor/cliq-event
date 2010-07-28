<?php
//login.php

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