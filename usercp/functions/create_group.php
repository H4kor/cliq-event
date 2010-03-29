<?php
//usercp/function/create_group.php

ob_start();
session_start();

	require_once "../../includes/dbconnect.php";
	require_once "../../includes/functions.php";
if(access(0)){
	if($_POST['name'] != "" && $_POST['note'] != "")
	{
		$sql = "INSERT INTO groups (NAME, NOTE) VALUES ('".$_POST['name']."', '".$_POST['note']."')";
		$result = $db->query($sql);
		if (!$result)
			die ('Etwas stimmte mit dem Query nicht: '.$db->error);
		$id = -1;
		$result = get_table_where("groups", "ID", "NAME = '".$_POST['name']."'");
		while ($row = $result->fetch_assoc()) {
			if($id < $row['ID'])
				$id = $row['ID'];
		}
		
		$sql = "INSERT INTO groups_member (USERID, GROUPID, RIGHTS) VALUES ('".$_SESSION['ID']."', '".$id."', '1')";
		$result = $db->query($sql);
		if (!$result)
			die ('Etwas stimmte mit dem Query nicht: '.$db->error);
	}
	header('Location:../groups.php');
}else
die("");
?>