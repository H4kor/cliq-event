<?php
//kommentare.php
session_start();

require_once "includes/dbconnect.php";
require_once "includes/functions.php";


if(!access(0))die();

$output = array();

	$event = "";
	$result2 = get_table_where("events", "*", "`ID` = ".$_GET['id']."");
	while ($row2 = $result2->fetch_assoc()) {  
		$event = $row2['EVENT'];
	}

$result = get_table_where_order("kommentare", "*", "`EVENTID` = ".$_GET['id'].""," `DATUM` DESC");
while ($row = $result->fetch_assoc()) {  
	$name = "";
	$result2 = get_table_where("benutzer", "*", "`ID` = ".$row['BENUTZERID']."");
	while ($row2 = $result2->fetch_assoc()) {  
		$name = $row2['NAME'];
	}
	$output[] = array("name" => $name,
						"comment" => $row['KOMMENTAR']);
}

//OUTPUT
include("templates/comments.php");

?>


