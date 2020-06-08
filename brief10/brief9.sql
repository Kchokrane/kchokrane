-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 mai 2020 à 13:45
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `brief9`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Boissons'),
(2, 'Crémerie'),
(3, 'Conserves'),
(4, 'Pates'),
(5, 'Legumes'),
(6, 'Fruits'),
(7, 'Epicerie');

-- --------------------------------------------------------

--
-- Structure de la table `pack`
--

CREATE TABLE `pack` (
  `id_panier` int(11) NOT NULL,
  `nom_panier` char(250) NOT NULL,
  `desc_panier` char(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` char(250) NOT NULL,
  `qt_max` int(11) NOT NULL,
  `id_image` char(100) NOT NULL,
  `id_categori` int(11) NOT NULL,
  `prix_u` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `qt_max`, `id_image`, `id_categori`, `prix_u`) VALUES
(30, 'Argan Argap 250ML', 20, 'ARGAN-ARGAP-250ML-300x351', 7, 20),
(31, 'Betterave', 20, 'BETTERAVE', 5, 6.76),
(32, 'Boustane Orange', 20, 'boustane-orange-1L-300x351', 1, 9.5),
(33, 'Broccoli', 20, 'broccoli-site-300x351', 5, 10),
(34, 'Choux Blancs', 20, 'choux-blancs', 5, 11),
(35, 'Citron Jaune', 20, 'CITRON-JAUNE-LE-KG', 5, 9),
(36, 'Concentre Tomate 21CL', 20, 'CONCENTR-TOMATE-21CL-AICHA', 7, 4.45),
(37, 'Concombre Court', 20, 'CONCOMBRE-COURT', 5, 7),
(38, 'Couge Rouge', 20, 'COUGE-ROUGE', 5, 12),
(39, 'Courgette Blanche', 20, 'COURGETTE-BLANCHE', 5, 14),
(40, 'Cristal Huile 5L', 20, 'CRISTAL-Huile-5L', 7, 56.3),
(41, 'Dari Qoquillettes 500g', 20, 'dari-coquillettes-500g', 4, 14.5),
(42, 'Dari Couscous 1kg', 20, 'DARI-Couscous-belboula-1Kg', 7, 19),
(43, 'Epinard Branche', 20, 'EPINARD-BRANCHE-1.2-DAUCY', 3, 8.4),
(44, 'Epinard', 20, 'epinard-site-300x351', 5, 30),
(45, 'Filet Sardine Carl', 20, 'filet-sardine-carle-300x351', 3, 4),
(46, 'Pomme', 20, 'Gala-Pomme', 6, 9.99),
(47, 'Huile Dolive 1L', 20, 'HUILE-DOLIVE-VIERGE-COURANTE-1L-ATLAS-OLIVE', 7, 16),
(48, 'Valencia Orange 1L', 20, 'orange-1L-300x351', 1, 9.6),
(49, 'Orange', 20, 'orange-a-jus', 6, 7.59),
(50, 'Piment', 10, 'piment', 5, 9.99),
(51, 'Poivron Jaune', 20, 'POIVRON-JAUNE', 5, 12),
(52, 'Pulpy 1L', 20, 'pulpy-1L', 1, 8.99),
(53, 'Cigala Riz Etuve Jaune 1KG', 20, 'RIZ-ETUVE-JAUNE-1K-CIGALA', 7, 19.99),
(54, 'Cigala Riz Long Blanc 1KG', 20, 'riz-long-blanc-cigala-1kg', 7, 14.99),
(55, 'Tria Farine Fleur 2kg', 20, 'TRIA-Farine-Fleur-2Kg', 7, 19.99),
(56, 'Valencia Fruit 1L', 20, 'valencia-fruit-rg-1L-300x351', 1, 11.99),
(57, 'Valencia Jus Ananas', 20, 'valencia-pur-jus-ananas-1L-300x351', 1, 11.59),
(58, 'Vinaigre Cidre Chatel', 20, 'VINAIGRE-CIDRE-CHATEL-100CL', 7, 15);

-- --------------------------------------------------------

--
-- Structure de la table `produitpanier`
--

CREATE TABLE `produitpanier` (
  `quantite_produit` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_panier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produitpanier`
--

INSERT INTO `produitpanier` (`quantite_produit`, `id_produit`, `id_panier`) VALUES
(1, 33, 1),
(1, 32, 1),
(1, 31, 2),
(1, 33, 2),
(1, 32, 2),
(1, 30, 2),
(1, 34, 2),
(1, 37, 2),
(1, 40, 2),
(1, 38, 2),
(1, 41, 2),
(1, 43, 2),
(1, 50, 2),
(1, 56, 2),
(1, 52, 2),
(1, 42, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(2, 'kamal', 'chokrane.kamal@gmail.com', '$2y$10$TMAsJ3xpxrjqIrk/11zACODXERA.folD.Y/ig1dfkEVGaXCoBUJ9q'),
(3, 'jamal', 'kchokrane@gmail.com', '$2y$10$3ZvuFRkUwvLeP8wCpj09pOnfqMSfmSptNnYSUmttxdWJyHUt.HCMq'),
(4, 'ayoub', 'ayoub@gmail.com', '$2y$10$2xucNP4M/7QmpY7Wg4qu3.hndRe5krO5smU3Ts2znYRFaFO2UuIpC'),
(5, 'ahmed', 'ahmed@gmail.com', '$2y$10$gHwSiRpSK6wZ6WoonlVFC.NutiVsU87pCRht.Oo2rkAi1k8rduFm6'),
(6, 'azerty', 'azerty@gmail.com', '$2y$10$KAsSQ5Pe2CVOMY0bN5XBPOw7zzJB0yhDsuus6VIltE8maflPcf./O'),
(7, 'saad', 'saad@gmail.com', '$2y$10$vReiP.foHTDUlR9bJrmOGujDUr7bKhTivtkw9hBAEPYvZyobDfTzy'),
(8, 'monsef', 'monsef@gmail.com', '$2y$10$93nzQ/zPk6Jn/pP0ltEt9OpaeZ4Z3CRMa1tP.ly6tJGR0sNYt.Jzi');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `pack`
--
ALTER TABLE `pack`
  ADD PRIMARY KEY (`id_panier`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `pack`
--
ALTER TABLE `pack`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
