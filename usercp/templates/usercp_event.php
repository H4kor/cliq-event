<?php
//usercp/templates/usercp_event.php
?>

<td class='event'><b class='yellow'>Event:<br> </b></font><?php echo $this->event; ?><br>
					<b class='yellow'>Ort:<br> </b><?php echo $this->location; ?><br><br>
					<b class='yellow'>Datum: </b><?php echo $this->date; ?><br>
					<b class='yellow'>Uhrzeit:<br> </b><?php echo $this->time; ?><br><br>
					<b class='yellow'>erford. Teilnehmer: </b><br><?php echo $this->participants_logged; ?> / <?php echo $this->participants_needed; ?><br><br>
					<div class='anmerkung'><b class='yellow'>Anmerkung:<br> </b><?php echo $this->note; ?></div><br>
	<a class="loeschen" href="functions/loeschen.php?event=<?php echo $this->id; ?>" >LÖSCHEN</a>
	<a href="aendern_form.php?event=<?php echo $this->id; ?>" >Bearbeiten</a>
</td>

