<?php
//templates/formular.php
//TODO: add a new calendar. old one does not work with jQuery
?>

<td class='formular'>
<form action="functions/import_event.php" method="post" name="input">
Event<br>
<input type="text" class="textfeld" size="17" name="event"><br>
Ort<br>
<input type="text" class="textfeld" size="17" name="ort"><br>
Datum<br>
<input type="text"  class="textfeld" size="17" name="datum" value="YYYY-MM-DD"><!-- should be readonly -->
Uhrzeit<br>
<input type="text" class="textfeld" size="17" name="uhrzeit"><br>
Anmerkung<br>
<input type="text" class="textfeld" size="17" maxlength="140" name="anmerkung"><br>
Anzahl der Teilnehmer<br>
<input type="text" class="textfeld" size="17" name="teilnehmer">
<br><br>
<input type="submit" value="OK">
</form>