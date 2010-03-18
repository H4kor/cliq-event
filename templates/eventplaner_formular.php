<?php
//templates/formular.php
?>

<td class='formular'>
<form action="functions/import_event.php" method="post" name="input">
Event<br>
<input type="text" class="textfeld" size="17" name="event"><br>
Ort<br>
<input type="text" class="textfeld" size="17" name="ort"><br>
Datum<br>
<input type="text" readonly class="textfeld" size="17" name="datum" value="">
	
	<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'input',
		// input name
		'controlname': 'datum'
	});
	</script>

Uhrzeit<br>
<input type="text" class="textfeld" size="17" name="uhrzeit"><br>
Anmerkung<br>
<input type="text" class="textfeld" size="17" maxlength="140" name="anmerkung"><br>
Anzahl der Teilnehmer<br>
<input type="text" class="textfeld" size="17" name="teilnehmer">
<br><br>
<input type="submit" value="OK">
</form>