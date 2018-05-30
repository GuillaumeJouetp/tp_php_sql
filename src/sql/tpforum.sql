-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 30 mai 2018 à 14:40
-- Version du serveur :  5.7.19
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
-- Base de données :  `tpforum`
--

-- --------------------------------------------------------

--
-- Structure de la table `responses`
--

DROP TABLE IF EXISTS `responses`;
CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `responses`
--

INSERT INTO `responses` (`id`, `content`, `dateTime`, `subject_id`, `user_id`) VALUES
(14, 'Tu ne perds rien pour attendre !', '2018-05-17 23:37:16', 4, 14),
(13, 'Je vais te détruire !', '2018-05-23 10:33:16', 2, 14),
(12, 'On s\'entraîne quand tu veux !', '2018-05-10 18:12:16', 2, 11),
(11, 'Tu rêves mon pote.', '2018-05-03 10:36:16', 4, 11),
(15, 'J\'en ai une en ma possession haha !!', '2018-05-08 05:31:36', 1, 14),
(17, 'Up', '2018-05-15 11:18:16', 3, 13),
(37, 'Up :\'(', '2018-05-30 15:21:09', 3, 13);

-- --------------------------------------------------------

--
-- Structure de la table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'Autre',
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `subjects`
--

INSERT INTO `subjects` (`id`, `content`, `category`, `dateTime`, `user_id`) VALUES
(1, 'Je suis a la recherche des 7 boules de cristal. Si vous en avez vu une faite moi signe dans les commentaires. ', 'Voyage', '2018-05-01 15:35:09', 11),
(2, 'Qui veut me combattre ?!', 'Combat', '2018-05-02 00:39:09', 12),
(3, 'J\'aimerais savoir si quelqu\'un connait une technique infaillible qui me permettrait de grandir ? Merci', 'Autre', '2018-05-03 10:39:09', 13),
(4, 'Une idée de comment je pourrais détruire Sangoku ?', 'Combat', '2018-05-01 14:13:09', 14);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `mail`, `pass`) VALUES
(10, 'Guillaume', 'Jouet-pastré', 'guillaume.jouet-pastre@isep.fr', '$2y$10$CVkabNdJxSpMOBsge3hfO.gCeSzAszsplMCguUQG4bV/tR2EAvEgq'),
(11, 'Sangoku', 'Hatake', 'sangoku@planetvegeta.com', '$2y$10$HfIy0JNPkwmEvru7HmW.huUqUKkqvkQ2asJKFlXPQP40yDoCQODlq'),
(12, 'Sangohan', 'Miroshi', 'sangohan@terre.com', '$2y$10$zmFUEQrAz.EENhoZIEemHenN7nj.fBLyM1y1Jc11fo5S/Wrz2S0A.'),
(13, 'Krillin', 'Dbz', 'krillin@terre.com', '$2y$10$JiolrNKm1DzMrVSEWfMH9OLoAgU/vR4NulaohbEjgYKKW6X3zWNbG'),
(14, 'Freezer', 'Oda', 'freezer@namek.com', '$2y$10$NKpQg38SIhiMXQLc7Q9nROEXsXhALNSqH4AudCqo0Q43RXksIKwT.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
