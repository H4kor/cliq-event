<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//DE" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">

<!-- Clique-Eventplaner - Ein Eventplaner für Cliquen und und andere kleine Gruppen. 

Copyright (C) 2009 Niko Abeler

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. -->
<head>
	<meta name="robots" content="noindex" />
	<title><?php echo TITEL; ?> - <?php echo $seite;?> </title>
	<link rel="stylesheet" type="text/css" href="<?php echo MAIN_FOLDER; ?>style.css" />

	<script type="text/javascript" src="<?php echo MAIN_FOLDER; ?>js/jquery.js"></script>
		
	<script type="text/javascript">
		
		$(document).ready(function() {
			$("tr:odd").css({'background' : "#CBC8C6"});
		});

	</script>
	
</head>
<body>
