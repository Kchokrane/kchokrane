-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2020 at 08:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brief9`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email_admin` char(100) NOT NULL,
  `nom_admin` char(100) NOT NULL,
  `prenom_admin` char(100) NOT NULL,
  `pass_admin` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email_admin`, `nom_admin`, `prenom_admin`, `pass_admin`) VALUES
(1, 'admin@domain.com', 'Anass', 'Youssfi', 'azerty');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie`
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
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client` char(100) NOT NULL,
  `email_client` char(250) DEFAULT NULL,
  `pass_client` char(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `email_client`, `pass_client`) VALUES
(2, '3li', 'myEmail@domain.com', 'azerty');

-- --------------------------------------------------------

--
-- Table structure for table `pack`
--

CREATE TABLE `pack` (
  `id_pack` int(11) NOT NULL,
  `nom_pack` char(250) NOT NULL,
  `desc_pack` char(250) NOT NULL,
  `prix_pack` double NOT NULL,
  `image_pack` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pack`
--

INSERT INTO `pack` (`id_pack`, `nom_pack`, `desc_pack`, `prix_pack`, `image_pack`) VALUES
(1, 'Pack fruits', '100% Pure et naturelle', 60, 'pack1'),
(2, 'Pack dîner', 'Dîner facile à préparer', 20, 'pack2');

-- --------------------------------------------------------

--
-- Table structure for table `packpanier`
--

CREATE TABLE `packpanier` (
  `id_panier` int(11) NOT NULL,
  `id_pack` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packpanier`
--

INSERT INTO `packpanier` (`id_panier`, `id_pack`) VALUES
(2, 2),
(2, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `purchased` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_client`, `purchased`) VALUES
(2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
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
-- Dumping data for table `produit`
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
(58, 'Vinaigre Cidre Chatel', 20, 'VINAIGRE-CIDRE-CHATEL-100CL', 7, 15),
(59, 'TESTprod', 5, 'ce', 4, 23),
(60, 'TEST2', 99, 'ubuntuLogo', 2, 99),
(61, 'TEST99', 12, 'ce', 2, 999);

-- --------------------------------------------------------

--
-- Table structure for table `produitpack`
--

CREATE TABLE `produitpack` (
  `id_produit` int(11) NOT NULL,
  `id_pack` int(11) NOT NULL,
  `nb_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produitpack`
--

INSERT INTO `produitpack` (`id_produit`, `id_pack`, `nb_produit`) VALUES
(46, 1, 1),
(49, 1, 1),
(36, 2, 1),
(41, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produitpanier`
--

CREATE TABLE `produitpanier` (
  `quantite_produit` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_panier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produitpanier`
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `pack`
--
ALTER TABLE `pack`
  ADD PRIMARY KEY (`id_pack`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pack`
--
ALTER TABLE `pack`
  MODIFY `id_pack` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
