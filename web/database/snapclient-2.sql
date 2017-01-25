-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mer 25 Janvier 2017 à 22:27
-- Version du serveur :  5.6.33
-- Version de PHP :  7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `snapclient`
--

-- --------------------------------------------------------

--
-- Structure de la table `donnees`
--

CREATE TABLE `donnees` (
  `idDonnees` int(11) NOT NULL,
  `idStructure` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `datePhoto` datetime NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `structures`
--

CREATE TABLE `structures` (
  `idStructure` int(11) NOT NULL,
  `nomStructure` varchar(100) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `structures`
--

INSERT INTO `structures` (`idStructure`, `nomStructure`, `latitude`, `longitude`) VALUES
(1, 'police', 'undefined', 'undefined'),
(7, 'mairie', '', ''),
(8, 'police yembeul', '', ''),
(9, 'police de pikine', '', ''),
(10, 'police de medina', '', ''),
(11, 'police de dakar', '', ''),
(12, 'mairie de dakar', '', ''),
(13, 'Hopital FANN', '', ''),
(14, 'SAMU liberté 6', '', ''),
(15, 'nouvelle ', '', ''),
(16, '', '', ''),
(17, 'loloita', '', ''),
(18, 'lololololo', '', ''),
(19, 'le parlement du rire', '', ''),
(20, '', '', ''),
(21, 'valeur nulle', '', ''),
(22, '', '', ''),
(23, 'popopoppzdbb', '', ''),
(24, 'kfbqsjb', 'sbdbn', 'bsfjbjn'),
(25, 'kfbqsjb', 'sbdbn', 'bsfjbjn'),
(26, 'kfbqsjb', 'sbdbn', 'bsfjbjn'),
(27, 'kfbqsjb', 'sbdbn', 'bsfjbjn'),
(28, '', '', ''),
(29, '', '', ''),
(30, 'bhbjbdb', 'hbsbsj', 'hbsjdbsb'),
(31, '', '', ''),
(32, '', '', ''),
(33, '', '', ''),
(34, 'knjnjnjnjn', '', ''),
(35, '', '', ''),
(36, 'le nom l)', '', ''),
(37, '', '', ''),
(38, '', '', ''),
(39, 'le nom', 'la latitude', 'la longitude'),
(40, 'bhbjbdb', 'hbsbsj', 'hbsjdbsb'),
(41, 'le nom', 'la lati', 'la longi'),
(42, 'le nom', 'la lati', 'la longi');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `nomUser` varchar(20) NOT NULL,
  `prenomUser` varchar(40) NOT NULL,
  `loginUser` varchar(20) NOT NULL,
  `passwordUser` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `photoUser` varchar(100) NOT NULL,
  `structureUser` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`idUser`, `nomUser`, `prenomUser`, `loginUser`, `passwordUser`, `telephone`, `mail`, `photoUser`, `structureUser`, `supprimer`) VALUES
(1, 'GUILAVOGUI', 'Philippe Kolama', 'philippegui2', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', '00221777052940', 'philippekolama@gmail.com', '', 1, 0),
(2, 'GUILAVOGUI', 'Philippe Kolama', 'philippe', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', '00221777052940', 'philippekolama@gmail.com', '', 7, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `donnees`
--
ALTER TABLE `donnees`
  ADD PRIMARY KEY (`idDonnees`),
  ADD KEY `fk_donnees_structure` (`idStructure`);

--
-- Index pour la table `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`idStructure`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `fk_users_statut` (`structureUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `donnees`
--
ALTER TABLE `donnees`
  MODIFY `idDonnees` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `structures`
--
ALTER TABLE `structures`
  MODIFY `idStructure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `donnees`
--
ALTER TABLE `donnees`
  ADD CONSTRAINT `fk_donnees_structure` FOREIGN KEY (`idStructure`) REFERENCES `structures` (`idStructure`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_statut` FOREIGN KEY (`structureUser`) REFERENCES `structures` (`idStructure`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
