-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 26 juin 2023 à 12:44
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tp_php_odk`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'bah', 'banee8251@gmail.com', 'admin'),
(2, 'bane', 'banee8251@gmail.com', 'bane');

-- --------------------------------------------------------

--
-- Structure de la table `apprenant`
--

CREATE TABLE `apprenant` (
  `id_a` int(11) NOT NULL,
  `mclle` varchar(20) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `annee_p` int(11) DEFAULT NULL,
  `date_naiss` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `photo` varchar(200) NOT NULL,
  `id_p` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `apprenant`
--

INSERT INTO `apprenant` (`id_a`, `mclle`, `nom`, `prenom`, `annee_p`, `date_naiss`, `email`, `telephone`, `photo`, `id_p`) VALUES
(1, 'P1JNB', 'Bane', 'Moussa', 2023, '11-05-2003', 'bane8251@gmail.com', '82511723', '', NULL),
(2, 'P1JNJ', 'Bah', 'Moussa', 2022, '15-01-2000', 'banee8251@gmail.com', '0022382511723', '', NULL),
(4, 'P2KD', 'Bane', 'Moussa', 2022, '2000-08-25', 'agrotropic123@gmail.com', '0022382511723', '', NULL),
(5, 'P2KDH', 'Bah', 'Moussa', 2022, '2000-08-25', 'agrotropic123@gmail.com', '0022382511723', '', NULL),
(6, 'P1JNJ', 'Bane', 'Moussa', 2023, '15-01-2000', 'bane8251@st.medipol.edu.tr', '82511723', '', NULL),
(7, 'P1LVCO45', 'Bane', 'Moussa', 2022, '15-01-2000', 'bane8251@gmail.com', '82511723', 'uploads/64981abb8ccb9.jpg', NULL),
(9, 'P3', 'Bane', 'Moussa', 2022, '2000-08-25', 'agrotropic123@gmail.com', '0022382511723', '', NULL),
(10, 'P2J', 'Bane', 'Moussa', 2021, '2000-08-25', 'banee8251@gmail.com', '0022382511723', '', NULL),
(12, 'P1ZEZY08', 'Bane', 'Moussa', 2022, '15-01-2000', 'bane8251@gmail.com', '82511723', 'image/6498ab0d8d3c3.jpg', NULL),
(13, 'P1KCUD38', 'Lassanna', 'Keita', 2022, '15-01-2000', 'agrotropic123@gmail.com', '0022382511723', 'image/64995b30ecdd8.jpg', NULL),
(14, 'P1SV34', 'Lassanna', 'Keita', 2022, '15-01-2000', 'agrotropic123@gmail.com', '0022382511723', 'image/64995bb6a1a3f.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id_p` int(11) NOT NULL,
  `nom_p` varchar(50) DEFAULT NULL,
  `annee_pro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_p`, `nom_p`, `annee_pro`) VALUES
(1, 'P2', 2022),
(2, 'P3', 2023),
(3, 'P3', 2024),
(4, 'P1', 2021),
(5, 'P4', 2025),
(6, 'P5', 2026),
(7, 'P6', 2026);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD PRIMARY KEY (`id_a`),
  ADD KEY `fk1` (`id_p`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_p`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `apprenant`
--
ALTER TABLE `apprenant`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_p`) REFERENCES `promotion` (`id_p`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
