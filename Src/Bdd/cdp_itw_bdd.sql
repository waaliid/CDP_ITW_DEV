-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 04 Octobre 2016 à 18:11
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cdp_itw_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

CREATE TABLE `atelier` (
  `id_Atelier` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `theme` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `Remarque` text NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `duree` int(11) NOT NULL,
  `capacite` int(11) NOT NULL,
  `id_creneaux` int(11) NOT NULL,
  `id_labo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `atelier`
--

INSERT INTO `atelier` (`id_Atelier`, `titre`, `theme`, `type`, `Remarque`, `lieu`, `duree`, `capacite`, `id_creneaux`, `id_labo`) VALUES
(1, 'L\'évolution, toute une histoire', 'SVT', 'activite', 'Aucune', 'Salle Omega', 120, 40, 1, 1),
(2, 'Apprendre facilement le c++', 'Informatique', 'cours', 'Ordinateur requis', 'Salle Alpha', 90, 20, 2, 3),
(3, 'Biodiversité, richesse du vivant', 'SVT', 'cours', 'Aucune', 'Salle Beta', 60, 150, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `creneaux`
--

CREATE TABLE `creneaux` (
  `id_creneau` int(11) NOT NULL,
  `id_atelier` int(11) NOT NULL,
  `lundi` varchar(2) NOT NULL,
  `mardi` varchar(2) NOT NULL,
  `mercredi` varchar(2) NOT NULL,
  `jeudi` varchar(2) NOT NULL,
  `vendredi` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `creneaux`
--

INSERT INTO `creneaux` (`id_creneau`, `id_atelier`, `lundi`, `mardi`, `mercredi`, `jeudi`, `vendredi`) VALUES
(1, 1, '0', '1', '10', '11', '0'),
(2, 2, '11', '11', '0', '0', '0'),
(3, 3, '10', '10', '10', '10', '0');

-- --------------------------------------------------------

--
-- Structure de la table `laboratoire`
--

CREATE TABLE `laboratoire` (
  `id_labo` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `laboratoire`
--

INSERT INTO `laboratoire` (`id_labo`, `nom`, `adresse`) VALUES
(1, 'Labri', 'Universite de Bordeaux 1'),
(2, 'CNRS', 'Institut de recherche Bordeaux'),
(3, 'INRIA', 'Institut national de recherche en informatique Bordeaux');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD PRIMARY KEY (`id_Atelier`),
  ADD KEY `id_creneaux` (`id_creneaux`),
  ADD KEY `id_labo` (`id_labo`);

--
-- Index pour la table `creneaux`
--
ALTER TABLE `creneaux`
  ADD PRIMARY KEY (`id_creneau`),
  ADD KEY `id_atelier` (`id_atelier`);

--
-- Index pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  ADD PRIMARY KEY (`id_labo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `atelier`
--
ALTER TABLE `atelier`
  MODIFY `id_Atelier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `creneaux`
--
ALTER TABLE `creneaux`
  MODIFY `id_creneau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  MODIFY `id_labo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
