-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2020 at 12:57 PM
-- Server version: 10.3.18-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marchendise`
--

-- --------------------------------------------------------

--
-- Table structure for table `marchendise`
--

CREATE TABLE `marchendise` (
  `id` int(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `lieu_depart` varchar(256) NOT NULL,
  `lieu_arrive` varchar(256) NOT NULL,
  `photos` varchar(1024) DEFAULT NULL,
  `demande_speciale` varchar(512) DEFAULT NULL,
  `volume` int(128) NOT NULL,
  `poids` int(128) NOT NULL,
  `id_client` int(128) NOT NULL,
  `id_transportatuer` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marchendise`
--
ALTER TABLE `marchendise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_transportatuer` (`id_transportatuer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marchendise`
--
ALTER TABLE `marchendise`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `marchendise`
--
ALTER TABLE `marchendise`
  ADD CONSTRAINT `marchendise_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marchendise_ibfk_2` FOREIGN KEY (`id_transportatuer`) REFERENCES `transportateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
