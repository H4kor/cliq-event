<?php
// includes/dbconnect.php
require_once("constant.php");
$db = @new mysqli('localhost', DBUSER, DBPASSWORD, DBNAME);
if (mysqli_connect_errno()) {
    die ('Konnte keine Verbindung zur Datenbank aufbauen: '.mysqli_connect_error().'('.mysqli_connect_errno().')');
}

?>