-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 nov. 2023 à 16:48
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
(1, 'spectacle des lumières', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 2, '', '2023-11-27', 10, 1),
(2, 'spectacle vivant', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 2, '', '2023-11-27', 30, 1),
(3, 'FESTIVAL D&#039;ÉTÉ', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 5, '', '2023-11-30', 10, 0),
(5, 'Salon des plantes', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 2, '', '2023-11-16', 20, 1),
(6, 'douce nuit', 60, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 9, 'Capture d’écran 2023-11-13 104509.jpg', '2023-11-21', 2, 1),
(7, 'visite nocturne', 150, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 9, 'voiture.jpg', '2023-11-22', 45, 1),
(8, 'la suite', 75, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 7, '', '2023-11-20', 20, 0),
(9, 'Salon des plantes', 245, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et quas repudiandae sint in exercitationem, quaerat cum ipsa qui quia, dolorum ullam vero voluptatibus ducimus beatae eos perferendis, deleniti quos quibusdam tempore. Tempore, maxime. Saepe quibusdam velit fugit, nostrum praesentium animi quaerat, doloremque illum, cupiditate consequuntur laboriosam quisquam enim ipsum.', 6, '', '2023-11-30', 20, 1),
(10, 'Un jour, une vie', 25, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 3, 'mer.JPG', '2023-11-29', 30, 1),
(11, 'Salon nautique', 15, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 7, 'mer.JPG', '2024-01-06', 10, 1),
(12, 'Salon de l&#039;automobile', 13, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 9, 'voiture.jpg', '2023-11-30', 20, 1),
(13, 'spectacle des lumières', 16, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 6, 'Capture d’écran 2023-11-13 104509.jpg', '2023-11-29', 45, 1),
(14, 'Atelier couture', 10, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi qui neque, ab aspernatur, voluptates nesciunt exercitationem vero magnam repellat architecto explicabo minima soluta, ut enim.', 10, 'mer_3.jpg', '2023-11-30', 15, 1),
(15, 'Test', 10, 'blabla', 10, 'tropic.jpg', '2023-12-23', 50, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_evenement`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
