-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2019 m. Kov 18 d. 20:37
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

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
-- Sukurta duomenų struktūra lentelei `event`
--

CREATE TABLE `event` (
  `Name` varchar(60) NOT NULL,
  `Date_and_time` datetime NOT NULL,
  `Place` varchar(80) NOT NULL,
  `ID` int(11) NOT NULL,
  `Creator` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `event`
--

INSERT INTO `event` (`Name`, `Date_and_time`, `Place`, `ID`, `Creator`) VALUES
('kazkoks ivykis', '2019-03-28 18:00:00', 'Kaunas, studentu g. 48', 1, 'abc@abc.com'),
('ivykis2', '2019-03-28 18:00:00', 'Kaunas, studentu g. 50', 2, 'abc@abc.com'),
('naujass', '2019-03-30 13:30:00', 'Kaunas, studentu g. 50', 3, 'abc@abc.com'),
('Naujas renginys', '2019-03-31 12:30:00', 'Kaunas, studentu g. 50', 6, 'abc@abc.com'),
('Renginys', '2019-03-23 11:11:00', 'Kaunas, studentu g. 50', 7, 'abc@abc.com'),
('Renginys', '2019-03-29 17:00:00', 'Kaunas, studentu g. 50', 8, 'vienas@vienas.com'),
('Naujas2', '2019-04-27 12:00:00', 'Kaunas, studentu g. 50', 9, 'vienas@vienas.com');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `user`
--

CREATE TABLE `user` (
  `Email` varchar(70) NOT NULL,
  `Password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `user`
--

INSERT INTO `user` (`Email`, `Password_hash`) VALUES
('abc@abc.com', '$2y$10$x3NqCXD11KHLV9Y0xUH28uok0sqa10RYZxu9b5.qGKcsej/dgIzTG'),
('du@du.com', '$2y$10$Df/Pe/cKN2bA1gFzZUgNu.GnhueqAJdAyDz2r5JLhOXTw9/po5nCi'),
('keturi@keturi.com', '$2y$10$SaW0i6CDkgFwpptGCg.dwOx6DUtlcZUIf641LQ3CY7YD7aZAKD/0u'),
('trys@trys.com', '$2y$10$txj9gVxEM03yymzSOo142OVTS4EDAHwcz39XCRz9F3c7vxnpfJgUi'),
('vienas@vienas.com', '$2y$10$ZdEJZnGPpFzsIyDHRQOlIup0dK.Wj1QKgijl5/vpphFWgbY3LR50q');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_userEmail` (`Creator`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`Creator`) REFERENCES `user` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
