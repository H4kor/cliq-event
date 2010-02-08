<?php

//ausgabe_profil.php
session_start();

require_once "includes/dbconnect.php";
require_once "includes/functions.php";
require_once "includes/constant.php";

if(!access(0)) die();

$results = get_table_where("benutzer", "*", "ID = '".$_GET['user']."'");

while ($row = $results->fetch_assoc()) {
	$user = $row['NAME'];
	$email = $row['EMAIL'];
	$rechte = $row['RECHTE'];
	$icq = $row['ICQ'];
	$status = $row['STATUS'];
	$away = $row['AWAY'];
}

if($rechte == 1)
	$rang = "Admin";
else
	$rang = "Mitglied";


//AUSGABE
?>

<?php 
//header einfügen
$seite = "Profil von ".$user;
include "static/header.html"; 
?>

<a class="menu" href="index.php">Zurück</a>

<h2 align="">Profil von <?php echo $user ?></h2>
<?php if($away == 1){ ?>
	<div>Ist zur Zeit abwesend</div>
<?php } ?>



<h5><?php echo $status ?></h5><hr>
<div> Rang: <?php echo $rang ?></div> <br>
<div> Email: <?php echo $email ?> </div> <br>
<div> ICQ#: <?php echo $icq ?></div> <br>
</body>
</html>