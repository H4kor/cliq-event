-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 28. Oktober 2009 um 15:54
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
