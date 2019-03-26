-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2019 m. Kov 18 d. 21:35
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
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `Name` varchar(255) NOT NULL,
  `Date_and_time` datetime NOT NULL,
  `Place` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `Creator` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `events`
--

INSERT INTO `events` (`Name`, `Date_and_time`, `Place`, `id`, `Creator`) VALUES
('Krepsinis', '2019-03-14 00:00:00', 'Kaunas', 1, 'vienas@vienas.com'),
('Futbolas', '2019-03-13 00:00:00', 'Vilnius', 2, 'du@du.com'),
('Tinklinis', '2019-03-07 00:00:00', 'Kalvarija', 3, 'trys@trys.com'),
('Plaukimas', '2019-03-03 00:00:00', 'Klaipeda', 4, 'keturi@keturi.com');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`email`, `password_hash`) VALUES
('vienas@vienas.com', '$2y$10$x3NqCXD11KHLV9Y0xUH28uok0sqa10RYZxu9b5.qGKcsej/dgIzTG'),
('du@du.com', '$2y$10$Df/Pe/cKN2bA1gFzZUgNu.GnhueqAJdAyDz2r5JLhOXTw9/po5nCi'),
('trys@trys.com', '$2y$10$txj9gVxEM03yymzSOo142OVTS4EDAHwcz39XCRz9F3c7vxnpfJgUi'),
('keturi@keturi.com', '$2y$10$SaW0i6CDkgFwpptGCg.dwOx6DUtlcZUIf641LQ3CY7YD7aZAKD/0u');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
