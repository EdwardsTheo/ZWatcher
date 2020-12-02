-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 02 déc. 2020 à 19:20
-- Version du serveur :  10.3.25-MariaDB-0+deb10u1
-- Version de PHP : 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ZWatcher`
--

-- --------------------------------------------------------

--
-- Structure de la table `applis`
--

CREATE TABLE `applis` (
  `id` int(11) NOT NULL,
  `nom_appli` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `applis`
--

INSERT INTO `applis` (`id`, `nom_appli`) VALUES
(1, 'vim');

-- --------------------------------------------------------

--
-- Structure de la table `app_machine`
--

CREATE TABLE `app_machine` (
  `id` int(11) NOT NULL,
  `id_machine` int(11) NOT NULL,
  `id_appli` int(11) NOT NULL,
  `status_dispo` enum('0','1') NOT NULL DEFAULT '0',
  `status_install` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `app_machine`
--

INSERT INTO `app_machine` (`id`, `id_machine`, `id_appli`, `status_dispo`, `status_install`) VALUES
(1, 4, 1, '0', '0');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `checkpoint` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `user_1`, `user_2`, `type`, `checkpoint`) VALUES
(1, 1, 2, 'Eléve', '2020-11-23'),
(2, 2, 1, NULL, ''),
(3, 1, 3, 'Pro', '2020-06-18'),
(6, 5, 1, 'Prof', ''),
(7, 1, 1, 'Moi', '2020-06-20'),
(8, 1, 6, 'Eléve', '2020-06-12'),
(11, 1, 5, 'Apprenti', '2020-11-28');

-- --------------------------------------------------------

--
-- Structure de la table `listes`
--

CREATE TABLE `listes` (
  `id` int(11) NOT NULL,
  `titre` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_liste` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_admin` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `port` int(10) NOT NULL,
  `id_machine` varchar(40) NOT NULL,
  `pwd_machine` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listes`
--

INSERT INTO `listes` (`id`, `titre`, `description`, `date_liste`, `user_id`, `user_admin`, `ip`, `port`, `id_machine`, `pwd_machine`) VALUES
(4, 'Machine 1 - Test', 'Debian 10 - Equipe 1', '2020-06-21', 1, 1, '82.64.225.10', 2020, 'barney', 'stinson'),
(5, 'Machine 2', 'Ubuntu - Equipe 1', '2020-06-21', 1, 1, '', 0, '', ''),
(6, 'Machine 3', 'Arch Linux - Equipe 2', '2020-06-21', 1, 1, '', 0, '', ''),
(7, 'Machine 4', 'Debian - Equipe 2', '2020-06-21', 1, 1, '', 0, '', ''),
(8, 'Machine 5', 'Linux - Equipe 3', '2020-11-30', 1, 1, '', 0, '', ''),
(9, 'Machine 6', 'Debian 9 - Equipe 4', '2020-11-30', 1, 1, '', 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(15, 'Bonne journée', '2020-11-23'),
(16, 'Dur n\'est ce pas ?', '2020-11-28');

-- --------------------------------------------------------

--
-- Structure de la table `message_user`
--

CREATE TABLE `message_user` (
  `id` int(11) NOT NULL,
  `user_send` int(11) NOT NULL,
  `user_receive` int(11) NOT NULL,
  `message_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(15, 1, 2, 15),
(16, 1, 5, 16);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `displayer` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `image` varchar(200) DEFAULT 'none',
  `graphismes` enum('normal','dark','ocean') NOT NULL DEFAULT 'normal',
  `power` varchar(50) NOT NULL DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `mail`, `displayer`, `status`, `image`, `graphismes`, `power`) VALUES
(1, 'Larney', '$2y$11$T77fy2r10E4DYxA9dvinGeqXktYJzj1d4GpD1zwR5PlELDupXJzAO', 'larney@gmail.com', 'Présente l\'itération 2 !', 'connecte', 'ProjectExcelsior-1024x1024.jpg', 'normal', 'utilisateur'),
(2, 'Ted', '$2y$11$kK0GHUFPqLVDain7JMbzwODVUFXJ5uxsstQ7KpD1TXJEHOFQ7pNou', 'ted@mosby.com', 'Bonjour, je m\'appelle Ted', 'disconnecte', 'none', 'normal', 'utilisateur'),
(3, 'Marshall', '$2y$11$HlMvRfF91fPa7le.vsKLjuIgJOGlItEOoPzXxPbMykC7chkm4tauO', 'eriksen@gmail.com', 'Actuellement occupée', 'occupe', 'marshall_hat.jpg', 'normal', 'utilisateur'),
(5, 'Arnie', '$2y$11$d4LpNil8UVZPoG2lbY4cuOtZcLumz11lWvfDdW54lganbZNeAxhJi', 'arnie@gmail.com', 'Essaye d\'installer Arch Linux', 'connecte', 'none', 'normal', 'utilisateur'),
(6, 'Frédo', '$2y$11$5hItgYpUg.PvqWuTMFEkgOBtdWhKsHAEtOM9.3sk4E4zb9MzVxZDq', 'fredo@gmail.com', 'Ne fait rien', 'connecte', 'none', 'normal', 'utilisateur'),
(7, 'toto', '$2y$11$2p5M4488frWU3SZZik1hBe7acsYQ3f4nfvsLLo3tChRcQ8FDI1TUG', 'toto@gmail.com', NULL, 'connecte', 'none', 'normal', 'utilisateur'),
(8, 'tata', '$2y$11$bLk6urOWEKBnAPk2qiZbk.4DISYNCzJk7yDC2ZcSSqTbn3UnbKi8K', 'tata@tata', NULL, 'connecte', 'none', 'normal', 'utilisateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `applis`
--
ALTER TABLE `applis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `app_machine`
--
ALTER TABLE `app_machine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_machine` (`id_machine`),
  ADD KEY `id_appli` (`id_appli`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contact_user1_idx` (`user_1`),
  ADD KEY `fk_contact_user2_idx` (`user_2`);

--
-- Index pour la table `listes`
--
ALTER TABLE `listes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_admin` (`user_admin`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message_user`
--
ALTER TABLE `message_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_user_user1_idx` (`user_send`),
  ADD KEY `fk_message_user_user2_idx` (`user_receive`),
  ADD KEY `fk_message_user_message1_idx` (`message_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `applis`
--
ALTER TABLE `applis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `app_machine`
--
ALTER TABLE `app_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `listes`
--
ALTER TABLE `listes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `message_user`
--
ALTER TABLE `message_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Contraintes pour la table `listes`
--
ALTER TABLE `listes`
  ADD CONSTRAINT `listes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_admin` FOREIGN KEY (`user_admin`) REFERENCES `user` (`id`);

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
