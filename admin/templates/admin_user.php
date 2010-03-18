<?php	
//header einfügen
$seite = "Benutzer verwalten";
include "../templates/overall_header.php"; 

?>

<a class="menu" href="index.php">Zurück</a>
<div style="float:left">
<p> </p>

<p> </p>
<h2> Benutzerliste </h2>
<table border="10">
		<tr>
			<td>
				ID
			</td>
			<td>
				Name
			</td>
			<td>
				Rang
			</td>
			<td>
				Email
			</td>
			<td>
				Löschen
			</td>
			<td>
				Rechte
			</td>
		</tr>	
		
<?php
	foreach ($output as $user):
		$user->output();
	endforeach;
?>
</table>
<h4>Neuen Benutzer anlegen</h4>

<form action="functions/neuer_benutzer.php" method="POST">
	<div>Name:</div><input class="textfeld" type="text" size="32" name="name">
	<div>Passwort:</div><input class="textfeld" type="text" size="32" name="password"><br>
	<div>Email:</div><input class="textfeld" type="text" size="32" name="email"><br>
	<input type="submit" name="Name" value="Erstellen">
</form>


</body>
</html>
