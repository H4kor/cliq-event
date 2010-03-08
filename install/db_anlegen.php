<?php 
//install/db_anlegen.php
include "../includes/dbconnect.php";
$sql =
"
CREATE TABLE IF NOT EXISTS `benutzer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  `PASSWORT` varchar(32) NOT NULL,
  `EMAIL` varchar(128) NOT NULL,
  `RECHTE` int(11) NOT NULL,
  `LAST_LOGIN` date NOT NULL,
  `ICQ` varchar(12) NOT NULL,
  `STATUS` varchar(140) NOT NULL,
  `AWAY` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$result = $db->query($sql);
if (!$result) {
    die ('Datenbankfehler: '.$db->error);
	var_dump($db, $result);   
}else
	echo "Benutzertabelle wurde erfolgreich angelegt!<br>";
$sql =
"
CREATE TABLE IF NOT EXISTS `events` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENT` varchar(140) NOT NULL,
  `ORT` varchar(140) NOT NULL,
  `DATUM` date NOT NULL,
  `ANZAHL` int(11) NOT NULL,
  `UHRZEIT` varchar(32) NOT NULL,
  `ANMERKUNG` varchar(140) NOT NULL,
  `BESITZERID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$result = $db->query($sql);
if (!$result) {
    die ('Datenbankfehler: '.$db->error);
	var_dump($db, $result);   
}else
	echo "Eventtabelle wurde erfolgreich angelegt!<br>";
$sql =
"
CREATE TABLE IF NOT EXISTS `teilnahmen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BENUTZERID` int(11) NOT NULL,
  `EVENTID` int(11) NOT NULL,
  `DATUM` date NOT NULL,
  `TEILNAHME` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$result = $db->query($sql);
if (!$result) {
    die ('Datenbankfehler: '.$db->error);
	var_dump($db, $result);   
}else
	echo "Teilnahmetabelle wurde erfolgreich angelegt!<br>";
	
	
$sql =
"
CREATE TABLE IF NOT EXISTS `kommentare` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENTID` int(11) NOT NULL,
  `BENUTZERID` int(11) NOT NULL,
  `KOMMENTAR` text NOT NULL,
  `DATUM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$result = $db->query($sql);
if (!$result) {
    die ('Datenbankfehler: '.$db->error);
	var_dump($db, $result);   
}else
	echo "Kommentartabelle wurde erfolgreich angelegt!<br>";
	
	
$sql =
"
CREATE TABLE `chat` (
	`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`TEXT` TEXT NOT NULL ,
	`RE_TO` INT NOT NULL DEFAULT '-1',
	`OWNER_ID` INT NOT NULL ,
	`DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`STICKY` BOOL NOT NULL DEFAULT '0'
) ENGINE = MYISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
";

$result = $db->query($sql);
if (!$result) {
    die ('Datenbankfehler: '.$db->error);
	var_dump($db, $result);   
}else
	echo "Chattabelle wurde erfolgreich angelegt!<br>";


?>