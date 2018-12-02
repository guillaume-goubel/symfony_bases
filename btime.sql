-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 30 nov. 2018 à 17:34
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `btime`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `icon`) VALUES
(1, 'Relaxation', 'relaxation_icon.png'),
(2, 'Litterature', 'litterature_icon.png'),
(3, 'Sport', 'sport_icon.png'),
(4, 'Beer', 'beer_icon.png');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double DEFAULT NULL,
  `poster` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `place_id`, `owner_id`, `name`, `created_at`, `start_at`, `end_at`, `content`, `price`, `poster`) VALUES
(1, 1, 1, 'Le rendez-vous des bons copains', '2018-11-07 08:00:00', '2018-11-29 21:00:00', '2018-11-29 23:00:00', 'Venez déguster de bonnes bières en toute simplicité', 10, 'biere.jpg'),
(2, 1, 2, 'Parlons vrai', '2018-08-01 08:00:00', '2018-09-27 15:00:00', '2018-09-27 20:00:00', 'Un après-midi détente et littérature', 50, 'philosophie.jpg'),
(3, 2, 3, 'On refait le match', '2018-11-21 08:00:00', '2018-12-27 15:00:00', '2018-12-29 17:00:00', '2 jours pour refaire la saison de foot du Rc Boul', 70, 'sport.jpg'),
(4, 3, 5, 'Supportons notre club', '2018-11-08 13:00:00', '2018-12-11 15:00:00', '2018-12-11 22:00:00', 'Organisons nous pour le dernier match de la saison', 20, 'sport2.jpg'),
(5, 2, 6, 'Se relaxer avec les plantes', '2018-11-14 15:00:00', '2019-01-17 15:00:00', '2019-01-17 20:00:00', 'Se relaxer avec les plantes , voici la solution !', 150, 'plante.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `event_category`
--

CREATE TABLE `event_category` (
  `event_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event_category`
--

INSERT INTO `event_category` (`event_id`, `category_id`) VALUES
(1, 4),
(2, 2),
(3, 3),
(4, 3),
(5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `place`
--

INSERT INTO `place` (`id`, `name`, `address`, `zip_code`, `city`, `country`) VALUES
(1, 'Bistrot place de la gare', '37 rue des la Gare ', '59000', 'Lille', 'France'),
(2, 'Salle municipale', '35 rue de la république', '59510', 'Hem', 'France'),
(3, 'restaurant le Romarin', '12 Allée du nord', '59120', 'Tourcoing', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `roles`) VALUES
(1, 'Julie', 'julie@gmail.com', '1234', 'a:1:{i:0,s:9:\"ROLE_USER\";}'),
(2, 'Hamed', 'hamel@gmail.com', '1234', 'a:1:{i:0,s:9:\"ROLE_USER\";}'),
(3, 'Paul', 'paul@gmail.com', '4567', 'a:1:{i:0,s:9:\"ROLE_USER\";}'),
(4, 'Gontran', 'gontran@gmail.com', '7894', 'a:1:{i:0,s:9:\"ROLE_USER\";}'),
(5, 'Fred', 'fred@gmail.com', '12345', 'a:1:{i:0,s:9:\"ROLE_USER\";}'),
(6, 'Louise', 'louise@gmail.com', '7894', 'a:1:{i:0,s:9:\"ROLE_USER\";}');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BAE0AA7DA6A219` (`place_id`),
  ADD KEY `IDX_3BAE0AA77E3C61F9` (`owner_id`);

--
-- Index pour la table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`event_id`,`category_id`),
  ADD KEY `IDX_40A0F01171F7E88B` (`event_id`),
  ADD KEY `IDX_40A0F01112469DE2` (`category_id`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`event_id`,`user_id`),
  ADD KEY `IDX_AB55E24F71F7E88B` (`event_id`),
  ADD KEY `IDX_AB55E24FA76ED395` (`user_id`);

--
-- Index pour la table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `place`
--
ALTER TABLE `place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA77E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7DA6A219` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`);

--
-- Contraintes pour la table `event_category`
--
ALTER TABLE `event_category`
  ADD CONSTRAINT `FK_40A0F01112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_40A0F01171F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `FK_AB55E24F71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_AB55E24FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
