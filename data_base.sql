-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2020 at 04:19 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user`, `password`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

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

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `nom`, `telephone`, `adresse`, `email`, `mot_de_passe`) VALUES
(1, 'ewqr ewrq', 'dsaf', 'ewqr', 'gk_momo@esi.dz', '99d13492469bd14aac613c8fcec09d4e494e2e11'),
(2, 'Ayoub Mazrou', '050', 'Bousmail', 'ga.mazrou@gmail.com', '99d13492469bd14aac613c8fcec09d4e494e2e11'),
(3, 'Mohamed  Mazrou', '0662220457', 'Bousmail', 'mazrou@gmail.com', '99d13492469bd14aac613c8fcec09d4e494e2e11'),
(5, 'Djabali Nawel', '053034505', 'Chrarba', 'nawel@gmail.com', '99d13492469bd14aac613c8fcec09d4e494e2e11'),
(6, 'Nawel Djabali', '05046055', 'chra3ba', 'nawel@gmail.com', '99d13492469bd14aac613c8fcec09d4e494e2e11'),
(7, 'aymen ourdjini', '9393939', 'skikda', 'ga_ourdjini@esi.dz', '99d13492469bd14aac613c8fcec09d4e494e2e11');

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
  `volume` varchar(128) NOT NULL,
  `poids` varchar(128) NOT NULL,
  `id_client` int(128) NOT NULL,
  `id_transportatuer` int(128) DEFAULT NULL,
  `date_depart` date NOT NULL,
  `date_arrive` date NOT NULL,
  `tarif` int(11) DEFAULT NULL,
  `done` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marchendise`
--

INSERT INTO `marchendise` (`id`, `description`, `lieu_depart`, `lieu_arrive`, `photos`, `demande_speciale`, `volume`, `poids`, `id_client`, `id_transportatuer`, `date_depart`, `date_arrive`, `tarif`, `done`) VALUES
(6, 'un table', 'bousmail', 'harach', NULL, NULL, '20', '90kg', 1, NULL, '2020-03-21', '2020-03-22', NULL, 0),
(7, 'dh', 'afds', 'dgh', '', '', '546m³', '65kg', 1, NULL, '2020-03-11', '2020-03-12', NULL, 0),
(8, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(9, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(10, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(11, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(12, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(13, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(14, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(15, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(16, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(17, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(18, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(19, 'Un pc', 'boumaiti ', 'babzouar', '', '', '78m³', '89kg', 1, NULL, '2020-04-05', '2020-03-05', NULL, 0),
(20, 'dfhgf', 'ztr65', 'hgf', '', '', '45m³', '7676kg', 5, NULL, '2020-03-29', '2020-03-05', NULL, 0),
(21, '4325', '342645', '46456', '', '', '6456m³', '654356kg', 5, NULL, '2020-03-25', '2020-03-24', NULL, 0),
(22, '4325', '342645', '46456', '', '', '6456m³', '654356kg', 5, NULL, '2020-03-25', '2020-03-24', NULL, 0),
(23, '4325', '342645', '46456', '', '', '6456m³', '654356kg', 5, NULL, '2020-03-25', '2020-03-24', NULL, 0),
(24, '4325', '342645', '46456', '', '', '6456m³', '654356kg', 5, NULL, '2020-03-25', '2020-03-24', NULL, 0),
(25, '4325', '342645', '46456', '', '', '6456m³', '654356kg', 5, NULL, '2020-03-25', '2020-03-24', NULL, 0),
(26, 'erffdgf', 'adsfadsf', 'dfgds', '', '', '325m³', '43254325kg', 5, NULL, '2020-03-03', '2020-03-10', NULL, 0);

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
  `date_arrive` date NOT NULL,
  `date_depart` date NOT NULL,
  `id_transportatuer` int(128) NOT NULL,
  `id_client` int(128) DEFAULT NULL,
  `date_retour` int(11) DEFAULT NULL,
  `regulier` tinyint(1) NOT NULL DEFAULT 0,
  `frequence` varchar(128) DEFAULT NULL,
  `moyen_transpor` varchar(128) NOT NULL,
  `poids` varchar(128) NOT NULL,
  `volume` varchar(128) NOT NULL,
  `lieu_intermediare` varchar(512) NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT 0,
  `date_voyage` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trajet`
--

INSERT INTO `trajet` (`id`, `lieu_depart`, `lieu_arrive`, `kilo_metre`, `devis`, `date_arrive`, `date_depart`, `id_transportatuer`, `id_client`, `date_retour`, `regulier`, `frequence`, `moyen_transpor`, `poids`, `volume`, `lieu_intermediare`, `done`, `date_voyage`) VALUES
(1, 'gfdgd', 'fdsg', 43, 245, '2020-03-05', '2020-03-04', 1, 1, NULL, 0, '243sem', 'pl', '423kg ', '43250', 'fds ', 0, '2020-03-06'),
(2, '4325', '2435', 2435, 432, '2020-03-14', '2020-03-13', 1, NULL, NULL, 1, '432sem', '432', '243kg ', '432m³', '2435 ', 0, '2020-03-12'),
(3, '1234', '1324', 431, 1243, '2020-03-12', '2020-03-13', 1, NULL, NULL, 0, 'sem', '1324', '1324kg ', '4321m³', '1324 ', 0, '2020-03-12'),
(4, 'Bousmail', 'tipaza', 324, 200, '2020-03-07', '2020-03-06', 1, NULL, NULL, 1, '234sem', 'herbin', '324kg ', '234m³', 'bouharon ', 0, '2020-03-26'),
(5, '346', '36', 65, 253, '2020-03-27', '2020-03-19', 1, NULL, NULL, 0, '6436sem', '346', '3465kg ', '65m³', '36 ', 0, '2020-03-21'),
(6, '4325', '4235', 4325, 243, '2020-03-26', '2020-03-12', 1, NULL, NULL, 0, '4325sem', '24354', '4325kg ', '4235m³', '43252435 ', 0, '2020-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `transportateur`
--

CREATE TABLE `transportateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `addresse` varchar(128) NOT NULL,
  `mot_de_passe` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transportateur`
--

INSERT INTO `transportateur` (`id`, `nom`, `telephone`, `addresse`, `mot_de_passe`, `email`) VALUES
(1, 'Ayoub Mazrou', '0540352075', 'Bousmail', '99d13492469bd14aac613c8fcec09d4e494e2e11', 'ga.mazrou@gmail.com'),
(5, ',.msd f k.,-mdsf', '23432423', 'wlk.,m', '99d13492469bd14aac613c8fcec09d4e494e2e11', 'root'),
(6, 'Arar Tarek', '04350345', 'Bir elAter ', '99d13492469bd14aac613c8fcec09d4e494e2e11', 'gt_arar@esi.dz');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `marchendise`
--
ALTER TABLE `marchendise`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transportateur`
--
ALTER TABLE `transportateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
