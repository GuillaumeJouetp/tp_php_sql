-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 24 mai 2018 à 22:49
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
-- Base de données :  `isep_tp_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `subjects`
--

INSERT INTO `subjects` (`id`, `content`, `date`, `user_id`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit nisl et massa bibendum.', '2018-04-16', 11),
(2, 'Curabitur mattis metus eget lacus consequat mollis. Nulla mattis neque quam, eu dictum.', '2018-04-16', 12),
(3, 'Sed ullamcorper diam et lectus pulvinar lobortis. Vivamus interdum velit a libero posuere. ', '2018-04-17', 13),
(4, 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis', '2018-04-18', 14);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `pass`) VALUES
(10, 'Guillaume', 'guillaume.jouet-pastre@isep.fr', '$2y$10$CVkabNdJxSpMOBsge3hfO.gCeSzAszsplMCguUQG4bV/tR2EAvEgq'),
(11, 'Sangoku', 'sangoku@planetvegeta.com', '$2y$10$HfIy0JNPkwmEvru7HmW.huUqUKkqvkQ2asJKFlXPQP40yDoCQODlq'),
(12, 'Sangohan', 'sangohan@terre.com', '$2y$10$zmFUEQrAz.EENhoZIEemHenN7nj.fBLyM1y1Jc11fo5S/Wrz2S0A.'),
(13, 'Krillin', 'krillin@terre.com', '$2y$10$JiolrNKm1DzMrVSEWfMH9OLoAgU/vR4NulaohbEjgYKKW6X3zWNbG'),
(14, 'Freezer', 'freezer@namek.com', '$2y$10$NKpQg38SIhiMXQLc7Q9nROEXsXhALNSqH4AudCqo0Q43RXksIKwT.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
