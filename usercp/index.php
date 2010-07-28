<?php

//usercp/index.php
session_start();

require_once "../includes/dbconnect.php";
require_once "../includes/functions.php";
require_once "../includes/classes_usercp.php";
require_once "../includes/constant.php";

if(!isset($_SESSION['name']) && !isset($_SESSION['password'])){
	header('Location:../index.php');
}else{
	if(access(0)){
		include "ausgabe.php";
	}
}



?>