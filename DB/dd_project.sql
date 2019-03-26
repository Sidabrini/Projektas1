-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 15, 2019 at 01:38 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dd project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Email` varchar(70) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_`
--

DROP TABLE IF EXISTS `event_`;
CREATE TABLE IF NOT EXISTS `event_` (
  `Title` varchar(255) DEFAULT NULL,
  `Category` varchar(30) DEFAULT NULL,
  `City` varchar(30) DEFAULT NULL,
  `Address` varchar(40) DEFAULT NULL,
  `Place` varchar(40) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Duration` time DEFAULT NULL,
  `Price` double(4,2) DEFAULT NULL,
  `Description` text,
  `id_Event` int(11) NOT NULL AUTO_INCREMENT,
  `fk_AdminEmail` varchar(70) NOT NULL,
  PRIMARY KEY (`id_Event`),
  KEY `fk_AdminEmail` (`fk_AdminEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_modification`
--

DROP TABLE IF EXISTS `event_modification`;
CREATE TABLE IF NOT EXISTS `event_modification` (
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Message_about_changes` varchar(255) DEFAULT NULL,
  `id_Event_modification` int(11) NOT NULL AUTO_INCREMENT,
  `fk_Eventid_Event` int(11) NOT NULL,
  `fk_AdminEmail` varchar(70) NOT NULL,
  PRIMARY KEY (`id_Event_modification`),
  KEY `fk_AdminEmail` (`fk_AdminEmail`),
  KEY `fk_Eventid_Event` (`fk_Eventid_Event`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `Name` varchar(30) DEFAULT NULL,
  `Lastname` varchar(30) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `Email` varchar(70) NOT NULL,
  `Password_hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_`
--

DROP TABLE IF EXISTS `user_`;
CREATE TABLE IF NOT EXISTS `user_` (
  `Email` varchar(70) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `person` (`Email`);

--
-- Constraints for table `event_`
--
ALTER TABLE `event_`
  ADD CONSTRAINT `event__ibfk_1` FOREIGN KEY (`fk_AdminEmail`) REFERENCES `admin` (`Email`);

--
-- Constraints for table `event_modification`
--
ALTER TABLE `event_modification`
  ADD CONSTRAINT `event_modification_ibfk_1` FOREIGN KEY (`fk_AdminEmail`) REFERENCES `admin` (`Email`),
  ADD CONSTRAINT `event_modification_ibfk_2` FOREIGN KEY (`fk_Eventid_Event`) REFERENCES `event_` (`id_Event`);

--
-- Constraints for table `user_`
--
ALTER TABLE `user_`
  ADD CONSTRAINT `user__ibfk_1` FOREIGN KEY (`Email`) REFERENCES `person` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
