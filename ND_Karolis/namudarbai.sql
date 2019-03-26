-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2019 at 01:48 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `namudarbai`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`ID`, `name`, `city`) VALUES
(1, 'Automobilių renginys', 'Kaunas'),
(2, 'Arbatos renginys', 'Vilnius'),
(3, 'Kavos renginys', 'Utena'),
(4, 'Filmų renginys', 'Klaipėda'),
(5, 'Kavinės renginys', 'Palanga');

-- --------------------------------------------------------

--
-- Table structure for table `event_list`
--

DROP TABLE IF EXISTS `event_list`;
CREATE TABLE IF NOT EXISTS `event_list` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_list`
--

INSERT INTO `event_list` (`ID`, `user_id`, `event_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 1),
(4, 5, 3),
(5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Email`, `Password_hash`) VALUES
(1, 'vienas@vienas.com', '$2y$10$dcCASpnNsMBqh3VGlxOOdeHUpDXpscga2pL4He4G4ZLiRNo5N4NNu'),
(2, 'du@du.com', '$2y$10$c8M/NAey91WY2VX5hCjdgeGlloqNjIkpiHsnhat5xiaYNUG6lzr5y'),
(3, 'trys@trys.com', '$2y$10$BpXMQRHN9V6RqipT/cgNtOqQBLXJ2/6W55r7WyYMT47/Go3QnhwkC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
