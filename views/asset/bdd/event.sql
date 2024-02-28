-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 28 fév. 2024 à 16:22
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
-- Base de données : `event`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `categorie_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `categorie_name`) VALUES
(9, 'amellia'),
(6, 'Comédie musicale'),
(7, 'Comédie musicaleSSSSSS'),
(3, 'concert'),
(5, 'festival'),
(2, 'spectacle'),
(10, 'Test'),
(1, 'théâtre');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id_evenement` int(11) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `prix` double NOT NULL,
  `resume` text NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `date_event` date NOT NULL,
  `nbr_place` int(11) NOT NULL,
  `events_actif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_evenement`, `titre`, `prix`, `resume`, `categorie_id`, `image`, `date_event`, `nbr_place`, `events_actif`) VALUES
(1, 'spectacle des lumières', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 2, '', '2024-04-25', 10, 1),
(2, 'spectacle vivant', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 2, '', '2024-04-27', 30, 1),
(3, 'FESTIVAL D&#039;ÉTÉ', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 5, '', '2024-04-30', 10, 0),
(5, 'Salon des plantes', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 2, 'Capture d’écran 2023-11-23 153344.jpg', '2024-03-27', 20, 1),
(6, 'douce nuit', 60, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 9, 'Capture d’écran 2023-11-13 104509.jpg', '2023-12-28', 2, 1),
(7, 'visite nocturne', 150, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 9, 'voiture.jpg', '2023-12-27', 45, 1),
(8, 'la suite', 75, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 7, '', '2024-02-29', 20, 0),
(9, 'Salon des plantes', 245, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 6, '', '2024-02-27', 20, 1),
(10, 'Un jour, une vie', 25, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 3, 'mer.JPG', '2024-01-25', 30, 1),
(11, 'Salon nautique', 15, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 7, 'mer.JPG', '2024-01-31', 10, 1),
(12, 'Salon de l&#039;automobile', 13, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 9, 'voiture.jpg', '2024-02-15', 30, 1),
(13, 'spectacle des lumières', 16, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 6, 'Capture d’écran 2023-11-13 104509.jpg', '2024-03-20', 45, 1),
(14, 'Atelier couture', 10, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 10, 'mer_3.jpg', '2023-12-27', 15, 1),
(15, 'Test', 10, 'blabla', 10, 'tropic.jpg', '2024-03-28', 50, 1);

-- --------------------------------------------------------

--
-- Structure de la table `event_date`
--

CREATE TABLE `event_date` (
  `id_event_date` int(11) NOT NULL,
  `list_date` date NOT NULL,
  `evenement_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `list_date`
--

CREATE TABLE `list_date` (
  `id_list_date` int(11) NOT NULL,
  `dates` date NOT NULL,
  `horaires` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date_reservation` datetime NOT NULL DEFAULT current_timestamp(),
  `place_reserve` int(11) NOT NULL,
  `reservation_actif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `user_id`, `event_id`, `date_reservation`, `place_reserve`, `reservation_actif`) VALUES
(2, 15, 1, '2023-11-21 12:09:49', 1, 1),
(3, 14, 2, '2023-11-21 12:09:49', 1, 1),
(4, 15, 5, '2023-11-21 12:09:49', 1, 1),
(5, 17, 6, '2023-11-21 12:09:49', 1, 1),
(6, 17, 8, '2023-11-21 12:09:49', 1, 1),
(9, 15, 6, '2023-11-21 12:09:49', 1, 1),
(10, 15, 1, '2023-11-21 12:09:49', 0, 0),
(11, 8, 14, '2023-11-21 12:09:49', 0, 0),
(12, 8, 10, '2023-11-21 12:09:49', 1, 1),
(13, 8, 10, '2023-11-21 12:09:49', 1, 1),
(14, 8, 10, '2023-11-21 12:09:49', 1, 1),
(15, 8, 10, '2023-11-21 12:09:49', 1, 1),
(16, 8, 10, '2023-11-21 12:09:49', 1, 1),
(17, 8, 3, '2023-11-21 12:09:49', 1, 1),
(18, 8, 3, '2023-11-21 12:09:49', 1, 1),
(19, 17, 11, '2023-11-21 12:09:49', 1, 1),
(20, 17, 5, '2023-11-21 12:09:49', 1, 1),
(22, 17, 7, '2023-11-21 12:09:49', 1, 1),
(23, 17, 12, '2023-11-21 12:09:49', 1, 1),
(26, 17, 8, '2023-11-21 12:09:49', 1, 1),
(27, 17, 8, '2023-11-21 12:09:49', 1, 1),
(33, 17, 14, '2023-11-21 12:09:49', 1, 1),
(34, 17, 14, '2023-11-21 12:09:49', 1, 1),
(35, 18, 14, '2023-11-21 12:09:49', 1, 1),
(36, 18, 11, '2023-11-21 12:09:49', 1, 1),
(37, 18, 14, '2023-11-21 12:09:49', 1, 1),
(38, 17, 1, '2023-11-21 12:09:49', 1, 1),
(39, 17, 1, '2023-11-21 12:09:49', 1, 1),
(40, 17, 1, '2023-11-21 12:09:49', 1, 1),
(41, 17, 10, '2023-11-21 12:09:49', 1, 1),
(42, 19, 15, '2023-11-21 12:09:49', 1, 1),
(43, 19, 10, '2023-11-24 09:31:22', 2, 1),
(44, 19, 10, '2023-11-24 10:04:33', 0, 0),
(45, 17, 10, '2023-11-24 10:05:55', 1, 1),
(46, 18, 15, '2023-11-24 10:12:10', 1, 1),
(47, 17, 14, '2023-12-13 10:39:07', 1, 1),
(48, 17, 14, '2023-12-13 10:39:15', 1, 1),
(49, 17, 14, '2023-12-13 10:39:45', 1, 1),
(50, 17, 15, '2023-12-13 11:32:18', 1, 1),
(51, 17, 15, '2023-12-13 11:54:12', 1, 1),
(52, 17, 15, '2023-12-13 12:17:19', 1, 1),
(53, 19, 14, '2023-12-13 13:39:10', 1, 1),
(54, 19, 11, '2023-12-13 13:39:40', 1, 1),
(55, 11, 15, '2023-12-13 14:50:28', 1, 1),
(56, 11, 10, '2023-12-13 16:25:05', 1, 1),
(57, 11, 5, '2023-12-14 16:18:53', 1, 1),
(58, 11, 7, '2023-12-14 16:28:30', 1, 1),
(59, 15, 15, '2023-12-15 11:31:30', 1, 1),
(60, 15, 7, '2023-12-15 11:49:54', 1, 1),
(61, 15, 5, '2023-12-15 14:41:56', 1, 1),
(62, 19, 10, '2023-12-19 13:36:58', 0, 0),
(63, 19, 10, '2023-12-19 14:06:56', 1, 1),
(64, 20, 7, '2023-12-20 11:20:15', 1, 1),
(68, 20, 12, '2024-01-17 14:28:20', 3, 1),
(69, 20, 1, '2024-01-17 14:34:44', 2, 1),
(70, 23, 10, '2024-01-23 16:02:21', 4, 1),
(71, 19, 1, '2024-02-27 10:32:01', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_utilisateur` int(11) NOT NULL,
  `img_profil` varchar(250) DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` enum('admin','client') NOT NULL DEFAULT 'admin',
  `users_actif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_utilisateur`, `img_profil`, `nom`, `prenom`, `pseudo`, `email`, `mdp`, `role`, `users_actif`) VALUES
(5, '', 'anna', 'anna', 'anna', 'anna@mail.com', '$2y$10$k00e92DZrfFPEIVJUi.07OLz00wtF3PEGxOGYx.dhXp', 'admin', 1),
(6, '', 'anna', 'anna', 'anna1', 'anna1@mail.com', '$2y$10$Nj.SEJbXSyw5ybfjCDnYRenJxbXj1y5VAcHQIZWo1U9', 'admin', 1),
(7, '', 'anna', 'anna2', 'anna2', 'anna2@mail.com', '$2y$10$KCFOv.O75Kj2OtdHgbjmnelzx8L.ZYwYsvQuj4E7B.d', 'admin', 1),
(8, '', 'lea', 'lea', 'lea', 'lea@mail.com', '$2y$10$Hdpj1LKd9rUbljqlte/D9eTxDwYdpqiwoBae9bgkQFaI06jvFXlr2', 'admin', 1),
(9, '', 'anna3', 'ANNA3', 'anna3', 'anna3@mail.com', '$2y$10$Hdpj1LKd9rUbljqlte/D9eTxDwYdpqiwoBae9bgkQFaI06jvFXlr2', 'admin', 1),
(10, '', 'jeremy', 'jeremy', 'jeremy1', 'jeremy@mail.fr', '$2y$10$of6PrfF4yfeQ5Se88t3n8eje4vcR8CPc8rxlCX/CpH/HW8EqkiI4u', 'admin', 1),
(11, '', 'ben', 'ben', 'ben1', 'ben@mail.com', '$2y$10$IvwfhW.EzIbzPKDO7XQUW.P39KjAUlAoEmK.aNLi1083iGqSyHhky', 'client', 1),
(14, '', 'carlito', 'carl', 'carl', 'carl@mail.com', '$2y$10$zSXMj/RkoUv0pgbZD1xOueK7Rvh.Z3qukhypz15Y9AL2onU3R8vDe', 'admin', 1),
(15, '', 'leon', 'leon', 'leon', 'leon@mail.com', '$2y$10$eDvcuowTwmnt7ogxn91x7Or3UP/C6U.TKVyb.Me8Y7eO/89hEc5Zm', 'client', 1),
(17, '', 'louis', 'louis', 'louis', 'louis@mail.com', '$2y$10$QthSjDQhI8W.gnlLdNnWuOij8w533hArs3GmScNwqj1lJ1NneXhou', 'client', 1),
(18, '', 'clara', 'clara', 'clara', 'clara@mail.com', '$2y$10$Cl1TNvAEU69S6a7ZS81F4uwFQwke.OrDV5FUJddL6R5JCwObVeTVm', 'client', 1),
(19, '', 'jean', 'jean', 'jean', 'jean@mail.com', '$2y$10$/OIvxukXkuknXAcAR2CtsOoitVsw50.s/bX0RD8okLDf4VcMiKn1u', 'client', 1),
(20, '', 'MARC', 'marc', 'marc', 'marc@mail.com', '$2y$10$VbO1DZeYaxcJlsw1XVXdfeU/uTj.NnPykTNa5qa/tiGu51sFTxMMe', 'client', 1),
(21, '', 'ANNE', 'anne', 'anne', 'anne@mail.com', '$2y$10$6bfMJ2BGfmPfobns.ggv/.tUg3h5PJKokTRpyROKNbf0U7IvxpkzG', 'admin', 1),
(22, 'profil.JPG', 'test', 'test', 'test', 'test@mail.com', '$2y$10$Opm/A3CVKAH4doMe2UNaUO04ga6tLJECnHsJtx0l/S/l8pAwp3jB.', 'admin', 1),
(23, 'profil.JPG', 'test2', 'test2', 'test2', 'test2@mail.com', '$2y$10$1VSp.gS4JNPPzQ9Gp2tAJ.1e5L2P2tVTeOu5uuxrCWZQNd5SC4FBC', 'client', 1),
(24, 'profil.JPG', 'Laure', 'laure', 'laure', 'laure@mail.com', '$2y$10$R1C452HrJLGzLRXdIzUDguB0awS81ZQ97vOL51mNQ7A2HSRA9nM2m', 'admin', 1),
(25, 'profil.JPG', 'mike', 'mike', 'mike', 'mike@mail.com', '$2y$10$mg9rGMPj/4SwSmzJmv5KC.ke5ZrKc542Om22KTKL7.nBvUq2svQ1y', 'admin', 1),
(26, 'profil.JPG', 'lina', 'lina', 'lina', 'lina@mail.com', '$2y$10$oRBJFNSmF0JLPfr7/ZWbXOWmioJzkn4oQm.etHBQgrCxpOKJfa6JG', 'admin', 1),
(28, 'profil.JPG65ddbe027a774', 'nina', 'nina', 'nina', 'nina@mail.com', '$2y$10$6V7rVICXYpXdJhCxqbgOA.tlwG6orWdmRMSfFFLzqT73N.GwdqGe6', 'admin', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`),
  ADD UNIQUE KEY `categorie_name` (`categorie_name`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_evenement`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Index pour la table `event_date`
--
ALTER TABLE `event_date`
  ADD PRIMARY KEY (`id_event_date`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `event_date`
--
ALTER TABLE `event_date`
  MODIFY `id_event_date` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id_evenement`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_utilisateur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
