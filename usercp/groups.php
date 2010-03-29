<?php
//usercp/groups.php
session_start();

require_once "../includes/dbconnect.php";
require_once "../includes/functions.php";
$aktive_groups = array();

$result = get_table_where("groups_member", "GROUPID", "USERID = '".$_SESSION['ID']."'");
while ($row = $result->fetch_assoc()) {
	$result2 = get_table_where("groups", "*", "ID = '".$row['GROUPID']."'");
	while ($row2 = $result2->fetch_assoc()) {
		$aktive_groups[] = $row2;
	}
}



//OUTPUT
include("templates/groups.php");
?>
