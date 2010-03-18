<?php
//chat.php

session_start();

require_once "includes/dbconnect.php";
require_once "includes/functions.php";

if(!access(0))die();
function output_chat($array, $count, $id){
	$chat_id = $array[$id]['id'];
	$chat_name = $array[$id]['name'];
	$chat_text = $array[$id]['text'];
	$chat_date = $array[$id]['date'];
	$chat_layer = $count;
	include("templates/chat_posting.php");
 	if( $array[$id]['RE'] != "" ){
		output_chat($array[$id]['RE'], $count + 1 , 0);
	}
	
	if( isset( $array[$id + 1])){
		output_chat($array, $count, $id+1);
	} 
}

function get_re($ids){
	$result = get_table_where_order("chat", "*", "`RE_TO` = ".$ids."", "`DATE` ASC");
	if($result->num_rows != 0){
		while ($row = $result->fetch_assoc()) {  
			$re[] = array(		'id' => $row["ID"],
								'name' => get_name($row["OWNER_ID"]),
								'text' => $row["TEXT"],
								'date' => $row["DATE"],
								'RE' => get_re($row["ID"]));
		}
		return $re;
	}else{
		return "";
	}
}


$output = array(); 
/*
$output = array
	->Name
	->Text
	->Date
	->RE array
		->Name
		->Text
		->Date
		->RE array
			->...
*/

	$result = get_table_where_order("chat", "*", "`RE_TO` = -1", "`DATE` DESC");
	while ($row = $result->fetch_assoc()) {  
		$output[] = array(	'id' => $row["ID"],
							'name' => get_name($row["OWNER_ID"]),
							'text' => $row["TEXT"],
							'date' => $row["DATE"],
							'RE' => get_re($row["ID"]));	
	}

	//OUTPUT
	include("templates/chat.php");
?>


