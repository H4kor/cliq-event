<?php
//install/admin_anlegen.php

	$sql = "INSERT INTO benutzer (NAME, PASSWORT, RECHTE) VALUES ('".$adminname."', '".md5($adminpassword)."', '1')";
	$result = $db->query($sql);
	if (!$result)
		die ('Adminfehler: '.$db->error);
	else
		echo "Adminaccount wurde erfolgreich angelegt!<br>";
?>