-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 fév. 2026 à 10:15
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `workshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`category_id`, `libelle`) VALUES
(1, 'Divertissement'),
(2, 'Professionnel'),
(3, 'Aventure'),
(4, 'Voyage');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `reservations_id` int(11) NOT NULL,
  `workshops_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`reservations_id`, `workshops_id`, `user_id`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`roles_id`, `libelle`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `roles_id`) VALUES
(1, 'admin', 'admin@test.com', '$2y$10$BP2rMJGpJTgPSVcw6DRdju0ZMZTfAwocqDPmvixNKd99JIyOVkfsy', 1),
(2, 'user', 'user@test.com', '$2y$10$4pUH4rLBeIeUt6TMwkodreGEzSdbbqKrSV/9ajfXO5HLTs2.l48FC', 2);

-- --------------------------------------------------------

--
-- Structure de la table `workshops`
--

CREATE TABLE `workshops` (
  `workshops_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'image de l''évènement',
  `date` datetime NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `workshops`
--

INSERT INTO `workshops` (`workshops_id`, `title`, `description`, `image`, `date`, `capacity`, `category_id`) VALUES
(2, 'château d&#039;Angers', 'Découvrez un château d’exception lors d’une visite guidée à travers son histoire et son architecture.\r\nProlongez l’expérience par une dégustation de vins dans la cave du château, en compagnie de passionnés.\r\nUn moment convivial mêlant patrimoine, terroir et plaisir des sens.', 'chateau_angers.webp', '2026-02-10 10:00:00', 30, 1),
(3, 'conférence IA', 'Participez à une conférence dédiée à l’intelligence artificielle et découvrez ses enjeux, ses applications actuelles et ses perspectives d’avenir.\r\nDes experts du domaine partageront leurs connaissances et retours d’expérience à travers des interventions accessibles et enrichissantes.\r\nUn rendez-vous incontournable pour mieux comprendre l’IA et son impact sur notre quotidien et le monde professionnel.', 'conference.jpeg', '2026-02-15 18:00:00', 200, 2),
(4, 'Indiana Jones', 'Partez pour une aventure captivante lors d’une chasse au trésor en pleine montagne.\r\nExplorez sentiers et paysages tout en résolvant des énigmes et défis pour découvrir le trésor caché.\r\nUne activité ludique et conviviale, idéale pour se connecter à la nature et partager des moments inoubliables.', 'indiana_jones.jpg', '2026-02-25 07:30:00', 7, 3),
(5, 'Prise de la Bastille', 'Prise de la Bastille tah l&#039;époque de la révolution française ', 'bastille.jpg', '2026-07-14 00:00:00', 70000000, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservations_id`),
  ADD KEY `workshops_id` (`workshops_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roles_id` (`roles_id`);

--
-- Index pour la table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`workshops_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservations_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `workshops_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`workshops_id`) REFERENCES `workshops` (`workshops_id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`roles_id`);

--
-- Contraintes pour la table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
