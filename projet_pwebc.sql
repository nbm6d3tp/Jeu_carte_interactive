-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2022 at 12:58 PM
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
-- Table structure for table `histoire`
--

DROP TABLE IF EXISTS `histoire`;
CREATE TABLE IF NOT EXISTS `histoire` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `res` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histoire`
--

INSERT INTO `histoire` (`id`, `id_user`, `res`, `date`) VALUES
(1, 5, 500, '2022-03-15 16:44:33'),
(2, 5, 451, '2022-03-15 16:45:52'),
(3, 3, 300, '2022-03-16 19:38:32'),
(4, 2, 100, '2022-03-13 19:38:52'),
(5, 6, 50, '2022-03-06 19:38:52'),
(6, 10, 60, '2022-03-16 19:38:52'),
(7, 7, 55, '2022-03-10 19:38:52'),
(8, 6, 70, '2022-03-13 19:38:52'),
(9, 11, 351, '2022-03-15 21:27:03'),
(10, 5, 435, '2022-03-17 09:59:18'),
(11, 12, 409, '2022-03-17 11:28:53'),
(12, 11, 741, '2022-03-17 11:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `objets`
--

DROP TABLE IF EXISTS `objets`;
CREATE TABLE IF NOT EXISTS `objets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `origine` varchar(20) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `objets`
--

INSERT INTO `objets` (`id`, `name`, `origine`, `image`) VALUES
(1, 'Sushi', 'Japan', 'Sushi.jpg'),
(2, 'Dior', 'France', 'Dior.png'),
(3, 'Taco', 'Mexico', 'Taco.jpg'),
(4, 'Nem', 'Vietnam', 'Nem.jpg'),
(5, 'Dumpling', 'China', 'Dumpling.jpg'),
(6, 'Samsung', 'South-Korea', 'Samsung.png'),
(9, 'Eiffel', 'France', 'Eiffel.jpg'),
(8, 'Pho', 'Vietnam', 'Pho.jpg'),
(10, 'YSL', 'France', 'YSL.png'),
(11, 'Kimono', 'Japan', 'Kimono.png'),
(12, 'Bigben', 'United-Kingdom', 'Bigben.jpg'),
(13, 'Kimchi', 'South-Korea', 'Kimchi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `objets_descript`
--

DROP TABLE IF EXISTS `objets_descript`;
CREATE TABLE IF NOT EXISTS `objets_descript` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `objets_descript`
--

INSERT INTO `objets_descript` (`id`, `description`) VALUES
(1, 'Sushi is a traditional Japanese dish of prepared vinegared rice, usually with some sugar and salt, accompanied by a variety of ingredients, such as seafood, often raw, and vegetables. Styles of sushi and its presentation vary widely, but the one key ingredient is \"sushi rice\", also referred to as shari, or sumeshi.[1] '),
(2, 'Is a famous French luxury fashion company and brand controlled and operated by billionaire Bernard Arnault, who is also the head of the world\'s largest LVMH brand group. Dior holds 42.36% shares and 59.01% voting rights in LVMH by itself'),
(3, 'A taco is a traditional Mexican dish consisting of a small hand-sized corn or wheat tortilla topped with a filling. The tortilla is then folded around the filling and eaten by hand. A taco can be made with a variety of fillings, including beef, pork, chicken, seafood, beans, vegetables, and cheese, allowing for great versatility and variety.'),
(4, 'Cha gio, or Nem(see also egg rolls), also known as fried spring roll, is a popular dish in Vietnamese cuisine and usually served as an appetizer in Europe and North America, where there are large Vietnamese diaspora. It is ground meat, usually pork, wrapped in rice paper and deep-fried.'),
(5, 'Dumpling is a broad class of dishes that consist of pieces of dough (made from a variety of starch sources) wrapped around a filling, or of dough with no filling. The dough can be based on bread, flour, buckwheat or potatoes, and may be filled with meat, fish, tofu, cheese, vegetables, fruits or sweets.'),
(6, 'The Samsung Group(or simply Samsung, stylized in logo as SAMSUNG) is a South Korean multinational manufacturing conglomerate headquartered in Samsung Town, Seoul, South Korea. It comprises numerous affiliated businesses,[1] most of them united under the Samsung brand, and is the largest South Korean chaebol (business conglomerate). As of 2020, Samsung has the 8th highest global brand value'),
(9, 'The Eiffel Tower is a wrought-iron lattice tower on the Champ de Mars in Paris, France. It is named after the engineer Gustave Eiffel, whose company designed and built the tower. '),
(8, 'Pho is a Vietnamese soup dish consisting of broth, rice noodles, herbs, and meat (usually beef, sometimes chicken). Pho is a popular food in Vietnam where it is served in households, street stalls and restaurants countrywide. Pho is considered Vietnam\'s national dish.'),
(10, 'Yves Saint Laurent, also known as Saint Laurent,[3] is a French luxury fashion house founded by Yves Saint Laurent and his partner, Pierre Bergé. The company revived its haute couture collection in 2015 under former Creative Director Hedi Slimane. In April 2016, Anthony Vaccarello was appointed as creative director.'),
(11, 'The kimono is a traditional Japanese garment and the national dress of Japan. The kimono is a T-shaped, wrapped-front garment with square sleeves and a rectangular body, and is worn left side wrapped over right, unless the wearer is deceased. The kimono is traditionally worn with a broad sash, called an obi, and is commonly worn with accessories such as sandals and tabi socks'),
(12, 'Big Ben is the nickname for the Great Bell of the striking clock at the north end of the Palace of Westminster in London, England, although the name is frequently extended to refer also to the clock and the clock tower.The official name of the tower in which Big Ben is located was originally the Clock Tower, but it was renamed Elizabeth Tower in 2012, to mark the Diamond Jubilee of Elizabeth II.'),
(13, 'Kimchi is a traditional Korean side dish of salted and fermented vegetables, such as napa cabbage and Korean radish. A wide selection of seasonings are used, including gochugaru (Korean chili powder), spring onions, garlic, ginger, and jeotgal (salted seafood), etc. Kimchi is also used in a variety of soups and stews. As a staple food in Korean cuisine, it is eaten as a side dish with almost every Korean meal.');

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
(5, 2),
(5, 4),
(5, 7),
(5, 8),
(5, 10),
(5, 11),
(6, 1),
(6, 2),
(6, 3),
(6, 5),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(10, 7),
(11, 1),
(11, 4),
(11, 5),
(11, 6),
(11, 9),
(12, 2),
(12, 4),
(12, 5),
(12, 8);

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
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `name`, `username`, `password`, `latitude`, `longitude`) VALUES
(1, 'Minh', 'minh1612', '7c222fb2927d828af22f592134e8932480637c0d', '45.33000600', '2.89669300'),
(2, 'Hanpy', 'hanpy123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84223690', '2.26800863'),
(3, 'Louna', 'louna123', '6dee019c277b4139cdd2a8fd69d6a9d241fc896c', '46.51095500', '0.57579200'),
(4, 'Hello', 'hello123', '7c222fb2927d828af22f592134e8932480637c0d', '47.21099400', '1.52366700'),
(5, 'Giovanny', 'giovany123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84221698', '2.26800633'),
(6, 'Coucou', 'coucou123', '7c222fb2927d828af22f592134e8932480637c0d', '48.75325100', '2.97907900'),
(7, 'Dupond', 'dupond123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84398080', '2.31342080'),
(8, 'Brette', 'brette123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84162270', '2.26924009'),
(9, 'Hanpy', 'hanpy123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84216266', '2.26796045'),
(10, 'Bonjour', 'bonjour123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84224635', '2.26801506'),
(11, 'Chau', 'chau123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84221440', '2.26800926'),
(12, 'Mathis', 'mathis123', '7c222fb2927d828af22f592134e8932480637c0d', '48.84221588', '2.26800499');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
