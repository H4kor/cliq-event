<?php
//install/constant_erstellen.php



$daten = "
<?php
define('TITEL', '".$titel."');
define('DBNAME', '".$dbname."');
define('DBUSER', '".$dbuser."');
define('DBPASSWORD', '".$dbpassword."');
define('SMTP', '".$smtp."');
define('MAIN_EMAIL', '".$email."');
define('MAIN_FOLDER', '".$main_folder."');
?>
";
$dateihandle = fopen("../includes/constant.php","w");

fwrite($dateihandle, $daten);

echo "constant.php wurde erfolgreich angelegt!<br>";
?>