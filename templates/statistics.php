<?php 
//templates/statistic.php


//header einfügen
$seite = "Statistik";
include "templates/overall_header.php"; 
?>


<h2 align="center"> Statistik </h2>
Heute ist der : <?php echo date( "d.m.y", strtotime($heute)); ?>
<table border="10">
<tr>
	<td>
		<a href="statistik.php?sort_by=name">Name</a>
	</td>
	<td>
		<a href="statistik.php?sort_by=login">Zeit seit letztem Login</a>
	</td>
	<td>
		<a href="statistik.php?sort_by=events">gestartete Events</a>
	</td>
	<td>
		<a href="statistik.php?sort_by=teilnahme">Teilnahmen</a>
	</td>
</tr>

<?php
foreach ($benutzer_array as $benutzer):
?>
<tr>
	<td>
		<?php echo $benutzer['name']; ?>
	</td>
	<td>
		<?php echo $benutzer['last_login']; ?>
	</td>
	<td>
		<?php echo $benutzer['events']; ?>
	</td>
	<td>
		<?php echo $benutzer['teilnahmen']; ?>
	</td>
</tr>
<?php
endforeach;
?>

</table>
<br>

<?php include "templates/overall_menu.php"; ?>

</body>
</html>