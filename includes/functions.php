<?php
/* Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. */
//includes/functions.php

function get_table($table, $what, $order){
	global $db;
	$sql = 'SELECT
				'.$what.'
			FROM
				'.$table.'
			ORDER BY '.$order.' ';
	$result = $db->query($sql);
	if (!$result) {
		die ('Etwas stimmte mit dem Query nicht: '.$db->error);
	}
	return $result;
}

function get_table_where($table, $what, $where){
	global $db;
	$sql = 'SELECT
				'.$what.'
			FROM
				'.$table.'
			WHERE
				'.$where.' ';
	$result = $db->query($sql);
	if (!$result) {
		die ('Etwas stimmte mit dem Query nicht: '.$db->error);
	}
	return $result;
}

function get_table_where_order($table, $what, $where, $order){
	global $db;
	$sql = 'SELECT
				'.$what.'
			FROM
				'.$table.'
			WHERE
				'.$where.'
			ORDER BY
				'.$order.'';
	$result = $db->query($sql);
	if (!$result) {
		die ('Etwas stimmte mit dem Query nicht: '.$db->error);
	}
	return $result;
}

function update_timestamp($id){
	global $db;
	global $heute;
	$sql = "UPDATE `benutzer` 
			SET `LAST_LOGIN` = '".$heute."' 
			WHERE `ID` = ".$id."
			LIMIT 1 ";
	$result = $db->query($sql);
	if (!$result) {
		die ('Etwas stimmte mit dem Query nicht: '.$db->error);
	}

}

function access($rechte) {
	global $db;
	if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['rechte']) && isset($_SESSION['password']) && $_SESSION['status'] == "logged_in") {
		$result = get_table_where("benutzer", "*", "NAME = '".$_SESSION['name']."' 
												AND PASSWORT = '".$_SESSION['password']."'");
		if($result->num_rows == 1){
			if($rechte <= $_SESSION["rechte"]){
				return true;
			}else return false;
		}else return false;		
	}else return false;
}
?>