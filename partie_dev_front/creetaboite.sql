-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 07 déc. 2020 à 17:06
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `creetaboite`
--

-- --------------------------------------------------------

--
-- Structure de la table `associates`
--

DROP TABLE IF EXISTS `associates`;
CREATE TABLE IF NOT EXISTS `associates` (
  `associate_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `societe_ref_prosp` varchar(11) DEFAULT NULL,
  `associate_nb_action` int(11) DEFAULT NULL,
  `associate_participation` decimal(6,2) DEFAULT NULL,
  `associate_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`associate_id`),
  KEY `associates_ibfk_1` (`customer_id`),
  KEY `associates_ibfk_2` (`societe_ref_prosp`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `associates`
--

INSERT INTO `associates` (`associate_id`, `customer_id`, `societe_ref_prosp`, `associate_nb_action`, `associate_participation`, `associate_doc`) VALUES
(7, 93, 'P002', 200, '80.00', ''),
(8, 94, 'P002', 50, '20.00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `connect`
--

DROP TABLE IF EXISTS `connect`;
CREATE TABLE IF NOT EXISTS `connect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `societe_ref_prosp` varchar(256) DEFAULT NULL,
  `connect_email` varchar(256) NOT NULL,
  `guizmo` varchar(256) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `game_over` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_id` (`customer_id`),
  KEY `connect_ibfk_2` (`societe_ref_prosp`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connect`
--

INSERT INTO `connect` (`id`, `customer_id`, `societe_ref_prosp`, `connect_email`, `guizmo`, `admin`, `game_over`) VALUES
(10, NULL, NULL, 'seb10400@orange.fr', '$2y$10$53L0s1E5FgQqpfCcMhabqulu0xJfj6STt0JA7qtLugjym8hrX9rRW', 1, 0),
(14, 22, 'P001', 'seb@toto.fr', '$2y$10$qB2KWgagkDPugj3d8B84R.b3Ig1UEXk33a.72Sowi5JJNv3lzB6Sq', 0, 1),
(16, 93, 'P002', 'pif@pifmag.fr', '$2y$10$RRCTwD4BTRcWwY0z2jP6r.Mt5xcD6adcJsoVOlvODUYmNp15yYYz.', 0, 0),
(17, 95, 'P003', 'truc@to.fr', '$2y$10$wMiPrUF5Lsn8PAgludXmHOIQYc1sZs7nN6KgbQCIvf2s5FyCB1j2e', 0, 0),
(18, 96, 'P004', 'truc@toto.fr', '$2y$10$VR8dxpIIAO5ecIl4HEoSTeUUTewjsTQmzg6RNo1rwWG1UW9ORmdFG', 0, 0),
(19, 97, 'P005', 'tuche@toto.fr', '$2y$10$xpm1QY.gmpaPzRCaVyhPZ.suSt26i7P106ruT7ulv66bo3Ncs2L/i', 0, 1),
(21, 99, 'P010', 'seb10400@orange.fr', '$2y$10$AKHi9WkwEHwG9jCIf.RH5Oac.Bh0fpBzMw9O4q/uNnB2L0yi9CY7m', 0, 0),
(22, 100, 'P006', 'seb10400@orange.fr', '$2y$10$VVFh.OzGUhvg10mpCbDjhucv1DtsDJjqhpAvkmwA2t6eEyT.7Jr1m', 0, 0),
(23, 101, 'P020', 'seb10400@orange.fr', '$2y$10$jtD.PFq0jEFSjuYHDxMDr.R8PueCu4CUiNIxHii5iNuMLLen6dxfy', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `societe_ref_prosp` varchar(11) DEFAULT NULL,
  `cust_status` int(11) NOT NULL,
  `customer_civility` varchar(256) DEFAULT NULL,
  `customer_fullname` varchar(255) DEFAULT NULL,
  `customer_firstname` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(10) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_zip_code` int(11) DEFAULT NULL,
  `customer_city` varchar(256) DEFAULT NULL,
  `customer_birthday` date DEFAULT NULL,
  `customer_place_of_birth` varchar(255) DEFAULT NULL,
  `customer_nationality` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `customer_ibfk_1` (`customer_civility`),
  KEY `customer_ibfk_2` (`cust_status`),
  KEY `societe_ref_propect` (`societe_ref_prosp`,`cust_status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`customer_id`, `societe_ref_prosp`, `cust_status`, `customer_civility`, `customer_fullname`, `customer_firstname`, `customer_email`, `customer_phone`, `customer_address`, `customer_zip_code`, `customer_city`, `customer_birthday`, `customer_place_of_birth`, `customer_nationality`) VALUES
(22, 'P001', 2, 'monsieur', 'lechat ', 'hercule', 'seb@toto.fr', '0201020304', '15 rue de la joie', 10000, 'troyes', '1982-01-20', 'romilly sur seine', 'francaise'),
(93, 'P002', 2, 'monsieur', 'Lechien ', 'Pif', 'pif@pifmag.fr', '0102030405', '15 rue basse ', 89000, 'auxerre', '2000-12-10', 'tatouine', 'Marocaine'),
(94, 'P002', 3, 'monsieur', 'tuche', 'gisel', 'tutu@to.fr', '102030405', '15 rue du bois', 10000, 'tropyes', '1983-10-20', 'bouzolle', 'Française'),
(95, 'P003', 2, 'monsieur', 'truc ', 'muche', 'truc@to.fr', '0102030405', '15 chemin du bois', 89100, 'sens', '1982-12-10', 'vincennes', 'Française'),
(96, 'P004', 1, 'monsieur', 'MUCHE', 'truc', 'truc@toto.fr', '0603010203', NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'p005', 1, 'madame', 'tuche', 'mamy', 'tuche@toto.fr', '0102030405', NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'P010', 1, 'monsieur', 'sebou', 'sed', 'seb10400@orange.fr', '', NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'P006', 1, 'monsieur', 'capulet', 'romeo', 'seb10400@orange.fr', '', NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'P020', 1, 'monsieur', 'sebous', 'seba', 'seb10400@orange.fr', '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cust_status`
--

DROP TABLE IF EXISTS `cust_status`;
CREATE TABLE IF NOT EXISTS `cust_status` (
  `cust_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_stat` varchar(256) NOT NULL,
  PRIMARY KEY (`cust_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cust_status`
--

INSERT INTO `cust_status` (`cust_status_id`, `cust_stat`) VALUES
(1, 'Dirigeant'),
(2, 'Dirigeant- associé'),
(3, 'Associé');

-- --------------------------------------------------------

--
-- Structure de la table `doctype`
--

DROP TABLE IF EXISTS `doctype`;
CREATE TABLE IF NOT EXISTS `doctype` (
  `doctype_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctype_name` varchar(255) NOT NULL,
  PRIMARY KEY (`doctype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `doctype`
--

INSERT INTO `doctype` (`doctype_id`, `doctype_name`) VALUES
(1, 'carte d\'identité'),
(2, 'justificatif de domicile'),
(3, 'attestation de non condamnation'),
(4, 'RIB'),
(5, 'Kbis'),
(6, 'status de la société'),
(7, 'acte nomination du dirigeant'),
(8, 'contrat domicilation'),
(9, 'parution légale du siège'),
(10, 'autorisation de prélèvement SEPA'),
(11, 'procuration'),
(12, 'attestation d\'assurance'),
(13, 'déclaration des bénéficiaires'),
(14, 'cerfa de création'),
(15, 'attestation dépôt de fonds'),
(16, 'bail'),
(17, 'document juridique');

-- --------------------------------------------------------

--
-- Structure de la table `doc_generate`
--

DROP TABLE IF EXISTS `doc_generate`;
CREATE TABLE IF NOT EXISTS `doc_generate` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name_generate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `doc_generate`
--

INSERT INTO `doc_generate` (`doc_id`, `doc_name_generate`) VALUES
(1, 'attest_dom.html'),
(2, 'attest_non_condamnation.html'),
(3, 'lettre_info.html'),
(4, 'liste_soucripteur.html\r\n'),
(5, 'modele_EURL.html'),
(6, 'modele_SASU.html'),
(7, NULL),
(8, NULL),
(9, NULL),
(10, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `societe_ref_prosp` varchar(11) NOT NULL,
  `presta_id` int(11) DEFAULT NULL,
  `comments` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_work` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `history_ibfk_2` (`presta_id`),
  KEY `society_id` (`societe_ref_prosp`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `societe_ref_prosp`, `presta_id`, `comments`, `date`, `time_work`) VALUES
(1, 'P001', NULL, 'bon dév possible,possible vente des presta annexes', '2020-11-10 05:34:35', 15),
(6, 'P001', 1, 'xfcvbfcgwdf', '2020-11-10 08:58:42', 120),
(7, 'P001', 3, 'zersgtqhgthj', '2020-11-10 08:58:42', 90),
(9, 'P002', NULL, 'différents des autres centres', '2020-11-10 11:09:12', 60),
(10, 'P002', 1, NULL, '2020-11-12 05:26:17', NULL),
(11, 'P002', 1, NULL, '2020-11-12 12:20:57', NULL),
(12, 'P002', 2, NULL, '2020-11-12 12:20:57', NULL),
(13, 'P002', 3, NULL, '2020-11-12 12:20:57', NULL),
(14, 'P002', 4, NULL, '2020-11-12 12:20:57', NULL),
(15, 'P002', 5, NULL, '2020-11-12 12:20:57', NULL),
(16, 'P003', NULL, '????', '2020-11-19 10:04:52', 10),
(18, 'P003', NULL, 'changement de status', '2020-11-24 05:28:33', NULL),
(19, 'P003', NULL, 'changement de status', '2020-11-24 05:32:54', NULL),
(20, 'P003', NULL, 'changement de status', '2020-11-24 05:33:51', NULL),
(21, 'P003', NULL, 'changement de status', '2020-11-24 05:35:43', NULL),
(22, 'P003', NULL, 'changement de status', '2020-11-24 05:37:46', NULL),
(23, 'P003', NULL, 'changement de status', '2020-11-24 05:38:39', NULL),
(24, 'P003', NULL, 'changement de status', '2020-11-24 05:43:43', NULL),
(25, 'P003', NULL, 'changement de status', '2020-11-24 05:45:01', NULL),
(26, 'P003', NULL, 'changement de status', '2020-11-24 05:49:10', NULL),
(27, 'P003', NULL, 'changement de status', '2020-11-24 05:50:12', NULL),
(28, 'P003', NULL, 'changement de status', '2020-11-24 05:50:35', NULL),
(29, 'P003', NULL, 'changement de status', '2020-11-24 05:51:03', NULL),
(30, 'P003', NULL, 'changement de status', '2020-11-02 05:51:45', NULL),
(31, 'P001', NULL, 'changement de status', '2020-11-24 05:52:38', NULL),
(32, 'P001', NULL, 'changement de status', '2020-11-24 06:02:28', NULL),
(33, 'P001', NULL, 'changement de status', '2020-11-24 06:02:47', NULL),
(34, 'P003', NULL, 'changement de status', '2020-11-24 06:04:14', NULL),
(35, 'P003', NULL, 'changement de status', '2020-11-24 08:00:34', NULL),
(36, 'P001', 12, NULL, '2020-12-02 07:08:46', NULL),
(37, 'P001', 13, NULL, '2020-12-02 07:08:46', NULL),
(38, 'P001', NULL, 'changement de classe: En cours de création', '2020-12-02 07:08:58', NULL),
(39, 'P002', NULL, 'changement de classe: En cours de création', '2020-12-02 07:10:12', NULL),
(40, 'P002', 13, NULL, '2020-12-02 07:10:22', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lease_term`
--

DROP TABLE IF EXISTS `lease_term`;
CREATE TABLE IF NOT EXISTS `lease_term` (
  `lease_term_id` int(11) NOT NULL AUTO_INCREMENT,
  `lease` int(11) DEFAULT NULL,
  PRIMARY KEY (`lease_term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lease_term`
--

INSERT INTO `lease_term` (`lease_term_id`, `lease`) VALUES
(1, 12),
(2, 24),
(3, 9);

-- --------------------------------------------------------

--
-- Structure de la table `list_url`
--

DROP TABLE IF EXISTS `list_url`;
CREATE TABLE IF NOT EXISTS `list_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `societe_ref_prosp` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `societe_ref_prosp` (`societe_ref_prosp`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `list_url`
--

INSERT INTO `list_url` (`id`, `societe_ref_prosp`, `link`) VALUES
(1, 'P001', NULL),
(2, 'P002', NULL),
(3, 'P003', NULL),
(4, 'P004', NULL),
(5, 'P005', NULL),
(6, 'P010', 'OTktLSQyeSQxMCRuZjBCVHRjMjY1SHVtY2tQMkZZMFNlaGw1VEh3QXlwclY2eGR3eVBZVi9RNkNpM3NMMjVieS0tc2ViMTA0MDBAb3JhbmdlLmZyLS1QMDEw'),
(7, 'P006', 'MTAwLS0kMnkkMTAkUHY3V0FKUy9CNUphNnlPMGZMQ2dHdS5LN00zeU1NemM0S29jektCa3oyN3ZwVUs0TkVLNDItLXNlYjEwNDAwQG9yYW5nZS5mci0tUDAwNg=='),
(8, 'P020', 'MTAxLS0kMnkkMTAkZkdrdWhCcGx0S0R3L3FRU3hPWHA5T1pKdi55VUZGUERVZXdlUjRPejBkOXlURzNDUm45dWktLXNlYjEwNDAwQG9yYW5nZS5mci0tUDAyMA==');

-- --------------------------------------------------------

--
-- Structure de la table `local`
--

DROP TABLE IF EXISTS `local`;
CREATE TABLE IF NOT EXISTS `local` (
  `ref_local_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_bureau` varchar(255) NOT NULL,
  `ref_int_local` varchar(255) DEFAULT NULL,
  `supercifie` int(11) DEFAULT NULL,
  `surface_weighted` int(11) DEFAULT NULL,
  `position_id` varchar(256) DEFAULT NULL,
  `number_park_place` int(11) DEFAULT NULL,
  `rent_surface_price_m` int(11) DEFAULT NULL,
  `mensual_rent_ht` int(11) DEFAULT NULL,
  `rent_letter` varchar(255) DEFAULT NULL,
  `prorated_rent` int(11) DEFAULT NULL,
  `charge` int(11) DEFAULT NULL,
  `property_tax` int(11) DEFAULT NULL,
  `cumulative_rent` int(11) DEFAULT NULL,
  PRIMARY KEY (`ref_local_id`),
  KEY `ref_int_local` (`ref_int_local`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `local`
--

INSERT INTO `local` (`ref_local_id`, `zone_bureau`, `ref_int_local`, `supercifie`, `surface_weighted`, `position_id`, `number_park_place`, `rent_surface_price_m`, `mensual_rent_ht`, `rent_letter`, `prorated_rent`, `charge`, `property_tax`, `cumulative_rent`) VALUES
(1, 'senon', 'senon-A', 12, 10, '1', 0, 12, 160, 'cent soixante euros', 130, 15, 15, 220),
(3, 'senon', 'senon-B', 24, 20, 'rdc', 1, 15, 181, 'cent quatre vingt un', 180, 16, 16, 196),
(4, 'senon', 'senon-C', 24, 20, 'rdc', 0, 0, 0, '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `presta`
--

DROP TABLE IF EXISTS `presta`;
CREATE TABLE IF NOT EXISTS `presta` (
  `prest_id` int(11) NOT NULL AUTO_INCREMENT,
  `prest_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`prest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `presta`
--

INSERT INTO `presta` (`prest_id`, `prest_name`) VALUES
(1, 'Etude de marché'),
(2, 'Buisness plan'),
(3, 'Création d\'entreprise'),
(4, 'Comptabilité'),
(5, 'Branding'),
(6, 'Site internet'),
(7, 'Marketing'),
(8, 'Relation publique'),
(9, 'Vidéo'),
(10, 'Réseaux'),
(11, 'Fabrication'),
(12, 'Dépot de marque'),
(13, 'Bureaux');

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

DROP TABLE IF EXISTS `societe`;
CREATE TABLE IF NOT EXISTS `societe` (
  `societe_id` int(11) NOT NULL AUTO_INCREMENT,
  `societe_crea_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `societe_ref_prosp` varchar(255) DEFAULT NULL,
  `societe_ref_customer` varchar(11) DEFAULT NULL,
  `societe_ref_cont` varchar(11) DEFAULT NULL,
  `societe_name` varchar(255) DEFAULT NULL,
  `societe_activity` varchar(256) DEFAULT NULL,
  `societe_form` varchar(10) DEFAULT NULL,
  `societe_address` varchar(255) DEFAULT NULL,
  `societe_zip_code` int(11) DEFAULT NULL,
  `societe_city` varchar(255) DEFAULT NULL,
  `societe_immat` varchar(30) DEFAULT NULL,
  `tva_number` varchar(255) DEFAULT NULL,
  `code_ape` varchar(255) DEFAULT NULL,
  `sign_date` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `rcs_city` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `term` date DEFAULT NULL,
  `lease_term_id` int(11) DEFAULT NULL,
  `domiciliation` varchar(255) DEFAULT NULL,
  `ref_int_local` varchar(11) DEFAULT NULL,
  `date_entrance` date DEFAULT NULL,
  `security_deposit` int(11) DEFAULT NULL,
  `number_action` int(11) DEFAULT NULL,
  `action_price` int(11) DEFAULT NULL,
  `capital` int(11) DEFAULT NULL,
  `number_exemplaires` int(11) DEFAULT NULL,
  `made_date` date DEFAULT NULL,
  `made_place` varchar(255) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `social_denomination` varchar(255) DEFAULT NULL,
  `commercial_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`societe_id`),
  UNIQUE KEY `societe_ref_prosp` (`societe_ref_prosp`),
  KEY `societe_ibfk_1` (`customer_id`),
  KEY `societe_ibfk_3` (`status_id`),
  KEY `ref_int_local` (`ref_int_local`),
  KEY `lease_term_id` (`lease_term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`societe_id`, `societe_crea_date`, `societe_ref_prosp`, `societe_ref_customer`, `societe_ref_cont`, `societe_name`, `societe_activity`, `societe_form`, `societe_address`, `societe_zip_code`, `societe_city`, `societe_immat`, `tva_number`, `code_ape`, `sign_date`, `date_end`, `rcs_city`, `customer_id`, `bank`, `bank_address`, `iban`, `term`, `lease_term_id`, `domiciliation`, `ref_int_local`, `date_entrance`, `security_deposit`, `number_action`, `action_price`, `capital`, `number_exemplaires`, `made_date`, `made_place`, `status_id`, `social_denomination`, `commercial_name`) VALUES
(30, '2019-09-10 03:09:24', 'P001', 'E003', '', 'boulon a gogo', '', 'eurl', '17 rue de sancey', 89000, 'sens', '1526348523', 'F251623', '626', '2019-10-12', '2020-10-11', 'sens', 2, 'bpcl', '15 rue des bois 89000 sens', 'FR189012331456123', NULL, 1, 'fiscale', 'senon-A', '2019-10-12', 150, 0, 0, 10000, NULL, '2019-10-12', 'sens', 2, '', ''),
(32, '2018-08-13 03:09:24', 'P002', 'E003', '', 'ma bonne formation', '', 'sas', '17 rue de sancey', 89000, 'sens', '12563 152154 c0 5415', 'F1213168541', '58952', NULL, NULL, NULL, 93, NULL, NULL, NULL, NULL, 3, 'fiscale', 'senon-C', NULL, 0, 250, 2, 500, NULL, NULL, NULL, 2, '', ''),
(33, '2019-11-14 11:15:24', 'P003', 'E002', '', 'truc à gogo', '', 'sasu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, NULL, NULL, NULL, NULL, NULL, 'commerciale', NULL, NULL, NULL, 0, 0, 1, NULL, NULL, NULL, 3, '', ''),
(34, '2020-11-24 09:58:38', 'P004', NULL, NULL, 'muche', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, NULL, NULL, NULL, NULL, NULL, 'fiscale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(35, '2020-11-24 10:35:31', 'P005', NULL, NULL, 'tuche forever', '', 'eurl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 97, NULL, NULL, NULL, NULL, NULL, 'commerciale', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 1, '', ''),
(37, '2020-11-26 12:24:51', 'P010', NULL, NULL, '', NULL, 'eurl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, 'fiscale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(38, '2020-11-26 14:28:38', 'P006', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, 'fiscale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(39, '2020-08-03 14:50:22', 'P012', NULL, NULL, NULL, NULL, 'sarl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fiscale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(40, '2020-07-13 14:50:22', 'P014', NULL, NULL, NULL, NULL, 'sas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fiscale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(41, '2020-12-04 05:09:07', 'P015', NULL, NULL, NULL, NULL, 'sas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fiscale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(42, '2020-12-04 05:09:07', 'P016', NULL, NULL, NULL, NULL, 'eurl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'commerciale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(43, '2020-12-07 12:04:19', 'P020', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`status_id`, `status_type`) VALUES
(1, 'Prospect'),
(2, 'Actif'),
(3, 'Archivé'),
(4, 'Contentieux');

-- --------------------------------------------------------

--
-- Structure de la table `upload`
--

DROP TABLE IF EXISTS `upload`;
CREATE TABLE IF NOT EXISTS `upload` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `societe_ref_prosp` varchar(11) DEFAULT NULL,
  `upload_doc_name` varchar(255) NOT NULL,
  `upload_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upload_doctype_id` int(11) NOT NULL,
  PRIMARY KEY (`upload_id`),
  UNIQUE KEY `upload_doc_name` (`upload_doc_name`),
  KEY `upload_ibfk_1` (`societe_ref_prosp`),
  KEY `upload_doctype_id` (`upload_doctype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `upload`
--

INSERT INTO `upload` (`upload_id`, `societe_ref_prosp`, `upload_doc_name`, `upload_datetime`, `upload_doctype_id`) VALUES
(1, 'P001', 'doc1', '2020-11-16 08:32:12', 1),
(88, 'P002', '', '2020-11-17 10:38:07', 1),
(89, 'P002', 'just_dom_Lechien_1605605872.pdf', '2020-11-17 10:38:07', 2),
(91, 'P002', 'RIB_Lechien_1605605879.pdf', '2020-11-17 10:38:07', 4),
(92, 'P002', 'depot_fond_Lechien_1605605886.pdf', '2020-11-17 10:38:07', 15),
(94, 'P002', 'just_dom_Lechien_1605606297.pdf', '2020-11-17 10:45:06', 2),
(96, 'P002', 'RIB_Lechien_1605606305.pdf', '2020-11-17 10:45:06', 4),
(98, 'P002', 'ci_Lechien_1605606703.pdf', '2020-11-17 10:52:02', 1),
(99, 'P002', 'attestation_de_non_condamnation_Lechien_1605606717.pdf', '2020-11-17 10:52:02', 3),
(101, 'P002', 'depot_fond_Lechien_1605606721.pdf', '2020-11-17 10:52:02', 15),
(102, 'P002', 'just_dom_Lechien_1605606848.pdf', '2020-11-17 10:54:14', 2),
(103, 'P002', 'RIB_Lechien_1605606853.pdf', '2020-11-17 10:54:14', 4),
(104, 'P002', 'ci_Lechien_1605607818.pdf', '2020-11-17 11:11:20', 1),
(105, 'P002', 'just_dom_Lechien_1605607824.pdf', '2020-11-17 11:11:20', 2),
(106, 'P002', 'attestation_de_non_condamnation_Lechien_1605607868.pdf', '2020-11-17 11:11:20', 3),
(107, 'P002', 'RIB_Lechien_1605607873.pdf', '2020-11-17 11:11:20', 4),
(108, 'P002', 'depot_fond_Lechien_1605607879.pdf', '2020-11-17 11:11:20', 15),
(109, 'P002', 'KBIS_1605621883.pdf', '2020-11-17 15:04:43', 5),
(110, 'P002', 'doc_jurid_1605622653.jpg', '2020-11-17 15:17:33', 17),
(111, 'P002', 'bail_1605622802.pdf', '2020-11-17 15:20:02', 16),
(112, 'P002', 'bail_1605706555.pdf', '2020-11-18 14:35:55', 16),
(113, 'P002', 'doc_jurid_1605716844.pdf', '2020-11-18 17:27:24', 17),
(114, 'P002', 'KBIS_1605717107.', '2020-11-18 17:31:47', 5),
(115, NULL, 'attest-domP002.pdf', '2020-11-18 17:41:52', 17),
(116, 'P002', 'attest-domP002_1605717963.pdf', '2020-11-18 17:46:03', 17),
(126, NULL, 'attest-dom_1605849321.pdf', '2020-11-20 06:15:21', 17),
(127, 'P001', 'attest-domP001_1605849589.pdf', '2020-11-20 06:19:49', 17),
(128, 'P001', 'avant-projetP001_1605849622.pdf', '2020-11-20 06:20:22', 17),
(129, 'P001', 'bail-derogatoire-12moisP001_1605849642.pdf', '2020-11-20 06:20:42', 17),
(130, 'P003', 'attest-domP003_1605849670.pdf', '2020-11-20 06:21:10', 17),
(131, 'P003', 'avant-projetP003_1605852299.pdf', '2020-11-20 07:04:59', 17),
(132, 'P001', 'avant-projetP001_1605852550.pdf', '2020-11-20 07:09:10', 17),
(133, 'P001', 'bail-derogatoire-24moisP001_1605853821.pdf', '2020-11-20 07:30:21', 17),
(134, 'P001', 'bailP001_1605864649.pdf', '2020-11-20 10:30:49', 16),
(135, 'P001', 'bailP001_1605868600.pdf', '2020-11-20 11:36:40', 16),
(136, 'P001', 'bailP001_1605869245.pdf', '2020-11-20 11:47:25', 16),
(137, 'P001', 'bailP001_1605869423.pdf', '2020-11-20 11:50:23', 16),
(138, 'P001', 'bailP001_1605869690.pdf', '2020-11-20 11:54:50', 16),
(139, 'P001', 'bailP001_1605869744.pdf', '2020-11-20 11:55:44', 16),
(140, 'P001', 'bailP001_1605870087.pdf', '2020-11-20 12:01:27', 16),
(141, 'P001', 'bailP001_1605870127.pdf', '2020-11-20 12:02:07', 16),
(142, 'P001', 'bailP001_1605870225.pdf', '2020-11-20 12:03:45', 16),
(143, 'P001', 'bailP001_1605870250.pdf', '2020-11-20 12:04:10', 16),
(144, 'P001', 'bailP001_1605870290.pdf', '2020-11-20 12:04:50', 16),
(145, 'P001', 'bailP001_1605870443.pdf', '2020-11-20 12:07:23', 16),
(146, 'P001', 'bailP001_1605870704.pdf', '2020-11-20 12:11:44', 16),
(147, 'P001', 'bailP001_1605870822.pdf', '2020-11-20 12:13:42', 16),
(148, 'P001', 'bailP001_1605870906.pdf', '2020-11-20 12:15:06', 16),
(149, 'P001', 'bailP001_1605870909.pdf', '2020-11-20 12:15:09', 16),
(150, 'P001', 'bailP001_1605870972.pdf', '2020-11-20 12:16:12', 16),
(151, 'P001', 'bailP001_1605871008.pdf', '2020-11-20 12:16:48', 16),
(152, 'P001', 'bailP001_1605871332.pdf', '2020-11-20 12:22:12', 16),
(153, 'P001', 'bailP001_1605871435.pdf', '2020-11-20 12:23:55', 16),
(154, 'P001', 'bailP001_1605871571.pdf', '2020-11-20 12:26:11', 16),
(155, 'P001', 'bailP001_1605871669.pdf', '2020-11-20 12:27:49', 16),
(156, 'P001', 'bailP001_1605871730.pdf', '2020-11-20 12:28:50', 16),
(157, 'P001', 'bailP001_1605871758.pdf', '2020-11-20 12:29:18', 16),
(158, 'P001', 'bailP001_1605871793.pdf', '2020-11-20 12:29:53', 16),
(159, 'P001', 'bailP001_1605871871.pdf', '2020-11-20 12:31:11', 16),
(160, 'P001', 'bailP001_1605871874.pdf', '2020-11-20 12:31:14', 16),
(161, 'P001', 'bailP001_1605873043.pdf', '2020-11-20 12:50:43', 16),
(162, 'P001', 'bailP001_1605873155.pdf', '2020-11-20 12:52:35', 16),
(163, 'P001', 'bailP001_1605873335.pdf', '2020-11-20 12:55:35', 16),
(164, 'P001', 'attest-domP001_1605873444.pdf', '2020-11-20 12:57:24', 17),
(165, 'P001', 'bailP001_1605873450.pdf', '2020-11-20 12:57:30', 16),
(166, 'P001', 'bailP001_1605873544.pdf', '2020-11-20 12:59:04', 16),
(167, 'P001', 'bailP001_1605873631.pdf', '2020-11-20 13:00:31', 16),
(168, 'P001', 'bailP001_1605873670.pdf', '2020-11-20 13:01:10', 16),
(169, 'P001', 'bailP001_1605873699.pdf', '2020-11-20 13:01:39', 16),
(170, 'P001', 'bailP001_1605873851.pdf', '2020-11-20 13:04:11', 16),
(171, 'P001', 'bailP001_1605873914.pdf', '2020-11-20 13:05:14', 16),
(172, 'P001', 'bailP001_1605874030.pdf', '2020-11-20 13:07:10', 16),
(173, 'P001', 'bailP001_1605874102.pdf', '2020-11-20 13:08:22', 16),
(174, 'P001', 'bailP001_1605874423.pdf', '2020-11-20 13:13:43', 16),
(175, 'P001', 'bailP001_1605874651.pdf', '2020-11-20 13:17:31', 16),
(176, 'P001', 'bailP001_1605874791.pdf', '2020-11-20 13:19:51', 16),
(177, 'P001', 'bailP001_1605875286.pdf', '2020-11-20 13:28:06', 16),
(178, 'P001', 'bailP001_1605875408.pdf', '2020-11-20 13:30:08', 16),
(179, 'P001', 'bailP001_1605875448.pdf', '2020-11-20 13:30:48', 16),
(180, 'P003', 'bailP003_1605875633.pdf', '2020-11-20 13:33:53', 16),
(181, 'P003', 'bailP003_1605875786.pdf', '2020-11-20 13:36:26', 16),
(182, 'P003', 'bailP003_1605875787.pdf', '2020-11-20 13:36:27', 16),
(183, 'P003', 'bailP003_1605875817.pdf', '2020-11-20 13:36:57', 16),
(184, 'P003', 'bailP003_1605875879.pdf', '2020-11-20 13:37:59', 16),
(185, 'P003', 'bailP003_1605875950.pdf', '2020-11-20 13:39:10', 16),
(186, 'P003', 'bailP003_1605875986.pdf', '2020-11-20 13:39:46', 16),
(187, 'P003', 'bailP003_1605876374.pdf', '2020-11-20 13:46:14', 16),
(188, 'P003', 'bailP003_1605876413.pdf', '2020-11-20 13:46:53', 16),
(189, 'P003', 'bailP003_1605876455.pdf', '2020-11-20 13:47:35', 16),
(190, 'P003', 'bailP003_1605876900.pdf', '2020-11-20 13:55:00', 16),
(191, 'P003', 'bailP003_1605877157.pdf', '2020-11-20 13:59:17', 16),
(192, 'P003', 'bailP003_1605877196.pdf', '2020-11-20 13:59:56', 16),
(193, 'P003', 'bailP003_1605877295.pdf', '2020-11-20 14:01:35', 16),
(194, 'P003', 'bailP003_1605877368.pdf', '2020-11-20 14:02:48', 16),
(195, 'P003', 'bailP003_1605877459.pdf', '2020-11-20 14:04:19', 16),
(196, 'P003', 'bailP003_1605877524.pdf', '2020-11-20 14:05:24', 16),
(197, 'P003', 'bailP003_1605877583.pdf', '2020-11-20 14:06:23', 16),
(198, 'P003', 'bailP003_1605877661.pdf', '2020-11-20 14:07:41', 16),
(199, 'P003', 'bailP003_1605877711.pdf', '2020-11-20 14:08:31', 16),
(200, 'P003', 'bailP003_1605877758.pdf', '2020-11-20 14:09:18', 16),
(201, 'P003', 'bailP003_1605877799.pdf', '2020-11-20 14:09:59', 16),
(202, 'P001', 'attest-domP001_1605878523.pdf', '2020-11-20 14:22:03', 17),
(203, 'P001', 'avant-projetP001_1605878531.pdf', '2020-11-20 14:22:11', 17),
(204, 'P001', 'bail-derogatoire-12moisP001_1605878584.pdf', '2020-11-20 14:23:04', 16),
(205, 'P001', 'bail-derogatoire-24moisP001_1605878592.pdf', '2020-11-20 14:23:12', 16),
(206, 'P001', 'bailP001_1605878626.pdf', '2020-11-20 14:23:46', 16),
(207, 'P001', 'contrat-bureau-partP001_1605878629.pdf', '2020-11-20 14:23:49', 16),
(208, 'P001', 'contrat-domP001_1605878636.pdf', '2020-11-20 14:23:56', 17),
(209, 'P001', 'bailP001_1605956151.pdf', '2020-11-21 11:55:51', 16),
(210, 'P003', 'attest-domP003_1606110756.pdf', '2020-11-23 06:52:36', 17),
(211, 'P003', 'avant-projetP003_1606110899.pdf', '2020-11-23 06:54:59', 17),
(212, 'P003', 'bail-derogatoire-12moisP003_1606110911.pdf', '2020-11-23 06:55:11', 16),
(213, 'P003', 'bail-derogatoire-24moisP003_1606110925.pdf', '2020-11-23 06:55:25', 16),
(214, 'P003', 'bailP003_1606110937.pdf', '2020-11-23 06:55:37', 16),
(215, 'P003', 'contrat-bureau-partP003_1606110951.pdf', '2020-11-23 06:55:51', 16),
(216, 'P003', 'contrat-domP003_1606110971.pdf', '2020-11-23 06:56:11', 17),
(217, 'P002', 'liste_soucriptP002_1606117755.pdf', '2020-11-23 08:49:15', 17),
(218, 'P002', 'liste_soucriptP002_1606117895.pdf', '2020-11-23 08:51:35', 17),
(219, 'P002', 'liste_soucriptP002_1606124054.pdf', '2020-11-23 10:34:14', 17),
(220, 'P003', 'lettre_infoP003_1606146730.pdf', '2020-11-23 16:52:10', 17),
(221, 'P002', 'lettre_infoP002_1606146759.pdf', '2020-11-23 16:52:39', 17),
(222, 'P001', 'lettre_infoP001_1606146782.pdf', '2020-11-23 16:53:02', 17),
(223, 'P001', 'lettre_infoP001_1606146843.pdf', '2020-11-23 16:54:03', 17),
(224, 'P001', 'lettre_infoP001_1606206280.pdf', '2020-11-24 09:24:40', 17),
(225, 'P002', 'attest-domP002_1606712647.pdf', '2020-11-30 06:04:09', 17),
(226, 'P002', 'lettre_infoP002_1606716464.pdf', '2020-11-30 07:07:44', 17),
(227, 'P002', 'lettre_infoP002_1606716578.pdf', '2020-11-30 07:09:39', 17),
(228, 'P002', 'lettre_infoP002_1606716609.pdf', '2020-11-30 07:10:10', 17);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `associates`
--
ALTER TABLE `associates`
  ADD CONSTRAINT `associates_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `associates_ibfk_2` FOREIGN KEY (`societe_ref_prosp`) REFERENCES `societe` (`societe_ref_prosp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `connect`
--
ALTER TABLE `connect`
  ADD CONSTRAINT `connect_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `connect_ibfk_2` FOREIGN KEY (`societe_ref_prosp`) REFERENCES `societe` (`societe_ref_prosp`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`cust_status`) REFERENCES `cust_status` (`cust_status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_3` FOREIGN KEY (`societe_ref_prosp`) REFERENCES `societe` (`societe_ref_prosp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`presta_id`) REFERENCES `presta` (`prest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_3` FOREIGN KEY (`societe_ref_prosp`) REFERENCES `societe` (`societe_ref_prosp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `list_url`
--
ALTER TABLE `list_url`
  ADD CONSTRAINT `list_url_ibfk_1` FOREIGN KEY (`societe_ref_prosp`) REFERENCES `societe` (`societe_ref_prosp`);

--
-- Contraintes pour la table `societe`
--
ALTER TABLE `societe`
  ADD CONSTRAINT `societe_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `societe_ibfk_4` FOREIGN KEY (`ref_int_local`) REFERENCES `local` (`ref_int_local`),
  ADD CONSTRAINT `societe_ibfk_5` FOREIGN KEY (`lease_term_id`) REFERENCES `lease_term` (`lease_term_id`);

--
-- Contraintes pour la table `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `upload_ibfk_1` FOREIGN KEY (`societe_ref_prosp`) REFERENCES `societe` (`societe_ref_prosp`),
  ADD CONSTRAINT `upload_ibfk_2` FOREIGN KEY (`upload_doctype_id`) REFERENCES `doctype` (`doctype_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
