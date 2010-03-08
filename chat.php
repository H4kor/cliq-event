<?php
//chat.php

session_start();

require_once "includes/dbconnect.php";
require_once "includes/functions.php";
require_once "includes/constant.php";

if(!access(0))die();

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

$output = array(); 

include "output_chat.php";

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

?>

<?php
//header einfügen
$seite = "Chat";
include "static/header.html"; 

?>

<div class="menu">
	<a href="index.php">Zurück</a>
</div>

<h2>Chat</h2>

<?php 
if($_GET['re_id'] == -1){
	include("templates/chat_formular.php");
	output_chat($output, 0, 0); 
}else{
	include("templates/chat_formular.php");
}
?>


</body>
</html>
