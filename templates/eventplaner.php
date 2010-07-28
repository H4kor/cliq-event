<?php
//templates/eventplaner.php
?>
<?php 
//header einfügen
$seite = "Eventplaner";
include "templates/overall_header.php"; 
?>

<h2 align="center"> Eventplaner </h2>
Heute ist der : <?php echo date( "d.m.y", strtotime($heute)); ?>

<table border="10">
	<?php
	//Alles ausgeben	
	for($i=0;$i<=$anzahl_benutzer+2;$i++){
		echo"<tr>\n";
		
			for($k=0;$k<=$anzeigen;$k++){
				$tabelle[$i][$k]->output();
			}
			
 			
/* 				for($k=$anzeigen+1;$k<=$anzahl_events;$k++){
					$tabelle[$i][$k]->output();
				} */			//maybe used for js later
			
			
		echo"</tr>\n";
	}
	?>
</table>

			<a href="eventplaner.php?more=<?php echo $mehr; ?> ">mehr</a>
			<a href="eventplaner.php?more=<?php echo $weniger; ?> ">weniger</a>
<br>
<?php include "templates/overall_menu.php"; ?>
</body>
</html>