<?php
//install/constant_erstellen.php



$daten = "
<?php
define('TITEL', '".$titel."');
define('DBNAME', '".$dbname."');
define('DBUSER', '".$dbuser."');
define('DBPASSWORD', '".$dbpassword."');
?>
";
$dateihandle = fopen("../includes/constant.php","w");

fwrite($dateihandle, $daten);

echo "constant.php wurde erfolgreich angelegt!<br>";
?>