-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2019 at 02:15 PM
-- Server version: 8.0.15
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvclogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `guider`
--

DROP TABLE IF EXISTS `guider`;
CREATE TABLE IF NOT EXISTS `guider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone_number` varchar(20) NOT NULL,
  `days` text NOT NULL,
  `detail` varchar(1000) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guider`
--

INSERT INTO `guider` (`id`, `user_id`, `name`, `address`, `telephone_number`, `days`, `detail`, `lat`, `lng`) VALUES
(2, 23, 'Shashimal Senarath', 'bangkok, keththapahuwa', '1212121212', '2 Days', '1212', '6.901608599999999', '80.0087746');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `detail` varchar(1000) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `user_id`, `name`, `address`, `telephone_number`, `detail`, `lat`, `lng`) VALUES
(5, 23, 'Blue Sky', 'bangkok, keththapahuwa', '1212121212', '1212', '6.901608599999999', '80.0087746');

-- --------------------------------------------------------

--
-- Table structure for table `remembered_logins`
--

DROP TABLE IF EXISTS `remembered_logins`;
CREATE TABLE IF NOT EXISTS `remembered_logins` (
  `token_hash` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expires_at` date NOT NULL,
  PRIMARY KEY (`token_hash`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE IF NOT EXISTS `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone_number` varchar(20) NOT NULL,
  `shop_type` varchar(20) NOT NULL,
  `detail` varchar(1000) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `user_id`, `name`, `address`, `telephone_number`, `shop_type`, `detail`, `lat`, `lng`) VALUES
(3, 23, 'Bassa Grocery', 'bangkok, keththapahuwa', '1212121212', 'Liquor shop', '12', '6.901608599999999', '80.0087746');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_hash` varchar(64) DEFAULT NULL,
  `password_reset_expires_at` datetime DEFAULT NULL,
  `activation_hash` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_hash` (`password_reset_hash`),
  UNIQUE KEY `activation_has` (`activation_hash`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `password_reset_hash`, `password_reset_expires_at`, `activation_hash`, `is_active`) VALUES
(23, 'shashimal senarath', 'shashimalsenarathz97@gmail.com', '$2y$10$FiSO.pXdsWhjsqUqr.gQy.2M9pYQ3VHsL2kLdt/2EYQycz8KaIwIG', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehical`
--

DROP TABLE IF EXISTS `vehical`;
CREATE TABLE IF NOT EXISTS `vehical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone_number` varchar(20) NOT NULL,
  `have` tinyint(1) NOT NULL DEFAULT '0',
  `lat` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lng` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehical`
--

INSERT INTO `vehical` (`id`, `user_id`, `name`, `address`, `telephone_number`, `have`, `lat`, `lng`) VALUES
(40, 23, 'Shashimal Service', 'bangkok, keththapahuwa', '1212121212', 1, '6.901608599999999', '80.0087746');

-- --------------------------------------------------------

--
-- Table structure for table `vehical_list`
--

DROP TABLE IF EXISTS `vehical_list`;
CREATE TABLE IF NOT EXISTS `vehical_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vehical_type` varchar(255) NOT NULL,
  `vehical_model` varchar(255) NOT NULL,
  `ac` varchar(10) NOT NULL,
  `cost` varchar(11) NOT NULL,
  `detail` varchar(1000) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehical_list`
--

INSERT INTO `vehical_list` (`id`, `user_id`, `vehical_type`, `vehical_model`, `ac`, `cost`, `detail`) VALUES
(2, 22, 'Car', '12', 'Yes', '12', ''),
(3, 23, 'Car', '12', 'Yes', '12', 'hi fren');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guider`
--
ALTER TABLE `guider`
  ADD CONSTRAINT `guider_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `vehical`
--
ALTER TABLE `vehical`
  ADD CONSTRAINT `vehical_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
