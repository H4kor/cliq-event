<?php
//admin/templates/user.php
?>

		<tr>
			<td>
				<?php echo $this->id; ?>
			</td>
			<td>
				<?php echo $this->name; ?>
			</td>
			<td>
		<?php if($this->rights == 1){ ?>
			Admin
		<?php }else{ ?>
			Mitglied
		<?php } ?>
			</td>
			<td>
				<?php echo $this->email; ?>
			</td>
			<td>
				<a href="functions/benutzer_loeschen.php?id=<?php echo $this->id; ?>">Benutzer Löschen</a>
			</td>
			<td>
		<?php if($this->rights != 1){ ?>
			<a href="functions/admin_geben.php?id=<?php echo $this->id; ?>">Zum Admin machen</a>
		<?php }else{ ?>
			<a href="functions/admin_nehmen.php?id=<?php echo $this->id; ?>">Zum Miglied machen</a>
		<?php } ?>	
			</td>
		</tr>	
		