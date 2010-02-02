-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 29. Oktober 2009 um 16:20
-- Server Version: 5.1.37
-- PHP-Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `clique`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE IF NOT EXISTS `benutzer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  `PASSWORT` varchar(32) NOT NULL,
  `EMAIL` varchar(128) NOT NULL,
  `RECHTE` int(11) NOT NULL,
  `LAST_LOGIN` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `benutzer`
--


--
-- Tabellenstruktur für Tabelle `events`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `events`
--
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kommentare`
--

CREATE TABLE IF NOT EXISTS `kommentare` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVENTID` int(11) NOT NULL,
  `BENUTZERID` int(11) NOT NULL,
  `KOMMENTAR` text NOT NULL,
  `DATUM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `kommentare`
--

--
-- Tabellenstruktur für Tabelle `teilnahmen`
--

CREATE TABLE IF NOT EXISTS `teilnahmen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BENUTZERID` int(11) NOT NULL,
  `EVENTID` int(11) NOT NULL,
  `DATUM` date NOT NULL,
  `TEILNAHME` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `teilnahmen`
--

