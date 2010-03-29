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
	foreach($tabelle as $spalte){
		echo"<tr>\n";
		foreach($spalte as $zelle){
			$zelle->output();
		}
		echo"</tr>\n";
	}
	?>
</table>
			<a href="index.php?more= <?php echo $mehr; ?> ">mehr</a>
			<a href="index.php?more= <?php echo $weniger; ?> ">weniger</a>
<br>
<?php include "templates/overall_menu.php"; ?>
</body>
</html>