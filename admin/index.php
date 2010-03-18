<?php
//admin/index.php
session_start();

require_once "../includes/dbconnect.php";
require_once "../includes/functions.php";
require_once "../includes/constant.php";

if(!isset($_SESSION['name']) && !isset($_SESSION['password']) && $_SESSION['rechte'] == 1){
	header('Location:../index.php');
}else{
	if(access(1)){
		include "ausgabe.php";
	}
}
?>