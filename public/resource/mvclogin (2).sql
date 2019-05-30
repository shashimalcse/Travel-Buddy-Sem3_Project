-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2019 at 06:33 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guider`
--

INSERT INTO `guider` (`id`, `user_id`, `name`, `address`, `telephone_number`, `days`, `detail`, `lat`, `lng`) VALUES
(7, 26, 'Jayaz', 'bangkok, keththapahuwa', '1212121212', '2 Days', 'Hello', '6.7964917', '79.9006062'),
(8, 29, 'Milan Iranga', 'Udayandana,Kurunegala', '0756745654', '2 Days', 'I love to travel any where you want. i have many experiences in sri lanka travel ', '6.901608599999999', '80.0087746'),
(9, 29, 'Kusal Prabath', 'Anamaduwa ,puththalama', '0785645321', 'More Days', 'If you want to travel in any place in sri lanaka call me. i know upcountry travel places', '6.901608599999999', '80.0087746'),
(10, 29, 'Udesha Herath', 'koneshwarama, thrincomalee', '0785643213', '1 Day', 'i love to travel with boys. if any boy interested in travel in trincomalee call me. i will help you to get a better happy moments', '6.901608599999999', '80.0087746');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `user_id`, `name`, `address`, `telephone_number`, `detail`, `lat`, `lng`) VALUES
(8, 26, 'Blue Sky', 'bangkok, keththapahuwa', '1212121212', 'Five star', '8.340737751766595', '80.40507529719639'),
(9, 29, 'Kavindu Hotel', 'kavindu villa , Nuwaraeliya', '0714534123', 'Five star hotel \r\nAc rooms', '6.901608599999999', '80.0087746'),
(10, 29, 'Kandalama Hotel', 'nuwarakalawa,kandy', '0376545234', '7 star \r\nAC rooms\r\nswimming pools\r\nplay grounds', '6.901608599999999', '80.0087746');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_rating`
--

DROP TABLE IF EXISTS `hotel_rating`;
CREATE TABLE IF NOT EXISTS `hotel_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) NOT NULL DEFAULT '-1',
  `user_id` int(11) NOT NULL DEFAULT '-1',
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel_rating`
--

INSERT INTO `hotel_rating` (`id`, `hotel_id`, `user_id`, `rating`) VALUES
(4, 8, 26, 3),
(5, 9, 29, 5),
(6, 8, 29, 4);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `description`) VALUES
(34, 'Sigiriya', 'Sigiriya is one of the most valuable historical monuments of Sri Lanka.Referred by locals as the Eighth Wonder of the World this ancient palace and fortress complex has significant archaeological importance and attracts thousands of tourists every year. It is probably the most visited tourist destination of Sri Lanka.The palace is located in the heart of the island between the towns of Dambulla and Habarane on a massive rocky plateau 370 meters above the sea level.  Sigiriya rock plateau, formed from magma of an extinct volcano, is 200 meters higher than the surrounding jungles.'),
(35, 'The Pinnawala Elephant Orphanage', 'The Pinnawala Elephant Orphanage is situated northwest of the town of Kegalle, halfway between the present capital Colombo and the ancient royal residence Kandy. It was established in 1975 by the Sri Lanka Wildlife Department in a 25 acre coconut property adjoining the Maha Oya River. The orphanage was originally founded in order to afford care and protection to the many orphaned Elephants found in the jungles of Sri Lanka.'),
(36, 'Ella Sri Lanka', 'Ella, often described as ‘’lonely planet’’ and ‘’waterfall’’ is a congested town located in Sri Lanka. Ella is pure natural beauty, with its waterfalls, greenery, and hills it is just jaw-dropping. It has views that one hasn’t witnessed before, scenes one hasn\'t seen before and nature one hasn\'t felt before. Ella is the perfect place to go to if one wants to refresh the brain. It has many famous places and has been under the attention of tourist for a decent amount of time now.'),
(37, 'Welcome To Polonnaruwa', 'Kings ruled the central plains of Sri Lanka from Polonnaruwa 800 years ago, when it was a thriving commercial and religious centre. The glories of that age can be found in the archaeological treasures that still give a pretty good idea of how the city looked in its heyday. You\'ll find the archaeological park a delight to explore, with hundreds of ancient structures – tombs and temples, statues and stupas – in a compact core. The Quadrangle alone is worth the trip.');

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
('324ac63f565a03aef44c01fe49f1bd55aeaeb3b12198b06c5d2fc0e33885c242', 29, '2019-06-28');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `user_id`, `name`, `address`, `telephone_number`, `shop_type`, `detail`, `lat`, `lng`) VALUES
(5, 26, 'Sysco', 'bangkok, keththapahuwa', '1212121212', 'Dresspoint', 'cheap clothes', '7.2488257922198285', '79.95821925421842'),
(6, 29, 'Gayan Beer Shop', 'Athawatunapitiya,Henamulla,Kurunegala', '0774747527', 'Liquor shop', 'Excellent services\r\nAny Liquor ', '7.487069390861869', '80.364990234375'),
(7, 29, 'Basnayaka Grocery', 'Wellawa,rangama,Kurunagala', '0765434256', 'Grocery', 'Fresh Vegetables\r\nNew Items\r\nGood Price ', '7.561490763495652', '80.3646980881233');

-- --------------------------------------------------------

--
-- Table structure for table `shop_rating`
--

DROP TABLE IF EXISTS `shop_rating`;
CREATE TABLE IF NOT EXISTS `shop_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_rating`
--

INSERT INTO `shop_rating` (`id`, `shop_id`, `user_id`, `rating`) VALUES
(1, 5, 26, 3),
(2, 7, 29, 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `password_reset_hash`, `password_reset_expires_at`, `activation_hash`, `is_active`) VALUES
(26, 'jayaz', 'jayampathiadhikari@gmail.com', '$2y$10$lxf9xbB1qEt..sRlWRRtp.G1KcJaaejrWAdg/lSoqPhIstC4KN44K', NULL, NULL, NULL, 1),
(29, 'shashimalz', 'shashimalsenarath.17@cse.mrt.ac.lk', '$2y$10$0gElA5TPK/5L8tx6id.zLOK0x9UHOADb18d4tgONJ1MI9PfGh2vKq', NULL, NULL, NULL, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehical`
--

INSERT INTO `vehical` (`id`, `user_id`, `name`, `address`, `telephone_number`, `have`, `lat`, `lng`) VALUES
(44, 26, 'Jayaz', 'bangkok, keththapahuwa', '1212121212', 1, '6.7964899', '79.9006029'),
(45, 29, 'Devinda Super Service', 'babarapitiya,Ampara', '0706756432', 1, '6.901608599999999', '80.0087746');

-- --------------------------------------------------------

--
-- Table structure for table `vehicalshop_rating`
--

DROP TABLE IF EXISTS `vehicalshop_rating`;
CREATE TABLE IF NOT EXISTS `vehicalshop_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicalshop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicalshop_rating`
--

INSERT INTO `vehicalshop_rating` (`id`, `vehicalshop_id`, `user_id`, `rating`) VALUES
(1, 44, 26, 4),
(2, 45, 29, 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehical_list`
--

INSERT INTO `vehical_list` (`id`, `user_id`, `vehical_type`, `vehical_model`, `ac`, `cost`, `detail`) VALUES
(7, 26, 'Car', 'Honda', 'Yes', '120', 'Very good condition'),
(8, 26, 'SUV', 'Toyota', 'Yes', '200', 'Very good condition'),
(9, 29, 'Car', 'Honda FIT', 'Yes', 'RS.100', 'Good Condition\r\nFully comfortable\r\n4 seats ');

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
