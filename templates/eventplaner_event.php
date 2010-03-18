<?php 
//event.php
?>
<td class='event'>
<b class='yellow'>Event: </b></font><?php echo $this->event;?><br>
<b class='yellow'>Ort: </b><?php echo $this->location;?><br><br>
<b class='yellow'>Initiator: </b><?php echo $this->initiator;?><br><br>
<b class='yellow'>Datum: </b><?php echo $this->date;?><br>
<b class='yellow'>Uhrzeit: </b><?php echo $this->time;?><br><br>
<b class='yellow'>erford. Teilnehmer: </b><?php echo $this->participants;?><br><br>
<div class='anmerkung'><b class='yellow'>Anmerkung:<br> </b><?php echo $this->note;?></div><br>

<?php if($this->logged == "FALSE"){ ?>
	<a class="ja" href="functions/anmelden.php?event=<?php echo $this->id; ?>&set=1" >JA</a>
	<a class="nein" href="functions/anmelden.php?event=<?php echo $this->id; ?>&set=-1" >NEIN</a>
<?php }else{ ?>
	<a href="functions/abmelden.php?event=<?php echo $this->id; ?>" >abmelden</a>
<?php } ?>

</td>
