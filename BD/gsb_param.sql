-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 25 mai 2022 à 07:51
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
-- Base de données : `gsb_param`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` char(3) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `nom` char(32) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `mdp` char(100) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` char(32) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `libelle` char(32) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
('CH', 'Cheveux'),
('FO', 'Forme'),
('PS', 'Protection Solaire');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL,
  `nom` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `tel` int NOT NULL,
  `adresse` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `ville` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `cp` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` char(32) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `dateCommande` date DEFAULT NULL,
  `nomPrenomClient` char(32) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  `adresseRueClient` char(32) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  `cpClient` char(5) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  `villeClient` char(32) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  `mailClient` char(50) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `dateCommande`, `nomPrenomClient`, `adresseRueClient`, `cpClient`, `villeClient`, `mailClient`) VALUES
('1101461660', '2011-07-12', 'Dupont Jacques', '12, rue haute', '75001', 'Paris', 'dupont@wanadoo.fr'),
('1101461665', '2011-07-20', 'Durant Yves', '23, rue des ombres', '75012', 'Paris', 'durant@free.fr');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `idCompte` int NOT NULL,
  `mail` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  PRIMARY KEY (`idCompte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Structure de la table `contenance`
--

DROP TABLE IF EXISTS `contenance`;
CREATE TABLE IF NOT EXISTS `contenance` (
  `id` int NOT NULL,
  `unite` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `qteUnite` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `id` char(32) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `id_commande` char(32) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  PRIMARY KEY (`id`,`id_commande`),
  KEY `contenir_commande0_FK` (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`id`, `id_commande`) VALUES
('f03', '1101461660'),
('p01', '1101461660'),
('f05', '1101461665'),
('p06', '1101461665');

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `id` int NOT NULL,
  `id_produit` char(32) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id`,`id_produit`),
  KEY `contient_produit0_FK` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Structure de la table `effectue`
--

DROP TABLE IF EXISTS `effectue`;
CREATE TABLE IF NOT EXISTS `effectue` (
  `id` int NOT NULL,
  `id_commande` char(32) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  PRIMARY KEY (`id`,`id_commande`),
  KEY `effectue_commande0_FK` (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

DROP TABLE IF EXISTS `possede`;
CREATE TABLE IF NOT EXISTS `possede` (
  `idCompte` int NOT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`idCompte`,`id`),
  KEY `possede_client0_FK` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` char(32) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `description` char(50) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  `prix` decimal(10,0) DEFAULT NULL,
  `image` char(100) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  `id_categorie` char(32) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produit_categorie_FK` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `description`, `prix`, `image`, `id_categorie`) VALUES
('c01', 'Laino Shampooing Douche au Thé Vert BIO', '4', 'images/laino-shampooing-douche-au-the-vert-bio-200ml.png', 'CH'),
('c02', 'Klorane fibres de lin baume après shampooing', '11', 'images/klorane-fibres-de-lin-baume-apres-shampooing-150-ml.jpg', 'CH'),
('c03', 'Weleda Kids 2in1 Shower & Shampoo Orange fruitée', '4', 'images/weleda-kids-2in1-shower-shampoo-orange-fruitee-150-ml.jpg', 'CH'),
('c04', 'Weleda Kids 2in1 Shower & Shampoo vanille douce', '4', 'images/weleda-kids-2in1-shower-shampoo-vanille-douce-150-ml.jpg', 'CH'),
('c05', 'Klorane Shampooing sec à l\'extrait d\'ortie', '6', 'images/klorane-shampooing-sec-a-l-extrait-d-ortie-spray-150ml.png', 'CH'),
('c06', 'Phytopulp mousse volume intense', '18', 'images/phytopulp-mousse-volume-intense-200ml.jpg', 'CH'),
('c07', 'Bio Beaute by Nuxe Shampooing nutritif', '8', 'images/bio-beaute-by-nuxe-shampooing-nutritif-200ml.png', 'CH'),
('f01', 'Nuxe Men Contour des Yeux Multi-Fonctions', '12', 'images/nuxe-men-contour-des-yeux-multi-fonctions-15ml.png', 'FO'),
('f02', 'Tisane romon nature sommirel bio sachet 20', '6', 'images/tisane-romon-nature-sommirel-bio-sachet-20.jpg', 'FO'),
('f03', 'La Roche Posay Cicaplast crème pansement', '11', 'images/la-roche-posay-cicaplast-creme-pansement-40ml.jpg', 'FO'),
('f04', 'Futuro sport stabilisateur pour cheville', '27', 'images/futuro-sport-stabilisateur-pour-cheville-deluxe-attelle-cheville.png', 'FO'),
('f05', 'Microlife pèse-personne électronique weegschaal', '63', 'images/microlife-pese-personne-electronique-weegschaal-ws80.jpg', 'FO'),
('f06', 'Melapi Miel Thym Liquide 500g', '7', 'images/melapi-miel-thym-liquide-500g.jpg', 'FO'),
('f07', 'Meli Meliflor Pollen 200g', '9', 'images/melapi-pollen-250g.jpg', 'FO'),
('p01', 'Avène solaire Spray très haute protection', '22', 'images/avene-solaire-spray-tres-haute-protection-spf50200ml.png', 'PS'),
('p02', 'Mustela Solaire Lait très haute Protection', '18', 'images/mustela-solaire-lait-tres-haute-protection-spf50-100ml.jpg', 'PS'),
('p03', 'Isdin Eryfotona aAK fluid', '29', 'images/isdin-eryfotona-aak-fluid-100-50ml.jpg', 'PS'),
('p04', 'La Roche Posay Anthélios 50+ Brume Visage', '9', 'images/la-roche-posay-anthelios-50-brume-visage-toucher-sec-75ml.png', 'PS'),
('p05', 'Nuxe Sun Huile Lactée Capillaire Protectrice', '15', 'images/nuxe-sun-huile-lactee-capillaire-protectrice-100ml.png', 'PS'),
('p06', 'Uriage Bariésun stick lèvres SPF30 4g', '6', 'images/uriage-bariesun-stick-levres-spf30-4g.jpg', 'PS'),
('p07', 'Bioderma Cicabio creme SPF50+ 30ml', '14', 'images/bioderma-cicabio-creme-spf50-30ml.png', 'PS');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_commande0_FK` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `contenir_produit_FK` FOREIGN KEY (`id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `contient_contenance_FK` FOREIGN KEY (`id`) REFERENCES `contenance` (`id`),
  ADD CONSTRAINT `contient_produit0_FK` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `effectue`
--
ALTER TABLE `effectue`
  ADD CONSTRAINT `effectue_client_FK` FOREIGN KEY (`id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `effectue_commande0_FK` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `possede`
--
ALTER TABLE `possede`
  ADD CONSTRAINT `possede_client0_FK` FOREIGN KEY (`id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `possede_compte_FK` FOREIGN KEY (`idCompte`) REFERENCES `compte` (`idCompte`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie_FK` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
