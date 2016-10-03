-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 03 Octobre 2016 à 21:14
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cdp_itw_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

CREATE TABLE IF NOT EXISTS `atelier` (
  `id_Atelier` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `theme` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `Remarque` text NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `duree` int(11) NOT NULL,
  `capacite` int(11) NOT NULL,
  `id_creneaux` int(11) NOT NULL,
  `id_labo` int(11) NOT NULL,
  PRIMARY KEY (`id_Atelier`),
  KEY `id_creneaux` (`id_creneaux`),
  KEY `id_labo` (`id_labo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `creneaux`
--

CREATE TABLE IF NOT EXISTS `creneaux` (
  `id_creneau` int(11) NOT NULL AUTO_INCREMENT,
  `id_atelier` int(11) NOT NULL,
  `lundi` int(2) NOT NULL,
  `mardi` int(2) NOT NULL,
  `mercredi` int(2) NOT NULL,
  `jeudi` int(2) NOT NULL,
  `vendredi` int(2) NOT NULL,
  PRIMARY KEY (`id_creneau`),
  KEY `id_atelier` (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `laboratoire`
--

CREATE TABLE IF NOT EXISTS `laboratoire` (
  `id_labo` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `adresse` text NOT NULL,
  PRIMARY KEY (`id_labo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD CONSTRAINT `atelier_ibfk_3` FOREIGN KEY (`id_creneaux`) REFERENCES `creneaux` (`id_creneau`);

--
-- Contraintes pour la table `creneaux`
--
ALTER TABLE `creneaux`
  ADD CONSTRAINT `creneaux_ibfk_1` FOREIGN KEY (`id_atelier`) REFERENCES `atelier` (`id_Atelier`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
