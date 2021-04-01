-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Vært: localhost
-- Genereringstid: 02. 11 2011 kl. 15:26:23
-- Serverversion: 5.1.37
-- PHP-version: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
--Database: `cms`
--
--CREATE DATABASE `cms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
--USE `cms`;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `billeder`
--

CREATE TABLE IF NOT EXISTS `billeder` (
  `billedid` int(255) NOT NULL AUTO_INCREMENT,
  `billednavn` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  PRIMARY KEY (`billedid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Data dump for tabellen `billeder`
--

INSERT INTO `billeder` (`billedid`, `billednavn`) VALUES
(15, 'bil_2.jpg');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `brugere`
--

CREATE TABLE IF NOT EXISTS `brugere` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `brugernavn` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `adgangskode` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Data dump for tabellen `brugere`
--

INSERT INTO `brugere` (`id`, `brugernavn`, `adgangskode`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `sideindhold`
--

CREATE TABLE IF NOT EXISTS `sideindhold` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `overskrift` varchar(100) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `tekst1` text CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `billede` varchar(100) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `tekst2` text CHARACTER SET utf8 COLLATE utf8_danish_ci,
  `navn` varchar(255) CHARACTER SET utf8 COLLATE utf8_danish_ci DEFAULT NULL,
  `mainid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `overskrift` (`overskrift`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Data dump for tabellen `sideindhold`
--

INSERT INTO `sideindhold` (`id`, `overskrift`, `tekst1`, `billede`, `tekst2`, `navn`, `mainid`) VALUES
(1, 'Side 1', 'Side 1', 'bil_2.jpg', 'Side 1', NULL, NULL),
(2, 'Side 2', 'Side 2', 'bil_2.jpg', 'Side 2', NULL, NULL),
(3, 'Side 3', 'Side 3', 'bil_2.jpg', 'Side 3', NULL, NULL),
(4, 'Side 4', 'Side 4', 'bil_2.jpg', 'Side 4', NULL, NULL),
(5, 'Side 5', 'Side 5', 'bil_2.jpg', 'Side 5', NULL, NULL);
