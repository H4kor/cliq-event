<?php 
//user.php
?>

<?php if($this->away == "FALSE"){ ?>
	<td><a href='ausgabe_profil.php?user=<?php echo $this->id; ?>'><?php echo $this->name; ?></a></td>	
<?php }else{ ?>
	<td><a  class='benutzer_away' href='ausgabe_profil.php?user=<?php echo $this->id; ?>'><?php echo $this->name; ?></a></td>
<?php } ?>


