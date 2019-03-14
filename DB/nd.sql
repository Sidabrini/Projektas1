-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 14, 2019 at 08:18 PM
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
-- Database: `nd`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `Name` varchar(60) NOT NULL,
  `Date_and_time` datetime NOT NULL,
  `Place` varchar(80) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Creator` varchar(80) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_userEmail` (`Creator`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`Name`, `Date_and_time`, `Place`, `ID`, `Creator`) VALUES
('kazkoks ivykis', '2019-03-28 18:00:00', 'Kaunas, studentu g. 48', 1, 'abc@abc.com'),
('ivykis2', '2019-03-28 18:00:00', 'Kaunas, studentu g. 50', 2, 'abc@abc.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Email` varchar(70) NOT NULL,
  `Password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Email`, `Password_hash`) VALUES
('abc@abc.com', '$2y$10$x3NqCXD11KHLV9Y0xUH28uok0sqa10RYZxu9b5.qGKcsej/dgIzTG'),
('du@du.com', '$2y$10$Df/Pe/cKN2bA1gFzZUgNu.GnhueqAJdAyDz2r5JLhOXTw9/po5nCi'),
('keturi@keturi.com', '$2y$10$SaW0i6CDkgFwpptGCg.dwOx6DUtlcZUIf641LQ3CY7YD7aZAKD/0u'),
('trys@trys.com', '$2y$10$txj9gVxEM03yymzSOo142OVTS4EDAHwcz39XCRz9F3c7vxnpfJgUi'),
('vienas@vienas.com', '$2y$10$ZdEJZnGPpFzsIyDHRQOlIup0dK.Wj1QKgijl5/vpphFWgbY3LR50q');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`Creator`) REFERENCES `user` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
