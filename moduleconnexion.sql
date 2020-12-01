-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 27 nov. 2020 à 13:35
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moduleconnexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `surname`, `name`, `password`, `email`) VALUES
(1, 'admin', '&lt;br /&gt;&lt;b&gt;Notice&lt;/b&gt;:  Undefined index: newsurname in &lt;b&gt;/Applications/MAMP/htdocs/module-connexion/profil.php&lt;/b&gt; on line &lt;b&gt;104&lt;/b&gt;&lt;br /&gt;', 'admin', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 'olivier@orange.fr'),
(2, 'test', 'test', 'test', 'test', 'oli.res@gmail.com'),
(3, 'AAA', 'Olivier', 'Puc', 'f36b4825e5db2cf7dd2d2593b3f5c24c0311d8b2', 'oli@orange.fr'),
(4, 'CCC', 'Jean-Jean', 'Philou', '90795a0ffaa8b88c0e250546d8439bc9c31e5a5e', 'Philou@orange.fr'),
(5, 'tata', '&lt;br /&gt;&lt;b&gt;Notice&lt;/b&gt;:  Undefined index: newsurname in &lt;b&gt;/Applications/MAMP/htdocs/module-connexion/profil.php&lt;/b&gt; on line &lt;b&gt;104&lt;/b&gt;&lt;br /&gt;', 'tata', '90795a0ffaa8b88c0e250546d8439bc9c31e5a5e', 'tata@tata.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
