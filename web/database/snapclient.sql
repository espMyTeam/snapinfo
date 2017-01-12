-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Lun 09 Janvier 2017 à 10:22
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

--
-- Contenu de la table `donnees`
--

INSERT INTO `donnees` (`idDonnees`, `idStructure`, `photo`, `longitude`, `latitude`, `lieu`, `datePhoto`, `commentaire`) VALUES
(1, 2, 'photo1.jpg', 'longitu', 'lattis', 'lieu', '2017-01-17 00:00:00', 'le commentaire'),
(2, 2, 'photo2.jpg', 'longitude', 'latitude', 'stade Demba DIOP', '2017-01-17 09:26:12', 'le commentaire'),
(3, 2, 'photo3.jpg', 'longitude', 'latitude', 'le lieu icic', '2017-01-17 09:26:12', 'le commentaire'),
(4, 2, 'photo6.jpg', 'longitude', 'latitude', 'le lieu icic', '2017-01-17 09:26:12', 'le commentaire'),
(5, 2, 'photo5.jpg', 'longitude', 'latitude', 'le lieu ici là', '2017-01-17 09:26:12', 'le commentaire'),
(6, 2, 'photo4.jpg', 'longitude', 'latitude', 'le lieu icic', '2017-01-17 09:26:12', 'le commentaire'),
(7, 2, 'photo8.jpg', 'longitude', 'latitude', 'le lieu icic', '2017-01-17 09:26:12', 'le commentaire'),
(8, 2, 'photo9.jpg', 'longitude', 'latitude', 'le lieu icic', '2017-01-17 09:26:12', 'le commentaire');

-- --------------------------------------------------------

--
-- Structure de la table `structures`
--

CREATE TABLE `structures` (
  `idStructure` int(11) NOT NULL,
  `nomStructure` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `structures`
--

INSERT INTO `structures` (`idStructure`, `nomStructure`) VALUES
(1, 'admin'),
(2, 'mairie de dakar'),
(3, 'police de medina'),
(4, 'police de grand dakar'),
(5, 'police de pikine');

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
(1, 'GUILAVOGUI', 'Philippe kolama', 'philippegui2', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', '', '', '', 1, 0),
(2, 'GUILAVOGUI', 'Kolama', 'philippe', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', '00221777052940', 'philippekolama@gmail.com', 'chemin/photo', 2, 0);

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
  MODIFY `idDonnees` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `structures`
--
ALTER TABLE `structures`
  MODIFY `idStructure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
