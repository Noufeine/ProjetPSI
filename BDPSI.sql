-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Ven 01 Mai 2020 à 00:31
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `BDPSI`
--

-- --------------------------------------------------------

--
-- Structure de la table `association_groupe`
--

CREATE TABLE `association_groupe` (
  `id_association` int(11) NOT NULL,
  `fid_groupe_1` int(11) NOT NULL,
  `fid_groupe_2` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `composante`
--

CREATE TABLE `composante` (
  `id_composante` bigint(20) NOT NULL,
  `libelle_composante` varchar(255) DEFAULT NULL,
  `code_composante` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `composante`
--

INSERT INTO `composante` (`id_composante`, `libelle_composante`, `code_composante`) VALUES
(1, 'Droit et Science Politique (DSP)', 'DSP'),
(2, 'Langues et Cultures Étrangères (LCE)', 'LCE'),
(3, 'Philosophie, Information-Communication, Langage, Littérature, Arts du Spectacle (PHILLIA)', 'PHILLIA'),
(4, 'Sciences Économiques, Gestion, Mathématiques, Informatique', 'SEGMI'),
(5, 'Systèmes Industriels et Techniques de Communication', 'SITEC'),
(6, 'Sciences Psychologiques et Sciences de l''Éducation (SPSE)', 'SPSE'),
(7, 'Sciences Sociales et Administration (SSA)', 'SSA'),
(8, 'Sciences et Techniques des Activités Physiques et Sportives (STAPS)', 'STAPS'),
(9, 'IUT Ville d''Avray / Saint-Cloud / Nanterre', 'IUT'),
(10, 'Institut de Préparation à l''Administration Générale (IPAG)', 'IPAG');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id_cours` bigint(20) NOT NULL,
  `libelle_cours` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `libelle_cours`) VALUES
(1, 'PHP'),
(2, 'Bases de Données Avancées'),
(3, 'Outils du Développement Logiciel'),
(4, 'Recherche d''Information'),
(5, 'Droit et Données'),
(6, 'Economie publique');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id_formation` bigint(20) NOT NULL,
  `libelle_formation` varchar(255) DEFAULT NULL,
  `VET` varchar(255) DEFAULT NULL,
  `fid_composante` bigint(20) DEFAULT NULL,
  `code_formation` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `formation`
--

INSERT INTO `formation` (`id_formation`, `libelle_formation`, `VET`, `fid_composante`, `code_formation`) VALUES
(1, 'Méthodes informatiques appliquées à la gestion des entreprises\r\n', NULL, 4, 'MIAGE'),
(2, 'Mathématiques et informatiques appliquées aux sciences humaines et sociales', NULL, 4, 'MIASHS');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_groupe` bigint(20) NOT NULL,
  `libelle_groupe` varchar(255) DEFAULT NULL,
  `fid_formation` bigint(20) DEFAULT NULL,
  `fid_modalite` bigint(20) DEFAULT NULL,
  `fid_niveau` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `libelle_groupe`, `fid_formation`, `fid_modalite`, `fid_niveau`) VALUES
(11, 'L3_MIAGE_APP', 1, 2, 3),
(12, 'L2_MIASHS', 2, 3, 2),
(13, 'L1_MIASHS', 2, 3, 1),
(14, 'M1_MIAGE_APP', 1, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `groupe_individu`
--

CREATE TABLE `groupe_individu` (
  `fid_groupe` bigint(20) NOT NULL,
  `fid_individu` bigint(20) NOT NULL,
  `annee` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `individu`
--

CREATE TABLE `individu` (
  `id_individu` bigint(20) NOT NULL,
  `annuaire` bigint(20) DEFAULT NULL,
  `nom_individu` varchar(255) DEFAULT NULL,
  `prenom_individu` varchar(255) DEFAULT NULL,
  `mail_individu` varchar(255) DEFAULT NULL,
  `tel_individu` varchar(255) DEFAULT NULL,
  `fid_type_individu` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `modalite`
--

CREATE TABLE `modalite` (
  `id_modalite` bigint(20) NOT NULL,
  `libelle_modalite` varchar(255) DEFAULT NULL,
  `code_modalite` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `modalite`
--

INSERT INTO `modalite` (`id_modalite`, `libelle_modalite`, `code_modalite`) VALUES
(1, 'Mixte', 'Mixte'),
(2, 'Apprentissage', 'APP'),
(3, 'Formation initiale', 'FI'),
(4, 'Formation continue', 'FC'),
(5, 'Enseignement à distance', 'EAD'),
(6, 'Contrat de professionnalisation', 'CP');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id_niveau` bigint(20) NOT NULL,
  `libelle_niveau` varchar(255) DEFAULT NULL,
  `code_niveau` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`id_niveau`, `libelle_niveau`, `code_niveau`) VALUES
(1, 'Licence 1', 'L1'),
(2, 'Licence 2', 'L2'),
(3, 'Licence 3', 'L3'),
(4, 'Master 1', 'M1'),
(5, 'Master 2', 'M2');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` bigint(20) NOT NULL,
  `numero_salle` varchar(200) DEFAULT NULL,
  `capacite_salle` bigint(20) DEFAULT NULL,
  `nb_postes` bigint(20) DEFAULT NULL,
  `projecteur` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `numero_salle`, `capacite_salle`, `nb_postes`, `projecteur`) VALUES
(1, 'G21', NULL, NULL, NULL),
(2, 'G203', NULL, NULL, NULL),
(3, 'FA', NULL, NULL, NULL),
(4, 'F103', NULL, NULL, NULL),
(5, 'E104', NULL, NULL, NULL),
(6, 'G101', NULL, NULL, NULL),
(7, 'F102', NULL, NULL, NULL),
(8, 'F103', NULL, NULL, NULL),
(9, 'G505', NULL, NULL, NULL),
(10, 'F404', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `id_seance` bigint(20) NOT NULL,
  `fid_salle` bigint(20) DEFAULT NULL,
  `fid_type_seance` bigint(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `seance`
--

INSERT INTO `seance` (`id_seance`, `fid_salle`, `fid_type_seance`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 1),
(5, 5, 2),
(6, 6, 1),
(7, 7, 2),
(8, 8, 1),
(9, 9, 2),
(10, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `seance_groupe`
--

CREATE TABLE `seance_groupe` (
  `date_debut_seance` datetime NOT NULL,
  `date_fin_seance` datetime NOT NULL,
  `fid_seance` bigint(20) NOT NULL,
  `fid_groupe` bigint(20) NOT NULL,
  `fid_individu` bigint(20) NOT NULL,
  `fid_cours` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `seance_groupe`
--

INSERT INTO `seance_groupe` (`date_debut_seance`, `date_fin_seance`, `fid_seance`, `fid_groupe`, `fid_individu`, `fid_cours`) VALUES
('2020-04-29 08:00:00', '2020-04-29 10:30:00', 9, 3, 34100, 1),
('2020-04-30 08:30:00', '2020-04-30 10:30:00', 5, 3, 34103, 1),
('2020-04-30 08:00:00', '2020-04-30 09:30:00', 5, 10, 34100, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_individu`
--

CREATE TABLE `type_individu` (
  `id_type_individu` bigint(20) NOT NULL,
  `libelle_type_individu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `type_individu`
--

INSERT INTO `type_individu` (`id_type_individu`, `libelle_type_individu`) VALUES
(1, 'Enseignant'),
(2, 'Etudiant');

-- --------------------------------------------------------

--
-- Structure de la table `type_seance`
--

CREATE TABLE `type_seance` (
  `id_type_seance` bigint(20) NOT NULL,
  `libelle_type_seance` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `type_seance`
--

INSERT INTO `type_seance` (`id_type_seance`, `libelle_type_seance`) VALUES
(1, 'TD'),
(2, 'CM'),
(3, 'Examen');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `association_groupe`
--
ALTER TABLE `association_groupe`
  ADD PRIMARY KEY (`id_association`);

--
-- Index pour la table `composante`
--
ALTER TABLE `composante`
  ADD PRIMARY KEY (`id_composante`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_formation`),
  ADD KEY `fid_composante` (`fid_composante`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_groupe`),
  ADD KEY `fid_formation` (`fid_formation`),
  ADD KEY `fid_modalite` (`fid_modalite`),
  ADD KEY `fid_niveau` (`fid_niveau`);

--
-- Index pour la table `groupe_individu`
--
ALTER TABLE `groupe_individu`
  ADD PRIMARY KEY (`fid_groupe`,`fid_individu`),
  ADD KEY `fid_individu` (`fid_individu`);

--
-- Index pour la table `individu`
--
ALTER TABLE `individu`
  ADD PRIMARY KEY (`id_individu`),
  ADD KEY `fid_type_individu` (`fid_type_individu`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modalite`
--
ALTER TABLE `modalite`
  ADD PRIMARY KEY (`id_modalite`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id_niveau`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`id_seance`),
  ADD KEY `fid_salle` (`fid_salle`),
  ADD KEY `fid_type_seance` (`fid_type_seance`);

--
-- Index pour la table `seance_groupe`
--
ALTER TABLE `seance_groupe`
  ADD PRIMARY KEY (`date_debut_seance`,`date_fin_seance`,`fid_seance`,`fid_groupe`,`fid_individu`,`fid_cours`),
  ADD KEY `fid_groupe` (`fid_groupe`),
  ADD KEY `fid_individu` (`fid_individu`),
  ADD KEY `fid_cours` (`fid_cours`);

--
-- Index pour la table `type_individu`
--
ALTER TABLE `type_individu`
  ADD PRIMARY KEY (`id_type_individu`);

--
-- Index pour la table `type_seance`
--
ALTER TABLE `type_seance`
  ADD PRIMARY KEY (`id_type_seance`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `association_groupe`
--
ALTER TABLE `association_groupe`
  MODIFY `id_association` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `composante`
--
ALTER TABLE `composante`
  MODIFY `id_composante` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id_formation` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_groupe` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `modalite`
--
ALTER TABLE `modalite`
  MODIFY `id_modalite` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id_niveau` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `id_seance` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `type_seance`
--
ALTER TABLE `type_seance`
  MODIFY `id_type_seance` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
