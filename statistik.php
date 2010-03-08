<?php


//statistik.php

session_start();

include "includes/dbconnect.php";
include "includes/functions.php";
if(!access(0))die();
//Datum herrausfinden
date_default_timezone_set("Europe/Paris");
$heute = date("Y-m-d");

//Sortierung auswählen

switch ($_GET['sort_by']) {
    case "name":
        $sort = "NAME ASC";
        break;
    case "login":
        $sort = "LAST_LOGIN ASC";
        break;
	case "events":
		$sort_after = "events";
		$sort = "ID ASC";
		break;
	case "teilnahme":
		$sort_after = "teilnahme";
		$sort = "ID ASC";
		break;
	default:
		$sort = "ID ASC";
}

$result = get_table("benutzer", "*", $sort);

$benutzer_array = array();
$anzahl_benutzer = $result->num_rows;
//$userids[] = -1000;
while ($row = $result->fetch_assoc()) {
	$benutzer_array[$row['ID']]['id']=$row['ID'];
	$benutzer_array[$row['ID']]['name']=$row['NAME'];
	
	$result2 = get_table_where("events", "*", "`BESITZERID` = ".$row['ID']." ");
	$benutzer_array[$row['ID']]['events']=$result2->num_rows;
	
	$result2 = get_table_where("teilnahmen", "*", "`BENUTZERID` = ".$row['ID']." AND `TEILNAHME` = 1 ");
	$benutzer_array[$row['ID']]['teilnahmen']=$result2->num_rows;
	
	$alt = strtotime($row['LAST_LOGIN']) ;
	$aktuell = strtotime($heute) ;
	$differenz = $aktuell - $alt;
	$differenz = $differenz / 86400;

	$benutzer_array[$row['ID']]['last_login']= "";
	$benutzer_array[$row['ID']]['last_login'] .= $differenz." Tage";
		
}

$temp_benutzer_array = array();

if($sort_after == "events"){
	for($i = 0; $i < $anzahl_benutzer; $i++){
		$max = -1;
		$max_id = -1;	
		foreach ($benutzer_array as $benutzer):
			if($benutzer['events'] > $max){
				$max = $benutzer['events'];
				$max_id = $benutzer['id'];
			}
		endforeach;
			$temp_benutzer_array[$max_id] = $benutzer_array[$max_id];
			$benutzer_array[$max_id]['events'] = -1;
	}
	$benutzer_array = $temp_benutzer_array;
}
if($sort_after == "teilnahme"){
	for($i = 0; $i < $anzahl_benutzer; $i++){
		$max = -1;
		$max_id = -1;	
		foreach ($benutzer_array as $benutzer):
			if($benutzer['teilnahmen'] > $max){
				$max = $benutzer['teilnahmen'];
				$max_id = $benutzer['id'];
			}
		endforeach;
			$temp_benutzer_array[$max_id] = $benutzer_array[$max_id];
			$benutzer_array[$max_id]['teilnahmen'] = -1;
	}
	$benutzer_array = $temp_benutzer_array;
}


?>

<?php 
//header einfügen
$seite = "Eventplaner";
include "static/header.html"; 
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

<div class="menu">
<a href="index.php">Zurück</a>
</div>

</body>
</html>