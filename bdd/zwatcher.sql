-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 31 déc. 2020 à 05:11
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
-- Structure de la table `applis`
--

DROP TABLE IF EXISTS `applis`;
CREATE TABLE IF NOT EXISTS `applis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_appli` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `applis`
--

INSERT INTO `applis` (`id`, `nom_appli`) VALUES
(1, 'vim');

-- --------------------------------------------------------

--
-- Structure de la table `app_machine`
--

DROP TABLE IF EXISTS `app_machine`;
CREATE TABLE IF NOT EXISTS `app_machine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_machine` int(11) NOT NULL,
  `id_appli` int(11) NOT NULL,
  `status_dispo` enum('0','1') NOT NULL DEFAULT '0',
  `status_install` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_machine` (`id_machine`),
  KEY `id_appli` (`id_appli`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `app_machine`
--

INSERT INTO `app_machine` (`id`, `id_machine`, `id_appli`, `status_dispo`, `status_install`) VALUES
(1, 4, 1, '0', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `user_1`, `user_2`, `type`, `checkpoint`) VALUES
(1, 1, 2, 'ElÃ¨ve', '2020-12-17'),
(2, 2, 1, NULL, ''),
(3, 1, 3, 'Pro', '2020-06-18'),
(6, 5, 1, 'Prof', '2020-12-31'),
(7, 1, 1, 'Moi', '2020-06-20'),
(8, 1, 6, 'ElÃ¨ve', '2020-06-12'),
(11, 1, 5, 'Apprenti', '2020-12-31'),
(13, 9, 1, 'Admin', '2020-12-31'),
(14, 1, 9, 'Nouveau', '2020-12-31');

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `id_listes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_listes` (`id_listes`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id`, `name`, `id_listes`) VALUES
(19, 'Crousti', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipes_bl`
--

DROP TABLE IF EXISTS `equipes_bl`;
CREATE TABLE IF NOT EXISTS `equipes_bl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_eleve` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_eleve` (`id_eleve`),
  KEY `id_equipe` (`id_equipe`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipes_bl`
--

INSERT INTO `equipes_bl` (`id`, `id_eleve`, `id_equipe`) VALUES
(15, 2, 19),
(16, 3, 19);

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
  `ip` varchar(40) NOT NULL,
  `mac` varchar(40) NOT NULL,
  `port` int(10) NOT NULL,
  `id_machine` varchar(40) NOT NULL,
  `pwd_machine` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listes`
--

INSERT INTO `listes` (`id`, `titre`, `description`, `date_liste`, `ip`, `mac`, `port`, `id_machine`, `pwd_machine`) VALUES
(4, 'Machine1 - Test', 'Debian 10 - Equipe 1', '2020-06-21', '82.64.225.10', '100.0.00.00', 2020, 'barney', 'stinson'),
(5, 'Machine 2', 'Ubuntu - Equipe 1', '2020-06-21', '', '', 0, '', ''),
(6, 'Machine 3', 'Arch Linux - Equipe 2', '2020-06-21', '', '', 0, '', ''),
(7, 'Machine 4', 'Debian - Equipe 2', '2020-06-21', '', '', 0, '', ''),
(8, 'Machine 5', 'Linux - Equipe 3', '2020-11-30', '', '', 0, '', ''),
(9, 'Machine 6', 'Debian 9 - Equipe 4', '2020-11-30', '', '', 0, '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

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
(16, 'Dur n\'est ce pas ?', '2020-11-28'),
(17, 'Bonne journÃ©e', '2020-12-17'),
(25, 'Yo man', '2020-12-18'),
(26, 're', '2020-12-18'),
(27, 'Salut', '2020-12-31'),
(28, 'Il est au musÃ©e !', '2020-12-31');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

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
(16, 1, 5, 16),
(17, 1, 2, 17),
(25, 9, 1, 25),
(26, 9, 1, 26),
(27, 1, 9, 27),
(28, 1, 5, 28);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `code` varchar(128) DEFAULT NULL,
  `exp_date` datetime DEFAULT NULL,
  `mail` varchar(100) NOT NULL,
  `displayer` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `image` varchar(200) DEFAULT 'none',
  `graphismes` enum('normal','dark','ocean') NOT NULL DEFAULT 'normal',
  `power` enum('utilisateur','admin') NOT NULL DEFAULT 'utilisateur',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `code`, `exp_date`, `mail`, `displayer`, `status`, `image`, `graphismes`, `power`) VALUES
(1, 'Larney', '$2y$11$AWdm7.KQp/53yM8eWGmsDOOo9EFDhTnfj.OMAc8OJrZ/niHr8MZj.', '$2y$11$2.JVjhsZNnwDaTo30c1boObAB.hU42V5ovb/PeJwMpWxVxCyqYd2K', '2021-01-01 01:42:09', 'thomasparis56@gmail.com', 'Travaille les accentuÃ©s', 'connecte', 'ProjectExcelsior-1024x1024.jpg', 'normal', 'admin'),
(2, 'Ted', '$2y$11$kK0GHUFPqLVDain7JMbzwODVUFXJ5uxsstQ7KpD1TXJEHOFQ7pNou', '', NULL, 'ted@mosby.com', 'Bonjour, je m\'appelle Ted', 'disconnecte', 'none', 'normal', 'utilisateur'),
(3, 'Marshall', '$2y$11$HlMvRfF91fPa7le.vsKLjuIgJOGlItEOoPzXxPbMykC7chkm4tauO', '', NULL, 'eriksen@gmail.com', 'N\'est pas disponible', 'disconnecte', 'marshall_hat.jpg', 'normal', 'utilisateur'),
(5, 'Arnie', '$2y$11$d4LpNil8UVZPoG2lbY4cuOtZcLumz11lWvfDdW54lganbZNeAxhJi', '', NULL, 'arnie@gmail.com', 'Essaye d\'installer Arch Linux', 'connecte', 'none', 'normal', 'utilisateur'),
(6, 'Jack Package', '$2y$11$5hItgYpUg.PvqWuTMFEkgOBtdWhKsHAEtOM9.3sk4E4zb9MzVxZDq', '', NULL, 'fredo@gmail.com', 'Ne fait rien', 'connecte', 'none', 'normal', 'utilisateur'),
(9, 'TheCommodore', '$2y$11$3GwbIK1n6OAV8aMUHcQzsuY.9hMIivVZ5Xj4HwBQaEAv4TCwoS2ym', '', NULL, 'the@commodore', NULL, 'connecte', 'none', 'dark', 'utilisateur');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `app_machine`
--
ALTER TABLE `app_machine`
  ADD CONSTRAINT `id_appli_link` FOREIGN KEY (`id_appli`) REFERENCES `applis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_machine_link` FOREIGN KEY (`id_machine`) REFERENCES `listes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_contact_user1` FOREIGN KEY (`user_1`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contact_user2` FOREIGN KEY (`user_2`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `id_listes` FOREIGN KEY (`id_listes`) REFERENCES `listes` (`id`);

--
-- Contraintes pour la table `equipes_bl`
--
ALTER TABLE `equipes_bl`
  ADD CONSTRAINT `id_eleve` FOREIGN KEY (`id_eleve`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `id_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id`);

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
