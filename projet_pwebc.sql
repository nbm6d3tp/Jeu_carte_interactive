-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2022 at 07:12 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_pwebc`
--

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

DROP TABLE IF EXISTS `relations`;
CREATE TABLE IF NOT EXISTS `relations` (
  `id` int(11) NOT NULL,
  `id_ami` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_ami`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`id`, `id_ami`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 1),
(3, 2),
(3, 4),
(3, 5),
(3, 6),
(4, 1),
(4, 2),
(4, 3),
(4, 5),
(4, 6),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 6),
(6, 1),
(6, 2),
(6, 3),
(6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `latitude` decimal(10,8) NOT NULL DEFAULT '48.84398080',
  `longitude` decimal(10,8) NOT NULL DEFAULT '2.31342080',
  `resutat_mode1` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `name`, `username`, `password`, `latitude`, `longitude`, `resutat_mode1`) VALUES
(1, 'Minh', 'minh1612', '7c222fb2927d828af22f592134e8932480637c0d', '45.33000600', '2.89669300', NULL),
(2, 'Hanpy', 'hanpy123', '7c222fb2927d828af22f592134e8932480637c0d', '45.33450300', '2.85925400', NULL),
(3, 'Louna', 'louna123', '6dee019c277b4139cdd2a8fd69d6a9d241fc896c', '46.51095500', '0.57579200', NULL),
(4, 'Hello', 'hello123', '7c222fb2927d828af22f592134e8932480637c0d', '47.21099400', '1.52366700', NULL),
(5, 'Giovanny', 'giovany123', '7c222fb2927d828af22f592134e8932480637c0d', '48.76416592', '2.40429696', NULL),
(6, 'Coucou', 'coucou123', '7c222fb2927d828af22f592134e8932480637c0d', '48.75325100', '2.97907900', NULL),
(7, 'Dupond', 'dupond123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84398080', '2.31342080', NULL),
(8, 'Brette', 'brette123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84162270', '2.26924009', NULL),
(9, 'Hanpy', 'hanpy123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84216266', '2.26796045', NULL),
(10, 'Bonjour', 'bonjour123', '7c222fb2927d828af22f592134e8932480637c0d', '48.77131900', '3.19813800', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
