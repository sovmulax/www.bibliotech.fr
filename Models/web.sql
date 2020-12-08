-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 04 déc. 2020 à 11:45
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `web`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `nom`) VALUES
(1, 'Victor Hugo'),
(2, 'Amadou Hampâté Bâ'),
(3, 'Bernard Dadier');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Roman'),
(2, 'Poésie'),
(3, 'Bande dessinée'),
(4, 'Oeuvre Théatrale');

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

DROP TABLE IF EXISTS `editeur`;
CREATE TABLE IF NOT EXISTS `editeur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `editeur`
--

INSERT INTO `editeur` (`id`, `nom`) VALUES
(50, 'Albert Lacroix'),
(51, 'Rabet le fanneur'),
(52, 'Bien-Aimé du piossage'),
(53, 'Rabet le fanneur'),
(54, 'Tonton Divine'),
(55, 'Yann de la fontaine'),
(56, 'Tonton Divine'),
(57, 'Zantoine'),
(58, 'yeboué Posseur'),
(59, 'Marion duBeaux'),
(60, 'Tonton Divine'),
(61, 'Tonton Divine'),
(62, 'Albert Lacroix'),
(63, 'Tonton Divine'),
(64, 'Rabet le fanneur'),
(65, 'Bien-Aimé du piossage'),
(66, 'Marion duBeaux'),
(67, 'Yann de la fontaine'),
(68, 'Zantoine'),
(69, 'yeboué Posseur'),
(70, 'Marion duBeaux'),
(71, 'Rabet le fanneur'),
(72, 'Marion duBeaux'),
(73, 'Marion duBeaux'),
(74, 'Albert Lacroix'),
(75, 'Rabet le fanneur'),
(76, 'Albert Lacroix'),
(77, 'Rabet le fanneur'),
(78, 'Tonton Divine'),
(79, 'Marion duBeaux'),
(80, 'Marion duBeaux'),
(81, 'Rabet le fanneur'),
(82, 'Bien-Aimé du piossage'),
(83, 'Tonton Divine'),
(84, 'yeboué Posseur'),
(85, 'Tonton Divine'),
(86, 'Rabet le fanneur'),
(87, 'Marion duBeaux'),
(88, 'Rabet le fanneur'),
(89, 'Tonton Divine'),
(90, 'Tonton Divine'),
(91, 'Tonton Divine'),
(92, 'Rabet le fanneur'),
(93, 'Albert Lacroix'),
(94, 'Tonton Divine'),
(95, 'Marion duBeaux'),
(96, 'Albert Lacroix'),
(97, 'Bien-Aimé du piossage'),
(98, 'Albert Lacroix'),
(99, 'Marion duBeaux'),
(100, 'Rabet le fanneur'),
(101, 'Rabet le fanneur'),
(102, 'yeboué Posseur'),
(103, 'Zantoine');

-- --------------------------------------------------------

--
-- Structure de la table `emprunter`
--

DROP TABLE IF EXISTS `emprunter`;
CREATE TABLE IF NOT EXISTS `emprunter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exemplaire_id` int NOT NULL,
  `users_id` int NOT NULL,
  `emprunt_date` date NOT NULL,
  `date_retour` date NOT NULL,
  `en_cour` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_emprunt` (`users_id`),
  KEY `INDEX` (`exemplaire_id`,`users_id`) USING BTREE,
  KEY `fk_exemplaire_emprunt` (`exemplaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `emprunter`
--

INSERT INTO `emprunter` (`id`, `exemplaire_id`, `users_id`, `emprunt_date`, `date_retour`, `en_cour`) VALUES
(18, 226, 11, '2020-12-04', '2020-12-11', 1),
(19, 240, 12, '2020-12-04', '2020-12-11', 1),
(20, 244, 11, '2020-12-04', '2020-12-11', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `nom`) VALUES
(1, 'Bonne Etat'),
(2, 'Endommager'),
(3, 'Irrécupérable');

-- --------------------------------------------------------

--
-- Structure de la table `exemplaires`
--

DROP TABLE IF EXISTS `exemplaires`;
CREATE TABLE IF NOT EXISTS `exemplaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `auteur_exem_id` int NOT NULL,
  `oeuvre_exem_id` int NOT NULL,
  `types_exem_id` int NOT NULL,
  `categorie_exem_id` int NOT NULL,
  `editeur_id` int NOT NULL,
  `etat_id` int NOT NULL,
  `emprunter` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exem_auteur` (`auteur_exem_id`),
  KEY `fk_exem_type` (`types_exem_id`),
  KEY `fk_exem_categorie` (`categorie_exem_id`),
  KEY `fk_etat` (`etat_id`),
  KEY `fk_exem_editeur` (`editeur_id`),
  KEY `fk_exem_oeuvre` (`oeuvre_exem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `exemplaires`
--

INSERT INTO `exemplaires` (`id`, `auteur_exem_id`, `oeuvre_exem_id`, `types_exem_id`, `categorie_exem_id`, `editeur_id`, `etat_id`, `emprunter`) VALUES
(226, 1, 4, 14, 1, 96, 1, 1),
(227, 1, 4, 14, 1, 96, 1, 0),
(228, 1, 4, 14, 1, 96, 1, 0),
(229, 1, 4, 14, 1, 96, 1, 0),
(230, 1, 5, 14, 1, 97, 1, 0),
(231, 1, 5, 14, 1, 97, 1, 0),
(232, 1, 5, 14, 1, 97, 1, 0),
(233, 1, 5, 14, 1, 97, 1, 0),
(234, 1, 5, 14, 1, 97, 1, 0),
(240, 2, 19, 9, 1, 99, 1, 1),
(241, 2, 19, 9, 1, 99, 1, 0),
(242, 2, 19, 9, 1, 99, 1, 0),
(243, 2, 19, 9, 1, 99, 1, 0),
(244, 1, 25, 14, 1, 100, 1, 1),
(245, 1, 25, 14, 1, 100, 1, 0),
(246, 1, 25, 14, 1, 100, 1, 0),
(247, 1, 25, 14, 1, 100, 1, 0),
(248, 1, 25, 14, 1, 100, 1, 0),
(249, 1, 25, 14, 1, 100, 1, 0),
(250, 1, 25, 14, 1, 100, 1, 0),
(251, 1, 25, 14, 1, 100, 1, 0),
(252, 2, 26, 13, 1, 101, 1, 0),
(253, 2, 26, 13, 1, 101, 1, 0),
(254, 2, 26, 13, 1, 101, 1, 0),
(255, 2, 26, 13, 1, 101, 1, 0),
(256, 2, 27, 9, 1, 102, 1, 0),
(257, 2, 27, 9, 1, 102, 1, 0),
(258, 2, 27, 9, 1, 102, 1, 0),
(259, 2, 27, 9, 1, 102, 1, 0),
(260, 3, 28, 13, 1, 103, 1, 0),
(261, 3, 28, 13, 1, 103, 1, 0),
(262, 3, 28, 13, 1, 103, 1, 0),
(263, 3, 28, 13, 1, 103, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `gestionnaire`
--

DROP TABLE IF EXISTS `gestionnaire`;
CREATE TABLE IF NOT EXISTS `gestionnaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `born_date` date NOT NULL,
  `contact` int NOT NULL,
  `extension` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `gestionnaire`
--

INSERT INTO `gestionnaire` (`id`, `nom`, `prenom`, `email`, `pass`, `born_date`, `contact`, `extension`, `actif`) VALUES
(1, 'evane', 'geoffroy', 'evane@google.fr', '$2y$10$UyQbA/BDYemtiZBq3qK/2OXFRotdwP6tGYLpp.rLa1T.kazrSxw/S', '2020-10-27', 45454545, 'jpg', 1),
(2, 'boni', 'acobe ange', 'boniangeulrich@gmail.com', '$2y$10$PWSr15PZZLsIgjOPsqv1heaGNFaD/E055mwSLq1u7sPZ0iHR71znq', '1999-01-01', 89167920, 'jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `oeuvre_id` int NOT NULL,
  `auteur_id` int NOT NULL,
  `types_id` int NOT NULL,
  `categorie_id` int NOT NULL,
  `photo_id` int NOT NULL,
  `resumes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_type` (`types_id`),
  KEY `fk_categorie` (`categorie_id`),
  KEY `fk_photo` (`photo_id`) USING BTREE,
  KEY `fk_auteur` (`auteur_id`) USING BTREE,
  KEY `fk_oeuvre` (`oeuvre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `oeuvre_id`, `auteur_id`, `types_id`, `categorie_id`, `photo_id`, `resumes`) VALUES
(33, 4, 1, 14, 1, 33, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. \r\nAtque doloremque tenetur porro vero ut libero dolorum, \r\nmodi provident ducimus! Cupiditate excepturi nobis delectus, \r\nat laudantium repellendus fuga maxime ipsam! Amet.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. \r\nRatione nam, aut dicta sequi modi velit iure, ut repudiandae, a\r\nquibusdam et minus possimus temporibus ea ullam repellendus quaerat debitis obcaecati?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorem, atque? Odio nemo \r\nodit laudantium ad tempore. Dolorum quas deleniti recusandae, quae \r\nofficiis excepturi ratione repudiandae sequi, error veritatis officia provident.'),
(34, 5, 1, 14, 1, 34, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. \r\nAtque doloremque tenetur porro vero ut libero dolorum, \r\nmodi provident ducimus! Cupiditate excepturi nobis delectus, \r\nat laudantium repellendus fuga maxime ipsam! Amet.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. \r\nRatione nam, aut dicta sequi modi velit iure, ut repudiandae, a\r\nquibusdam et minus possimus temporibus ea ullam repellendus quaerat debitis obcaecati?\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorem, atque? Odio nemo \r\nodit laudantium ad tempore. Dolorum quas deleniti recusandae, quae \r\nofficiis excepturi ratione repudiandae sequi, error veritatis officia provident.'),
(57, 25, 1, 14, 1, 63, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate iste deserunt illum assumenda, ipsa dolorem tenetur labore rerum fugit ex deleniti, repellendus nihil sunt reiciendis eius saepe fuga dolor accusamus?'),
(58, 19, 2, 9, 1, 64, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate iste deserunt illum assumenda, ipsa dolorem tenetur labore rerum fugit ex deleniti, repellendus nihil sunt reiciendis eius saepe fuga dolor accusamus?'),
(59, 26, 2, 13, 1, 65, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus totam libero quas maiores et corporis tempora aliquam sint earum voluptate molestiae odit unde magni hic ipsam fugiat blanditiis, quos tempore?'),
(60, 27, 2, 9, 1, 66, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus totam libero quas maiores et corporis tempora aliquam sint earum voluptate molestiae odit unde magni hic ipsam fugiat blanditiis, quos tempore?Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus totam libero quas maiores et corporis tempora aliquam sint earum voluptate molestiae odit unde magni hic ipsam fugiat blanditiis, quos tempore?'),
(61, 28, 3, 13, 1, 67, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus totam libero quas maiores et corporis tempora aliquam sint earum voluptate molestiae odit unde magni hic ipsam fugiat blanditiis, quos tempore?Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus totam libero quas maiores et corporis tempora aliquam sint earum voluptate molestiae odit unde magni hic ipsam fugiat blanditiis, quos tempore?Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus totam libero quas maiores et corporis tempora aliquam sint earum voluptate molestiae odit unde magni hic ipsam fugiat blanditiis, quos tempore?Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus totam libero quas maiores et corporis tempora aliquam sint earum voluptate molestiae odit unde magni hic ipsam fugiat blanditiis, quos tempore?');

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `messages` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `mail`
--

INSERT INTO `mail` (`id`, `email`, `messages`) VALUES
(1, 'emm@google.fr', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi itaque ea cumque tempora enim, repudiandae quidem odit, sit autem esse rerum assumenda in hic fugiat nesciunt aperiam. Quaerat, porro'),
(2, 'junior@gmail.fr', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi itaque ea cumque tempora enim, repudiandae quidem odit, sit autem esse rerum assumenda in hic fugiat nesciunt aperiam. Quaerat, porro\r\n'),
(3, 'evanegeo@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi itaque ea cumque tempora enim, repudiandae quidem odit, sit autem esse rerum assumenda in hic fugiat nesciunt aperiam. Quaerat, porro');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre`
--

DROP TABLE IF EXISTS `oeuvre`;
CREATE TABLE IF NOT EXISTS `oeuvre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auteur_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_auteur_oeuvre` (`auteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `oeuvre`
--

INSERT INTO `oeuvre` (`id`, `nom`, `auteur_id`) VALUES
(4, 'Les Misérables', 1),
(5, 'Notre-Dame de Paris', 1),
(19, 'The fortunes of Wangrin', 2),
(25, 'Kaidara', 1),
(26, 'Amkoullel, l\'enfant Peul: mémoires', 2),
(27, 'Petit Bodiel', 2),
(28, 'climbié', 3);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `nom`) VALUES
(33, 'image5fbab35f9f420.jpg'),
(34, 'image5fbab98dad4b7.jpg'),
(63, 'image5fc9c495f3a4b.jpg'),
(64, 'image5fc9c4c8542c8.jpg'),
(65, 'image5fc9c53bae0ca.jpg'),
(66, 'image5fc9c5c1aa8dd.jpg'),
(67, 'image5fc9c71782954.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `structure`
--

DROP TABLE IF EXISTS `structure`;
CREATE TABLE IF NOT EXISTS `structure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `structure`
--

INSERT INTO `structure` (`id`, `nom`) VALUES
(1, 'ESATIC (Ecole Supérieur Africaine des TIC)'),
(2, 'Université Public'),
(3, 'Université Privé'),
(4, 'Entreprise Public'),
(5, 'Entreperise Privé'),
(6, 'Ecole du secondaire'),
(7, 'Ecole primaire'),
(8, 'Aucune Structure');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `nom`) VALUES
(1, 'Mythe et légende'),
(2, 'Aventures'),
(3, 'Horreur'),
(4, 'Fantastique'),
(5, 'Romantique'),
(6, 'Humour'),
(7, 'Science-fiction'),
(8, 'Historique'),
(9, 'Fantaisie'),
(10, 'Philosophique'),
(11, 'Policier'),
(12, 'Sociologique'),
(13, 'Biographie'),
(14, 'Fiction'),
(15, 'Drama');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `born_date` date NOT NULL,
  `contact` int NOT NULL,
  `extension` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_structure` int NOT NULL,
  `matricule` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_structure_user` (`user_structure`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `born_date`, `contact`, `extension`, `user_structure`, `matricule`, `actif`) VALUES
(11, 'noel', 'junior', 'junior@gmail.fr', '1999-02-01', 45484245, 'jpg', 2, '20NJJ35455', 1),
(12, 'boni', 'ange', 'boniangeulrich@gmail.com', '1999-01-02', 45484245, 'jpg', 7, '20BAB63741', 1),
(13, 'diane', 'coul', 'coul@google.fr', '1555-12-02', 45484548, 'jpg', 4, '20DCC43790', 0),
(14, 'emmanuel', 'ehouman', 'emm@google.fr', '2001-12-02', 45484245, 'jpg', 4, '20EEE62747', 1),
(15, 'coac', 'atignon', 'coach@gmail.fr', '1988-12-02', 454845454, 'jpg', 8, '20CAC26041', 0),
(16, 'tre', 'arsen', 'trea@ggogle.fr', '1525-01-26', 2147483647, 'jpg', 6, '20TAT51724', 1),
(17, 'yeo', 'yeo', 'evanegeo@gmail.com', '2001-12-02', 45454245, 'jpg', 4, '20YYE7875', 1),
(18, 'wiliam', 'koffi', 'kouasiarsene11@gmail.com', '2001-12-02', 454847544, 'jpg', 2, '20WKK38937', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunter`
--
ALTER TABLE `emprunter`
  ADD CONSTRAINT `fk_exemplaire_emprunt` FOREIGN KEY (`exemplaire_id`) REFERENCES `exemplaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_emprunt` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exemplaires`
--
ALTER TABLE `exemplaires`
  ADD CONSTRAINT `fk_etat` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exem_editeur` FOREIGN KEY (`editeur_id`) REFERENCES `editeur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `fk_auteur` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_photo` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  ADD CONSTRAINT `fk_auteur_oeuvre` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_structure_user` FOREIGN KEY (`user_structure`) REFERENCES `structure` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
