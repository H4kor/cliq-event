<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
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