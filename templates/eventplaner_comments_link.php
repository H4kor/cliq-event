<?php
//templates/comments_link.php
?>

<?php if($this->count != "1"){ ?>
	<td><a href='comments.php?id=<?php echo $this->id; ?>'><?php echo $this->amount; ?> Einträge</a></td>
<?php }else{ ?>
	<td><a href='comments.php?id=<?php echo $this->id; ?>'>1 Eintrag</a></td>";
<?php } ?>