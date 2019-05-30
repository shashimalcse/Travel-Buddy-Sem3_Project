-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2019 at 12:13 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `user_id`, `name`, `address`, `telephone_number`, `detail`, `lat`, `lng`) VALUES
(1, 21, 'green villa', 'bangkok, keththapahuwa', '1212121212', '3 rooms', '7.572391941905075', '80.29470245705807');

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

--
-- Dumping data for table `remembered_logins`
--

INSERT INTO `remembered_logins` (`token_hash`, `user_id`, `expires_at`) VALUES
('15b55edf251208993f37fc2ee58395e9224d9adba77a4cbba754f7946cdd4c0d', 9, '2019-06-21');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `password_reset_hash`, `password_reset_expires_at`, `activation_hash`, `is_active`) VALUES
(20, 'shashimal', 'shashimalsenarath.17@cse.mrt.ac.lk', '$2y$10$.rX/HplGz5mNSM/QidJCP.Cout4kA8knLBLqOE8cZHWmG9o7O2ID.', '82136ee96a771ce23d53bdca262c67f999d78c2643fcb5ba2bccfd2e2415639c', '2019-05-23 08:34:45', NULL, 1),
(21, 'jayampthi', 'jayampathiadhikari@gmail.com', '$2y$10$X8gEG1GKt9yCIXJRb7QEh.VT3Kti/wlRmlLtuA0PdsUuiXtngjJpq', NULL, NULL, NULL, 1),
(22, 'shashimal senarath', 'shashimalsenarathz97@gmail.com', '$2y$10$8OqIVR4lQSmqiXfNwiHA5Og8SJ7eZdZWsvmph2zDDdSxOX94d.EZS', 'a6e6f54966365b0ac2cc515d8183d384304bca0543297097680955c6044e934a', '2019-05-25 19:52:32', NULL, 1);

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
  `vehical_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `vehical_model` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `detail` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lat` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lng` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehical`
--

INSERT INTO `vehical` (`id`, `user_id`, `name`, `address`, `telephone_number`, `vehical_type`, `vehical_model`, `detail`, `lat`, `lng`) VALUES
(23, 20, 'qqqqq', 'qqqqq', '1212121212', 'Van', '11111', '11111', '6.9580915999999995', '79.9248669'),
(32, 21, 'adikari', '2323', '01021212121', 'SUV', '1212121212', '11111111', '6.901608599999999', '80.0087746'),
(35, 22, 'ydy', 'kjwgdiaw', '11111111111', 'Car', '12', '121', '6.796905700000001', '79.9004952');

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
