-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 12, 2017 at 02:58 AM
-- Server version: 5.7.16-0ubuntu0.16.04.1-log
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snapinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `dateReception` date NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `typeStructure` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `QS`
--

CREATE TABLE `QS` (
  `id` int(11) NOT NULL,
  `quartier` int(11) NOT NULL,
  `structure` int(11) NOT NULL,
  `typeStructure` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quartier`
--

CREATE TABLE `quartier` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `structure`
--

CREATE TABLE `structure` (
  `id` int(11) NOT NULL,
  `typeStructure` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `adresse` varchar(80) NOT NULL,
  `contact1` varchar(20) DEFAULT NULL,
  `contact2` varchar(20) DEFAULT NULL,
  `mail` varchar(50) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `zone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `typeStructure`
--

CREATE TABLE `typeStructure` (
  `id` int(11) NOT NULL,
  `nomStructure` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `CellID` int(11) NOT NULL,
  `MNC` int(11) NOT NULL,
  `MCC` int(11) NOT NULL,
  `LAC` int(11) NOT NULL,
  `operateur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur` (`utilisateur`),
  ADD KEY `typeStructure` (`typeStructure`);

--
-- Indexes for table `QS`
--
ALTER TABLE `QS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quartier` (`quartier`),
  ADD KEY `structure` (`structure`);

--
-- Indexes for table `quartier`
--
ALTER TABLE `quartier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `structure`
--
ALTER TABLE `structure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeStructure` (`typeStructure`);

--
-- Indexes for table `typeStructure`
--
ALTER TABLE `typeStructure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `QS`
--
ALTER TABLE `QS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quartier`
--
ALTER TABLE `quartier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `structure`
--
ALTER TABLE `structure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `typeStructure`
--
ALTER TABLE `typeStructure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_ibfk_1` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `info_ibfk_2` FOREIGN KEY (`typeStructure`) REFERENCES `typeStructure` (`id`);

--
-- Constraints for table `QS`
--
ALTER TABLE `QS`
  ADD CONSTRAINT `QS_ibfk_1` FOREIGN KEY (`quartier`) REFERENCES `quartier` (`id`),
  ADD CONSTRAINT `QS_ibfk_2` FOREIGN KEY (`structure`) REFERENCES `structure` (`id`);

--
-- Constraints for table `structure`
--
ALTER TABLE `structure`
  ADD CONSTRAINT `structure_ibfk_1` FOREIGN KEY (`typeStructure`) REFERENCES `typeStructure` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
