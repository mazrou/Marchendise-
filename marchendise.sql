-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2020 at 12:59 PM
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
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(128) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mot_de_passe` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `trajet`
--

CREATE TABLE `trajet` (
  `id` int(128) NOT NULL,
  `lieu_depart` varchar(256) NOT NULL,
  `lieu_arrive` varchar(256) NOT NULL,
  `kilo_metre` int(128) NOT NULL,
  `devis` int(128) NOT NULL,
  `lieu_arret` varchar(1024) NOT NULL,
  `date_depart` date NOT NULL,
  `id_transportatuer` int(128) NOT NULL,
  `id_client` int(128) NOT NULL,
  `date_retour` int(11) DEFAULT NULL,
  `regulier` tinyint(1) NOT NULL DEFAULT 0,
  `frequence` int(128) DEFAULT NULL,
  `moyen_transpor` varchar(128) NOT NULL,
  `poids` int(128) NOT NULL,
  `volume` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transportateur`
--

CREATE TABLE `transportateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `addresse` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marchendise`
--
ALTER TABLE `marchendise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_transportatuer` (`id_transportatuer`);

--
-- Indexes for table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transportatuer` (`id_transportatuer`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `transportateur`
--
ALTER TABLE `transportateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marchendise`
--
ALTER TABLE `marchendise`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transportateur`
--
ALTER TABLE `transportateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `marchendise`
--
ALTER TABLE `marchendise`
  ADD CONSTRAINT `marchendise_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marchendise_ibfk_2` FOREIGN KEY (`id_transportatuer`) REFERENCES `transportateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `trajet_ibfk_1` FOREIGN KEY (`id_transportatuer`) REFERENCES `transportateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trajet_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
