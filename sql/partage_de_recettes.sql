-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 août 2024 à 15:26
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
-- Base de données : `partage_de_recettes`
---- Création de la BDD
CREATE DATABASE IF NOT EXISTS `partage_de_recettes`;
USE `partage_de_recettes`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `review` int(1) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `recipe_id`, `comment`, `created_at`, `review`) VALUES
(1, 3, 9, 'délicieux chausson au pommes ', '2023-08-01 07:15:30', 0),
(2, 2, 9, 'j\'ai adoré le cuisiné, je recommande :)', '2024-07-31 06:20:10', 0),
(6, 1, 8, 'A essayer absolument, la recette est super bonne, on en a fait un avec ma femme le weekend dernier :)', '2024-08-01 08:10:10', 0),
(7, 1, 8, 'hum', '2024-07-17 20:30:18', 0),
(8, 1, 8, 'Cette recette est un régale !', '2024-06-25 07:59:13', 0),
(9, 5, 8, 'ce commentaire et un test', '2024-08-01 11:07:24', 3);

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `recipe` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `title`, `recipe`, `author`, `is_enabled`) VALUES
(2, 'Couscous', 'Le couscous est d\'une part une semoule de blé dur préparée à l\'huile d\'olive (un des aliments de base traditionnel de la cuisine des pays du Maghreb) et d\'autre part, une spécialité culinaire issue de la cuisine berbère, à base de couscous, de légumes, d\'épices, d\'huile d\'olive et de viande (rouge ou de volaille) ou de poisson.', 'mickael.andrieu@exemple.com', 0),
(4, 'Salade Romaine', 'La salade César est une recette de cuisine de salade composée de la cuisine américaine, traditionnellement préparée en salle à côté de la table, à base de laitue romaine, œuf dur, croûtons, parmesan et de « sauce César » à base de parmesan râpé, huile d\'olive, pâte d\'anchois, ail, vinaigre de vin, moutarde, jaune d\'œuf et sauce Worcestershire.', 'laurene.castor@exemple.com', 0),
(8, 'pâté croutte', 'Étape 1\r\nA préparer la veille !\r\n\r\nÉtape 2\r\nFaire la pâte : mettre farine et beurre en morceaux dans un saladier, sabler. Ajouter une pincée de sel, l\'eau pour obtenir une boule de pâte, à laisser reposer une demi-heure\r\n\r\nÉtape 3\r\nPréchauffer le four à 240°C.\r\n\r\nÉtape 4\r\nPendant ce temps, préparer la farce : hacher les viandes, les mélanger à la chair à saucisse. Ajouter l\'oeuf, l\'armagnac, la muscade, le sel et le poivre.\r\n\r\nÉtape 5\r\nBien mélanger.\r\n\r\nÉtape 6\r\nEtaler la pâte sur un papier sulfurisé en lui donnant une forme ovale. Déposer la farce sur une moitié dans la longueur. Replier la pâte pour former un chausson.\r\n\r\nÉtape 7\r\nBien souder les bords en les humidifiant.\r\n\r\nÉtape 8\r\nFaire un petit trou sur le dessus et y glisser une petite cheminée faite en papier d\'alu.\r\n\r\nÉtape 9\r\nDorer à l\'oeuf\r\n\r\nÉtape 10\r\nGlisser le pâté avec le papier sulfurisé sur une plaque du four\r\n\r\nÉtape 11\r\nFaire cuire 45 min à 240°C puis 45 min à 220°C.\r\n\r\nÉtape 12\r\nLaisser refroidir complètement\r\n\r\nÉtape 13\r\nPréparer la gelée selon les indications du paquet et une fois froide, la verser par le trou de la cheminée.\r\n\r\nÉtape 14\r\nA laisser au réfrigérateur une nuit.\r\n\r\nÉtape 15\r\nBonne dégustation !', 'laurene.castor@exemple.com', 1),
(9, 'chausson aux pomme', 'Découpez la pâte feuilletée en 4 disques à l\'aide d\'un emporte pièce.\r\nVersez 3 cuillères à soupe de compote de pommes au centre de chacun de ces disques de pâte feuilletée.\r\nRefermez les chaussons en deux et appuyez bien sur les bords pour qu\'ils ne s\'ouvrent pas.\r\nBadigeonnez les chaussons d\'un peu de jaune d\'oeuf (c\'est ce qui fait dorer et croustiller la pâte).\r\nEnfournez 25 minutes th 6/7 (200°).', 'mickael.andrieu@exemple.com', 1),
(10, 'salade de fruit', '1. Epluchez les pommes et les poires. Epépinez-les et coupez-les en morceaux.\r\n2. Coupez les kiwis en deux et retirez en la chair.\r\n3. Epluchez les oranges et coupez-les en quartiers. Epluchez la banane et coupez-la en rondelles.\r\n4. Lavez le raisin blanc. Versez tous les fruits dans un saladier.\r\n5. Ajoutez le sucre, le jus d\'orange et le jus de citron. Réservez au frais au moins une heure avant de servir.', 'mickael.andrieu@exemple.com', 1),
(11, 'poulet au champignon', 'Étape 1\r\n\r\nCouper les cuisses de poulet en 2.\r\n\r\nÉtape 2\r\n\r\nLes faire revenir dans l\'huile pendant 20 min puis ajouter l\'oignon émincé, l\'ail écrasé, une bonne pincée de persil frais et une cuillère à soupe de fond de sauce volaille.\r\n\r\nÉtape 3\r\n\r\nMélanger le tout et faire revenir jusqu\'à ce que les oignons soient translucides.\r\n\r\nÉtape 4\r\n\r\nAjouter la boîte de champignons avec le jus (très important) et la deuxième cuillère à soupe de fond de volaille et laisser cuire a couvert avec environ 50 cl d\'eau pendant 10 min.\r\n\r\nÉtape 5\r\n\r\nA part, mélanger la crème et la farine.\r\n\r\nÉtape 6\r\nVerser dans la marmite avec vos ingrédients.\r\n\r\nÉtape 7\r\nLaisser mijoter environ 15 min, le temps que la sauce devienne bien onctueuse.', 'mickael.andrieu@exemple.com', 1),
(12, 'Yakitori au jambon cru et au fromage à raclette', 'Étape 1\r\nMélanger la sauce soja, le miel et le mirin pour obtenir une marinade.\r\n\r\nÉtape 2\r\nDéposer les tranches de jambon et les laisser mariner 20 min.\r\n\r\nÉtape 3\r\nCouper le fromage à raclette en bâtonnet d’environ 5 cm de long sur 1 cm d’épaisseur.\r\n\r\nÉtape 4\r\nEmbrocher le fromage dans la longueur sur la brochette. Enrouler le jambon cru autour.\r\n\r\nÉtape 5\r\nFaire cuire les brochettes de chaque côté dans une poêle bien chaude jusqu\'à ce que le fromage soit fondu.\r\n\r\nÉtape 6\r\nVerser le reste de la sauce et saupoudrer de quelques graines de sésame.', 'johan.Anas18@free.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(128) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `age`) VALUES
(1, 'Mickaël Andrieu', 'mickael.andrieu@exemple.com', 'devine', 34),
(2, 'Mathieu Nebra', 'mathieu.nebra@exemple.com', 'MiamMiam', 34),
(3, 'Laurène Castor', 'laurene.castor@exemple.com', 'laCasto28', 28),
(4, 'Rémi Deschamps', 'remideschamps2662@gmail.com', 'jojo', 30),
(5, 'Johan Anas', 'johan.Anas18@free.fr', 'Jojo18', 26);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `IDX_5F9E962A9D86650F` (`user_id`),
  ADD KEY `IDX_5F9E962A69574A48` (`recipe_id`);

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A69574A48` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5F9E962A9D86650F` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
