-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 24 nov. 2020 à 05:08
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zwatcher`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `checkpoint` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contact_user1_idx` (`user_1`),
  KEY `fk_contact_user2_idx` (`user_2`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `user_1`, `user_2`, `type`, `checkpoint`) VALUES
(1, 1, 2, 'ElÃ¨ve', '2020-11-23'),
(2, 2, 1, NULL, ''),
(3, 1, 3, 'Pro', '2020-06-18'),
(6, 5, 1, 'Prof', ''),
(7, 1, 1, 'Moi', '2020-06-20'),
(8, 1, 6, 'ElÃ¨ve', '2020-06-12'),
(11, 1, 5, 'Apprenti', '2020-06-20');

-- --------------------------------------------------------

--
-- Structure de la table `lignes_listes`
--

DROP TABLE IF EXISTS `lignes_listes`;
CREATE TABLE IF NOT EXISTS `lignes_listes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listes_id` int(11) NOT NULL,
  `element` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `listes_id` (`listes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `listes`
--

DROP TABLE IF EXISTS `listes`;
CREATE TABLE IF NOT EXISTS `listes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_liste` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listes`
--

INSERT INTO `listes` (`id`, `titre`, `description`, `date_liste`, `user_id`) VALUES
(4, 'Machine 1', 'Debian 10 - Equipe 1', '2020-06-21', 1),
(5, 'Machine 2', 'Ubuntu - Equipe 1', '2020-06-21', 1),
(6, 'Machine 3', 'Arch Linux - Equipe 2', '2020-06-21', 1),
(7, 'Machine 4', 'Debian - Equipe 2', '2020-06-21', 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `content`, `date`) VALUES
(1, 'Bonjour Ted !', '2020-06-20'),
(2, 'Comment vas-tu ?', '2020-06-20'),
(3, 'Bien merci et toi ?', '2020-06-20'),
(6, 'Demain ?', '2020-06-20'),
(8, 'Le bus est parti ...', '2020-06-20'),
(12, 'D\'accord', '2020-06-20'),
(13, 'Excellent !', '2020-06-21'),
(14, ':D', '2020-07-09'),
(15, 'Bonne journÃ©e', '2020-11-23');

-- --------------------------------------------------------

--
-- Structure de la table `message_user`
--

DROP TABLE IF EXISTS `message_user`;
CREATE TABLE IF NOT EXISTS `message_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_send` int(11) NOT NULL,
  `user_receive` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_message_user_user1_idx` (`user_send`),
  KEY `fk_message_user_user2_idx` (`user_receive`),
  KEY `fk_message_user_message1_idx` (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message_user`
--

INSERT INTO `message_user` (`id`, `user_send`, `user_receive`, `message_id`) VALUES
(1, 1, 2, 1),
(2, 2, 1, 2),
(3, 1, 2, 3),
(6, 1, 2, 6),
(8, 1, 5, 8),
(12, 2, 1, 12),
(13, 1, 2, 13),
(14, 1, 2, 14),
(15, 1, 2, 15);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `displayer` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `image` varchar(200) DEFAULT 'none',
  `graphismes` enum('normal','dark','ocean') NOT NULL DEFAULT 'normal',
  `power` varchar(50) NOT NULL DEFAULT 'utilisateur',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `mail`, `displayer`, `status`, `image`, `graphismes`, `power`) VALUES
(1, 'Larney', '$2y$11$T77fy2r10E4DYxA9dvinGeqXktYJzj1d4GpD1zwR5PlELDupXJzAO', 'larney@gmail.com', 'Configure l\'outil ZWatcher !', 'connecte', 'ProjectExcelsior-1024x1024.jpg', 'normal', 'utilisateur'),
(2, 'Ted', '$2y$11$kK0GHUFPqLVDain7JMbzwODVUFXJ5uxsstQ7KpD1TXJEHOFQ7pNou', 'ted@mosby.com', 'Bonjour, je m\'appelle Ted', 'disconnecte', 'none', 'normal', 'utilisateur'),
(3, 'Marshall', '$2y$11$HlMvRfF91fPa7le.vsKLjuIgJOGlItEOoPzXxPbMykC7chkm4tauO', 'eriksen@gmail.com', 'Actuellement occupÃ©', 'occupe', 'marshall_hat.jpg', 'normal', 'utilisateur'),
(5, 'Arnie', '$2y$11$d4LpNil8UVZPoG2lbY4cuOtZcLumz11lWvfDdW54lganbZNeAxhJi', 'arnie@gmail.com', 'Essaye d\'installer Arch Linux', 'connecte', 'none', 'normal', 'utilisateur'),
(6, 'FrÃ©do', '$2y$11$5hItgYpUg.PvqWuTMFEkgOBtdWhKsHAEtOM9.3sk4E4zb9MzVxZDq', 'fredo@gmail.com', 'Ne fait rien', 'connecte', 'none', 'normal', 'utilisateur');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_contact_user1` FOREIGN KEY (`user_1`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contact_user2` FOREIGN KEY (`user_2`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `lignes_listes`
--
ALTER TABLE `lignes_listes`
  ADD CONSTRAINT `lignes_listes_ibfk_1` FOREIGN KEY (`listes_id`) REFERENCES `listes` (`id`);

--
-- Contraintes pour la table `listes`
--
ALTER TABLE `listes`
  ADD CONSTRAINT `listes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message_user`
--
ALTER TABLE `message_user`
  ADD CONSTRAINT `fk_message_user_message1` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_message_user_user1` FOREIGN KEY (`user_send`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_message_user_user2` FOREIGN KEY (`user_receive`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
