<?php
//count.php
?>

<?php if($this->enough == "FALSE"){ ?>
	<td class='wenig' ><?php echo $this->amount; ?></td>
<?php }else{ ?>
	<td class='genug' ><?php echo $this->amount; ?> - findet statt</td>
<?php } ?>