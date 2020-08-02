-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 17, 2020 at 03:59 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estoevent`
--

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `ID_Departement` int(11) NOT NULL AUTO_INCREMENT,
  `nomDept` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`ID_Departement`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`ID_Departement`, `nomDept`) VALUES
(1, 'genie informatique'),
(2, 'genie applique'),
(3, 'management');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ID_Etudiant` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(55) DEFAULT NULL,
  `nomEtud` varchar(30) DEFAULT NULL,
  `prenomEtud` varchar(20) DEFAULT NULL,
  `motDePasse` varchar(128) DEFAULT NULL,
  `verifiedEmail` tinyint(1) DEFAULT NULL,
  `vkey` varchar(55) NOT NULL,
  PRIMARY KEY (`ID_Etudiant`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`ID_Etudiant`, `Email`, `nomEtud`, `prenomEtud`, `motDePasse`, `verifiedEmail`, `vkey`) VALUES
(9, 'ayman.makhoukhi@gmail.com', 'Makhoukhi', 'Ayman', '2d298b6ad28cd9710d7d0679f2b39c300a59f8c5d81620f251700d456a2d28e79039de35a5fda00e6d68bfdf06582355f60744bd333874ef46ae04a0991c25ad', 0, '005db65c7927b0ad41a165cd53e45c75');

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `ID_Evenement` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Professeur` int(11) NOT NULL,
  `ID_Departement` int(11) NOT NULL,
  `sujetEvent` varchar(55) NOT NULL,
  `descriptionEvent` text NOT NULL,
  `photoEvent` varchar(55) NOT NULL,
  `dateDebut` varchar(55) NOT NULL,
  `dateFin` varchar(55) NOT NULL,
  PRIMARY KEY (`ID_Evenement`),
  KEY `FK_ORGANISER` (`ID_Professeur`),
  KEY `FK_PLANIFIER` (`ID_Departement`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`ID_Evenement`, `ID_Professeur`, `ID_Departement`, `sujetEvent`, `descriptionEvent`, `photoEvent`, `dateDebut`, `dateFin`) VALUES
(2, 10, 3, 'JournÃ©e Portes Ouvertes avec la BANQUE POPULAIRE', 'Le club Biz Squad a organisÃ© une journÃ©e portes ouvertes avec la banque populaire pour faire connaÃ®tre le programme INTELAKA qui accompagne les jeunes entrepreneurs porteurs dâ€™idÃ©es en finanÃ§ant leurs entreprise.', 'JournÃ©e_Portes_Ouvertes_avec_la_BANQUE_POPULAIRE.jpeg', '11-03-2021 10:00', '13-03-2021 05:30'),
(3, 15, 1, 'JOURNÃ‰E DÃ‰COUVERTE ENACTUS', 'Cette journÃ©e Ã  Ã©tÃ© conÃ§ue par le club Enactus Est Oujda dans le but de rassembler les jeunes Ã©tudiants de l\'ESTO pour leur faire dÃ©couvrir le club ainsi que l\'entreprenariat\r\nen gÃ©nÃ©ral et ainsi les motiver et rejoindre l\'aventure pour faire partie d\'une belle famille qui est ENACTUS EST OUJDA. Quâ€™est ce que vous attendez? RÃ©servez votre place pour le 26 Novembre Ã  9H Ã  l\'amphithÃ©Ã¢tre C.', 'JOURNÃ‰E_DÃ‰COUVERTE_ENACTUS.png', '26-02-2021 09:00', '26-02-2021 11:00'),
(4, 15, 1, 'Manchester City VS Real Madrid Champion League', 'le club Enactus Est Oujda vous offre une offre incroyable, vous pouvez venir ici Ã  ESTO et regarder le match Ã©clairÃ© du retour du Real Madrid et de Manchester City en being sport d\'une qualitÃ© incroyable et n\'oublions pas la surprise de Lkorssa que le gagnant de la tombola va obtenir, obtenez votre ticket pour seulement 5DHs et rÃ©servez votre place pour le 17 Mars Ã  21H Ã  l\'amphi A.', 'Manchester_City_VS_Real_Madrid_Champion_League.jpg', '17-03-2021 09:00', '17-03-2021 11:00'),
(11, 10, 3, 'JournÃ©e des femmes', 'Câ€™est avec un Ã©norme honneur de le bureau des Ã©tudiant Ã  organiser  un aprÃ¨s-midi pour cÃ©lÃ©brer la femme sous le thÃ¨me Â«Â fÃ©ministe de toutes nos forceÂ Â» en lâ€™occasion de la journÃ©e internationale des droit de la femme, un aprÃ¨s-midi oÃ¹ cette derniÃ¨re Ã©tÃ© Ã  lâ€™honneur, avec plusieurs jeux, des discours et aussi des fleurs et des cadeaux offers, tout une ambiance chaleureuse et conviviale pour ce jours spÃ©cial', 'JournÃ©e_des_femmes.jpeg', '06-03-2021 03:00', '06-03-2021 05:30');

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `ID_Evenement` int(11) NOT NULL,
  `ID_Etudiant` int(11) NOT NULL,
  `inscris` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_Evenement`,`ID_Etudiant`),
  KEY `ID_Etudiant` (`ID_Etudiant`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `ID_Professeur` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Departement` int(11) NOT NULL,
  `nomProf` varchar(30) DEFAULT NULL,
  `prenomProf` varchar(20) DEFAULT NULL,
  `Discipline` varchar(30) DEFAULT NULL,
  `motDePasse` varchar(128) DEFAULT NULL,
  `photoProf` varchar(255) DEFAULT NULL,
  `verifiedEmail` tinyint(1) NOT NULL,
  `vkey` varchar(55) NOT NULL,
  PRIMARY KEY (`ID_Professeur`),
  KEY `FK_APPARTENIR` (`ID_Departement`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professeur`
--

INSERT INTO `professeur` (`ID_Professeur`, `ID_Departement`, `nomProf`, `prenomProf`, `Discipline`, `motDePasse`, `photoProf`, `verifiedEmail`, `vkey`) VALUES
(10, 1, 'Korikache', 'RÃ©da', 'Professeur', 'f6ab520cdebf4664aa1ce1519d6989d43e56bb314c1a43ab9bcbe5ebbfdfbe2ce6b6c111b787b8c6631cf4972c74b4ecd56011a6d8f0df46b82d8c29ec650a11', 'KorikacheRÃ©daProfil.png', 0, 'safd56asdf5dsf5as5f55sdaf5ds5as6dd'),
(16, 1, 'Boudlal', 'Ftih', 'Professeur', 'bb3d0f6d138b41458ea032b21c52e8a1f69db14c493d5347621091e2eeecaf38f98a00224b3fd5d3aac0eea29eb76a457df8f0d50e186754fc88c64775bb2766', 'FatihaBoudlalProfil.png', 0, '3312a22693d85de82c2374ca84f99d98'),
(15, 1, 'Kodad', 'Mohcine', 'Professeur', '928cdd81e90bcd47e429fed6131f9c06c9248e76113afee469a5608300303a2464d7e5ac20240777405fa9d077bd6583039b7c3d4e25f0d42b290fcc0e67ae76', 'MohcineKodadProfil.png', 0, 'caad8f0f700ccc327a272eb2865c90e3'),
(17, 1, 'Grari', 'Mouniiir', 'Professeur', '38f26b9a53a410fbc603b96a8d92a0adc8f2a6efcc4dd2c3a70d8a881a5509a672aa06cdc9929e5234221385242aa933c57136193f84edfb985f2473a183dcd7', 'MounirGrariProfil.gif', 0, '3cc9f26a2def5541a949fcf6201c9996');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
