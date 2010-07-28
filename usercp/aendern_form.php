<?php
//usercp/aendern_form.php
session_start();

include "../includes/dbconnect.php";
include "../includes/functions.php";

$result = get_table_where("events", "*", "ID = '".$_GET['event']."'");
while ($row = $result->fetch_assoc()) {  
	$event = $row;
}

if($event['BESITZERID'] != $_SESSION['ID'])
	die("KEIN MISSBRAUCH!!!!!!!!!!!");

//header einfügen
$seite = "Eventplaner";
include "../templates/overall_header.php"; 
?>

<h2> User-Control-Panel </h2>
<h4> Event bearbeiten</h4>

<form action="functions/aendern.php" method="post" name="input">
<input type="hidden" value="<?php echo $_GET['event']; ?>" class="textfeld" size="17" name="id">
<table>
<tr>
	<td>Event</td>
	<td><input type="text" value="<?php echo $event['EVENT']; ?>" class="textfeld" size="17" name="event"></td>
</tr>
<tr>
	<td>Ort</td>
	<td><input type="text" value="<?php echo $event['ORT']; ?>" class="textfeld" size="17" name="ort"></td>
</tr>
<tr>
	<td>Datum</td>
	<td><input type="text" value="<?php echo $event['DATUM']; ?>" readonly class="textfeld" size="17" name="datum" value="">
		
		<script language="JavaScript">
		new tcal ({
			// form name
			'formname': 'input',
			// input name
			'controlname': 'datum'
		});
		</script></td>
</tr>
<tr>
	<td>Uhrzeit</td>
	<td><input type="text" value="<?php echo $event['UHRZEIT']; ?>" class="textfeld" size="17" name="uhrzeit"></td>
</tr>
<tr>
	<td>Anmerkung</td>
	<td><input type="text" value="<?php echo $event['ANMERKUNG']; ?>" class="textfeld" size="17" maxlength="140" name="anmerkung"></td>
</tr>
<tr>
	<td>Anzahl der Teilnehmer</td>
	<td><input type="text" value="<?php echo $event['ANZAHL']; ?>" class="textfeld" size="17" name="teilnehmer"></td>
</tr>
<tr>
	<td colspan="2">
	<input align="center" type="submit" value="OK">
	</td>
</tr>
</table>
</form>
</body>
</html>