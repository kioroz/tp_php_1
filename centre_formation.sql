-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 17 fév. 2026 à 15:50
-- Version du serveur : 8.0.44
-- Version de PHP : 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `centre_formation`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id_etudiant` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id_etudiant`, `nom`, `prenom`, `date_naissance`, `email`, `telephone`) VALUES
(1, 'Dupont', 'Lucas', '2005-03-12', 'lucas.dupont@mail.fr', '0612345678'),
(2, 'Martin', 'Emma', '2004-07-22', 'emma.martin@mail.fr', '0623456789'),
(3, 'Durand', 'Léo', '2005-01-10', 'leo.durand@mail.fr', '0611223344'),
(4, 'Petit', 'Sarah', '2004-11-05', 'sarah.petit@mail.fr', '0677889900'),
(5, 'Moreau', 'Adam', '2005-06-18', 'adam.moreau@mail.fr', '0655443322'),
(6, 'mohamed', 'aziz', '2006-08-20', 'momo@gmail.com', '785451452654156');

-- --------------------------------------------------------

--
-- Structure de la table `formateurs`
--

CREATE TABLE `formateurs` (
  `id_formateur` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `specialite` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formateurs`
--

INSERT INTO `formateurs` (`id_formateur`, `nom`, `prenom`, `specialite`, `email`) VALUES
(1, 'Bernard', 'Sophie', 'Développement Web', 'sophie.bernard@mail.fr'),
(2, 'Leclerc', 'Antoine', 'Réseau', 'antoine.leclerc@mail.fr'),
(3, 'Rousseau', 'Claire', 'Base de données', 'claire.rousseau@mail.fr'),
(4, 'Germain', 'Paul', 'Cybersécurité', 'paul.germain@mail.fr'),
(5, 'Lambert', 'Julie', 'Systèmes', 'julie.lambert@mail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id_formation` int NOT NULL,
  `intitule` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `duree` int NOT NULL,
  `niveau` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_formateur` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id_formation`, `intitule`, `duree`, `niveau`, `id_formateur`) VALUES
(1, 'BTS SIO SLAM', 1350, 'BTS', 1),
(2, 'Développement Web', 400, 'Débutant', 2),
(3, 'Administration Réseau', 500, 'Intermédiaire', 2),
(4, 'Cybersécurité', 450, 'Avancé', 4),
(5, 'Base de données SQL', 300, 'Débutant', 3),
(6, 'Système', 60, 'Debutant', 5);

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id_inscription` int NOT NULL,
  `id_etudiant` int NOT NULL,
  `id_formation` int NOT NULL,
  `date_inscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id_inscription`, `id_etudiant`, `id_formation`, `date_inscription`) VALUES
(1, 1, 1, '2025-01-15'),
(2, 2, 2, '2025-01-20'),
(3, 3, 2, '2025-01-22'),
(4, 4, 3, '2025-02-01'),
(5, 5, 5, '2025-02-10');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id_module` int NOT NULL,
  `nom_module` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `coefficient` int NOT NULL,
  `id_formation` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id_module`, `nom_module`, `coefficient`, `id_formation`) VALUES
(1, 'Programmation PHP', 3, 2),
(2, 'Base de données MySQL', 4, 2),
(3, 'Réseaux TCP/IP', 3, 3),
(4, 'Sécurité des systèmes', 4, 4),
(5, 'SQL Avancé', 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id_note` int NOT NULL,
  `id_etudiant` int NOT NULL,
  `id_module` int NOT NULL,
  `note` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id_note`, `id_etudiant`, `id_module`, `note`) VALUES
(1, 1, 1, 14.50),
(2, 2, 1, 16.00),
(3, 3, 2, 12.75),
(4, 4, 3, 15.20),
(5, 5, 5, 17.80);

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

CREATE TABLE `salles` (
  `id_salle` int NOT NULL,
  `nom_salle` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `capacite` int NOT NULL,
  `equipement` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salles`
--

INSERT INTO `salles` (`id_salle`, `nom_salle`, `capacite`, `equipement`) VALUES
(1, 'Salle A', 20, 'Ordinateurs, Vidéoprojecteur'),
(2, 'Salle B', 25, 'Tableaux, Wi-Fi'),
(3, 'Salle C', 15, 'Ordinateurs'),
(4, 'Salle D', 30, 'Vidéoprojecteur, Sonorisation'),
(5, 'Salle E', 18, 'Wi-Fi, Tableaux');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass` text COLLATE utf8mb4_general_ci,
  `role` enum('admin','enseignant','etudiant') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'enseignant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `role`) VALUES
(1, 'kio', '$2y$10$.Yp3vlp3J9hF8T8KR8Cig.afde1CjRPh9P9SEcPXe/KIgb602Ragy', 'admin'),
(2, 'kio', '$2y$10$ZyB/2TM384L0V9/Q8ra5GOHDN1rxV74YP4OvH7vQ0WeYlsiiwIyVK', 'etudiant'),
(3, 'az', '$2y$10$mT6iTFAxokmu/0s24eqHCOtGmQxA4nQk6j04cJjK6ysaChrrzEzb2', 'enseignant'),
(4, 'maxime_cholley', '$2y$10$RZAvLfMKzkTaP7zhBK3ZROcE4Gne0b/2u/LEOHq9w8ge/5OB88Wu2', 'enseignant'),
(5, 'mohamed_aziz91', '$2y$10$PeB3befL5qyIixAoOAxw3uXvTJpAZlxVUyhklONLSOb9q6Zxd93jK', 'enseignant'),
(6, 'test', '$2y$10$rByVBGn.kwBiPOoLg.AJyekAD9vX5qi4PmAxRph7WpBXHtg5LAylK', 'enseignant'),
(7, 'aaaa', '$2y$10$yW/1QQuoRO.AcCtOpzfgw.wcTzy49/uPcF5WuiunVMC6CxQfzHNzy', 'enseignant'),
(8, 'aaaa', '$2y$10$4/g6c.pmYqfywZoET28Fc.NMoIePoLG7uIuPWGbvAkTRVNKI5fMDa', 'enseignant'),
(9, 'oo', '$2y$10$KFraXmZHYGaXHcDMGyFqQey86iAhCIFzomm9crWKUkpGo7w/sO9lK', 'enseignant'),
(10, 'zz', '$2y$10$hEkyZ1Kc6DGjj58OoZxL4.PLOvmIKVI9.fHkx.HfGqYzRoOlmZC1S', 'enseignant'),
(11, 'test1', '$2y$10$lYFoRIEfocG0sKtP6H/JQuvJeKHEHfsCGaCsvKgR9l4p75eDfUIoy', 'enseignant');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- Index pour la table `formateurs`
--
ALTER TABLE `formateurs`
  ADD PRIMARY KEY (`id_formateur`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id_formation`),
  ADD KEY `id_formateur` (`id_formateur`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id_inscription`),
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_formation` (`id_formation`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id_module`),
  ADD KEY `id_formation` (`id_formation`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_module` (`id_module`);

--
-- Index pour la table `salles`
--
ALTER TABLE `salles`
  ADD PRIMARY KEY (`id_salle`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id_etudiant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `formateurs`
--
ALTER TABLE `formateurs`
  MODIFY `id_formateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id_formation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `id_inscription` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id_module` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id_note` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `salles`
--
ALTER TABLE `salles`
  MODIFY `id_salle` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `formations_ibfk_1` FOREIGN KEY (`id_formateur`) REFERENCES `formateurs` (`id_formateur`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `inscriptions_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscriptions_ibfk_2` FOREIGN KEY (`id_formation`) REFERENCES `formations` (`id_formation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formations` (`id_formation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
