-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 26, 2023 at 02:33 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gwsc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `pitch_id` int(11) DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `booking_date` date NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `user_id` (`user_id`),
  KEY `site_id` (`site_id`),
  KEY `pitch_id` (`pitch_id`),
  KEY `slot_id` (`slot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `camping_pitches`
--

DROP TABLE IF EXISTS `camping_pitches`;
CREATE TABLE IF NOT EXISTS `camping_pitches` (
  `pitch_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `pitch_type_id` int(11) NOT NULL,
  `pitch_date` date NOT NULL,
  `pitch_capacity` int(11) NOT NULL,
  `pitch_availability` int(11) NOT NULL,
  PRIMARY KEY (`pitch_id`),
  KEY `site_id` (`site_id`),
  KEY `pitch_type_id` (`pitch_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2197 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `camping_pitches`
--

INSERT INTO `camping_pitches` (`pitch_id`, `site_id`, `pitch_type_id`, `pitch_date`, `pitch_capacity`, `pitch_availability`) VALUES
(1, 6, 3, '2023-06-01', 15, 13),
(2, 3, 3, '2023-06-02', 11, 6),
(3, 6, 2, '2023-06-03', 6, 6),
(4, 3, 2, '2023-06-04', 10, 8),
(5, 3, 2, '2023-06-05', 11, 3),
(6, 5, 3, '2023-06-06', 11, 1),
(7, 5, 1, '2023-06-07', 15, 7),
(8, 2, 2, '2023-06-08', 13, 1),
(9, 3, 3, '2023-06-09', 12, 6),
(10, 1, 3, '2023-06-10', 9, 2),
(11, 1, 2, '2023-06-11', 11, 3),
(12, 1, 1, '2023-06-12', 12, 0),
(13, 2, 2, '2023-06-13', 7, 4),
(14, 5, 3, '2023-06-14', 14, 11),
(15, 6, 1, '2023-06-15', 7, 0),
(16, 5, 3, '2023-06-16', 10, 6),
(17, 1, 1, '2023-06-17', 7, 6),
(18, 6, 2, '2023-06-18', 15, 3),
(19, 3, 3, '2023-06-19', 7, 2),
(20, 4, 2, '2023-06-20', 15, 10),
(21, 2, 2, '2023-06-21', 12, 0),
(22, 5, 3, '2023-06-22', 14, 12),
(23, 1, 1, '2023-06-23', 7, 7),
(24, 6, 3, '2023-06-24', 8, 8),
(25, 1, 2, '2023-06-25', 7, 7),
(26, 2, 3, '2023-06-26', 8, 7),
(27, 5, 2, '2023-06-27', 12, 8),
(28, 1, 2, '2023-06-28', 10, 1),
(29, 2, 2, '2023-06-29', 8, 7),
(30, 1, 2, '2023-06-30', 14, 4),
(31, 5, 2, '2023-07-01', 7, 4),
(32, 2, 3, '2023-07-02', 15, 7),
(33, 6, 1, '2023-07-03', 14, 14),
(34, 2, 1, '2023-07-04', 11, 10),
(35, 2, 3, '2023-07-05', 13, 11),
(36, 4, 1, '2023-07-06', 13, 7),
(37, 3, 2, '2023-07-07', 10, 5),
(38, 2, 3, '2023-07-08', 7, 1),
(39, 2, 3, '2023-07-09', 9, 6),
(40, 1, 2, '2023-07-10', 6, 6),
(41, 4, 3, '2023-07-11', 7, 4),
(42, 5, 1, '2023-07-12', 14, 5),
(43, 6, 2, '2023-07-13', 11, 9),
(44, 5, 3, '2023-07-14', 9, 5),
(45, 6, 1, '2023-07-15', 12, 9),
(46, 6, 3, '2023-07-16', 8, 7),
(47, 1, 2, '2023-07-17', 8, 8),
(48, 6, 3, '2023-07-18', 14, 1),
(49, 3, 1, '2023-07-19', 13, 0),
(50, 2, 1, '2023-07-20', 15, 9),
(51, 4, 3, '2023-07-21', 8, 1),
(52, 4, 3, '2023-07-22', 10, 2),
(53, 3, 2, '2023-07-23', 15, 10),
(54, 5, 1, '2023-07-24', 14, 9),
(55, 5, 1, '2023-07-25', 11, 10),
(56, 4, 1, '2023-07-26', 7, 2),
(57, 3, 3, '2023-07-27', 12, 0),
(58, 4, 1, '2023-07-28', 10, 5),
(59, 2, 1, '2023-07-29', 12, 2),
(60, 6, 2, '2023-07-30', 14, 4),
(61, 6, 2, '2023-07-31', 6, 0),
(62, 4, 2, '2023-08-01', 7, 0),
(63, 2, 2, '2023-08-02', 8, 0),
(64, 3, 2, '2023-08-03', 14, 6),
(65, 4, 1, '2023-08-04', 10, 10),
(66, 5, 3, '2023-08-05', 8, 8),
(67, 5, 3, '2023-08-06', 7, 1),
(68, 2, 2, '2023-08-07', 14, 4),
(69, 2, 3, '2023-08-08', 10, 6),
(70, 4, 2, '2023-08-09', 9, 5),
(71, 6, 1, '2023-08-10', 14, 3),
(72, 4, 3, '2023-08-11', 14, 7),
(73, 5, 1, '2023-08-12', 8, 4),
(74, 5, 3, '2023-08-13', 6, 3),
(75, 2, 1, '2023-08-14', 9, 8),
(76, 2, 2, '2023-08-15', 7, 3),
(77, 5, 2, '2023-08-16', 9, 5),
(78, 3, 3, '2023-08-17', 8, 7),
(79, 3, 3, '2023-08-18', 7, 3),
(80, 4, 3, '2023-08-19', 12, 8),
(81, 6, 1, '2023-08-20', 7, 3),
(82, 6, 3, '2023-08-21', 13, 9),
(83, 4, 2, '2023-08-22', 6, 1),
(84, 2, 3, '2023-08-23', 7, 1),
(85, 4, 2, '2023-08-24', 7, 2),
(86, 2, 2, '2023-08-25', 15, 9),
(87, 4, 1, '2023-08-26', 9, 2),
(88, 2, 2, '2023-08-27', 6, 4),
(89, 2, 1, '2023-08-28', 15, 7),
(90, 2, 1, '2023-08-29', 6, 0),
(91, 6, 2, '2023-08-30', 12, 5),
(92, 5, 2, '2023-08-31', 8, 2),
(93, 2, 1, '2023-09-01', 15, 7),
(94, 1, 1, '2023-09-02', 15, 7),
(95, 4, 1, '2023-09-03', 8, 1),
(96, 2, 3, '2023-09-04', 10, 4),
(97, 5, 3, '2023-09-05', 11, 10),
(98, 2, 2, '2023-09-06', 15, 11),
(99, 5, 2, '2023-09-07', 6, 4),
(100, 1, 1, '2023-09-08', 15, 6),
(101, 1, 1, '2023-09-09', 10, 2),
(102, 6, 2, '2023-09-10', 13, 6),
(103, 3, 2, '2023-09-11', 7, 5),
(104, 3, 1, '2023-09-12', 13, 1),
(105, 4, 2, '2023-09-13', 7, 4),
(106, 5, 2, '2023-09-14', 14, 0),
(107, 6, 2, '2023-09-15', 15, 14),
(108, 3, 1, '2023-09-16', 14, 2),
(109, 3, 3, '2023-09-17', 7, 4),
(110, 5, 2, '2023-09-18', 15, 9),
(111, 3, 1, '2023-09-19', 14, 4),
(112, 4, 2, '2023-09-20', 12, 3),
(113, 6, 2, '2023-09-21', 8, 1),
(114, 6, 3, '2023-09-22', 12, 9),
(115, 4, 3, '2023-09-23', 8, 1),
(116, 2, 1, '2023-09-24', 10, 9),
(117, 4, 3, '2023-09-25', 15, 14),
(118, 3, 3, '2023-09-26', 13, 6),
(119, 1, 2, '2023-09-27', 13, 3),
(120, 3, 3, '2023-09-28', 15, 7),
(121, 4, 1, '2023-09-29', 14, 9),
(122, 4, 2, '2023-09-30', 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `contactmessages`
--

DROP TABLE IF EXISTS `contactmessages`;
CREATE TABLE IF NOT EXISTS `contactmessages` (
  `message` text NOT NULL,
  `conID` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ID` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`conID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactmessages`
--

INSERT INTO `contactmessages` (`message`, `conID`, `timestamp`, `user_ID`, `email`) VALUES
('asfkjpadofidaosiahcnsidlfhsdaflabsdf', 1, '2023-07-16 01:07:33', NULL, 'j@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varbinary(16) NOT NULL,
  `attemptTime` bigint(20) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pitch_types`
--

DROP TABLE IF EXISTS `pitch_types`;
CREATE TABLE IF NOT EXISTS `pitch_types` (
  `pitch_type_id` int(11) NOT NULL,
  `pitch_type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`pitch_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pitch_types`
--

INSERT INTO `pitch_types` (`pitch_type_id`, `pitch_type_name`) VALUES
(1, 'tent'),
(2, 'touring_caravan'),
(3, 'motorhome');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` varchar(10) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  KEY `fk_user_review` (`user_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_ID`, `rating`, `comment`, `timestamp`) VALUES
('rev1', 2, 5, 'I had an incredible experience with your company. The staff was friendly, the facilities were top-notch, and the natural surroundings were breathtaking. Highly recommended!', '2023-07-04 16:25:44'),
('rev2', 1, 3, 'I recently visited your campsite and was impressed by the well-maintained pitches and the variety of amenities available. The location was serene, and the staff provided excellent service. I had a fantastic time', '2023-07-04 16:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) NOT NULL,
  `site_location` varchar(100) NOT NULL,
  `img_src` varchar(255) NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`site_id`, `site_name`, `site_location`, `img_src`) VALUES
(1, 'Lakeview Campground', 'Located near Lake Tahoe, California, USA.', 'images/sites/site1'),
(2, 'Riverside Retreat', 'Located along the Colorado River in Moab, Utah, USA', 'images/sites/site2'),
(3, 'Beachside Campsite', 'Located on the coast of Jervis Bay, New South Wales, Australia', 'images/sites/site3'),
(4, 'Waterfront Oasis', 'Located on the shores of Lake Michigan, Michigan, USA', 'images/sites/site4'),
(5, 'Shoreline Camping Ground', 'Located on the shores of Loch Lomond, Scotland, United Kingdom', 'images/sites/site5'),
(6, 'Lakeside Haven', 'Located near Lake Louise, Alberta, Canada.', 'images/sites/site6');

-- --------------------------------------------------------

--
-- Stand-in structure for view `site_camping_swimming_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `site_camping_swimming_view`;
CREATE TABLE IF NOT EXISTS `site_camping_swimming_view` (
`site_id` int(11)
,`site_name` varchar(100)
,`site_location` varchar(100)
,`img_src` varchar(255)
,`pitch_type_name` varchar(50)
,`pitch_date` date
,`pitch_availability` int(11)
,`pitch_capacity` int(11)
,`slot_date` date
,`slot_availability` int(11)
,`slot_capacity` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `swimming_slots`
--

DROP TABLE IF EXISTS `swimming_slots`;
CREATE TABLE IF NOT EXISTS `swimming_slots` (
  `slot_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `slot_date` date NOT NULL,
  `slot_capacity` int(11) NOT NULL,
  `slot_availability` int(11) NOT NULL,
  PRIMARY KEY (`slot_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=733 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `swimming_slots`
--

INSERT INTO `swimming_slots` (`slot_id`, `site_id`, `slot_date`, `slot_capacity`, `slot_availability`) VALUES
(1, 6, '2023-06-01', 17, 6),
(2, 3, '2023-06-02', 21, 12),
(3, 6, '2023-06-03', 20, 20),
(4, 3, '2023-06-04', 11, 1),
(5, 3, '2023-06-05', 23, 23),
(6, 5, '2023-06-06', 15, 12),
(7, 5, '2023-06-07', 24, 3),
(8, 2, '2023-06-08', 10, 6),
(9, 3, '2023-06-09', 18, 11),
(10, 1, '2023-06-10', 13, 4),
(11, 1, '2023-06-11', 13, 8),
(12, 1, '2023-06-12', 15, 0),
(13, 2, '2023-06-13', 25, 9),
(14, 5, '2023-06-14', 11, 2),
(15, 6, '2023-06-15', 24, 12),
(16, 5, '2023-06-16', 24, 19),
(17, 1, '2023-06-17', 13, 7),
(18, 6, '2023-06-18', 11, 3),
(19, 3, '2023-06-19', 22, 16),
(20, 4, '2023-06-20', 23, 19),
(21, 2, '2023-06-21', 17, 14),
(22, 5, '2023-06-22', 24, 11),
(23, 1, '2023-06-23', 25, 0),
(24, 6, '2023-06-24', 22, 15),
(25, 1, '2023-06-25', 24, 10),
(26, 2, '2023-06-26', 21, 0),
(27, 5, '2023-06-27', 14, 2),
(28, 1, '2023-06-28', 22, 14),
(29, 2, '2023-06-29', 23, 6),
(30, 1, '2023-06-30', 19, 17),
(31, 5, '2023-07-01', 21, 21),
(32, 2, '2023-07-02', 11, 6),
(33, 6, '2023-07-03', 17, 15),
(34, 2, '2023-07-04', 11, 7),
(35, 2, '2023-07-05', 10, 7),
(36, 4, '2023-07-06', 13, 2),
(37, 3, '2023-07-07', 16, 9),
(38, 2, '2023-07-08', 20, 12),
(39, 2, '2023-07-09', 11, 4),
(40, 1, '2023-07-10', 11, 11),
(41, 4, '2023-07-11', 10, 7),
(42, 5, '2023-07-12', 19, 2),
(43, 6, '2023-07-13', 21, 12),
(44, 5, '2023-07-14', 13, 4),
(45, 6, '2023-07-15', 12, 8),
(46, 6, '2023-07-16', 25, 19),
(47, 1, '2023-07-17', 23, 4),
(48, 6, '2023-07-18', 10, 4),
(49, 3, '2023-07-19', 23, 18),
(50, 2, '2023-07-20', 17, 2),
(51, 4, '2023-07-21', 16, 9),
(52, 4, '2023-07-22', 25, 0),
(53, 3, '2023-07-23', 16, 2),
(54, 5, '2023-07-24', 25, 2),
(55, 5, '2023-07-25', 15, 2),
(56, 4, '2023-07-26', 22, 16),
(57, 3, '2023-07-27', 21, 21),
(58, 4, '2023-07-28', 21, 19),
(59, 2, '2023-07-29', 21, 9),
(60, 6, '2023-07-30', 10, 6),
(61, 6, '2023-07-31', 13, 5),
(62, 4, '2023-08-01', 22, 8),
(63, 2, '2023-08-02', 24, 23),
(64, 3, '2023-08-03', 16, 5),
(65, 4, '2023-08-04', 19, 8),
(66, 5, '2023-08-05', 15, 12),
(67, 5, '2023-08-06', 25, 6),
(68, 2, '2023-08-07', 14, 12),
(69, 2, '2023-08-08', 14, 1),
(70, 4, '2023-08-09', 16, 5),
(71, 6, '2023-08-10', 22, 3),
(72, 4, '2023-08-11', 12, 2),
(73, 5, '2023-08-12', 13, 4),
(74, 5, '2023-08-13', 25, 10),
(75, 2, '2023-08-14', 14, 0),
(76, 2, '2023-08-15', 16, 13),
(77, 5, '2023-08-16', 10, 7),
(78, 3, '2023-08-17', 14, 3),
(79, 3, '2023-08-18', 22, 14),
(80, 4, '2023-08-19', 25, 13),
(81, 6, '2023-08-20', 12, 1),
(82, 6, '2023-08-21', 12, 1),
(83, 4, '2023-08-22', 17, 14),
(84, 2, '2023-08-23', 25, 4),
(85, 4, '2023-08-24', 23, 22),
(86, 2, '2023-08-25', 25, 21),
(87, 4, '2023-08-26', 22, 12),
(88, 2, '2023-08-27', 14, 8),
(89, 2, '2023-08-28', 18, 10),
(90, 2, '2023-08-29', 23, 0),
(91, 6, '2023-08-30', 15, 9),
(92, 5, '2023-08-31', 24, 21),
(93, 2, '2023-09-01', 23, 2),
(94, 1, '2023-09-02', 19, 11),
(95, 4, '2023-09-03', 10, 10),
(96, 2, '2023-09-04', 12, 0),
(97, 5, '2023-09-05', 12, 7),
(98, 2, '2023-09-06', 17, 17),
(99, 5, '2023-09-07', 24, 0),
(100, 1, '2023-09-08', 22, 2),
(101, 1, '2023-09-09', 21, 4),
(102, 6, '2023-09-10', 14, 5),
(103, 3, '2023-09-11', 23, 6),
(104, 3, '2023-09-12', 20, 4),
(105, 4, '2023-09-13', 16, 6),
(106, 5, '2023-09-14', 20, 6),
(107, 6, '2023-09-15', 20, 8),
(108, 3, '2023-09-16', 22, 17),
(109, 3, '2023-09-17', 21, 9),
(110, 5, '2023-09-18', 12, 11),
(111, 3, '2023-09-19', 16, 12),
(112, 4, '2023-09-20', 19, 18),
(113, 6, '2023-09-21', 19, 3),
(114, 6, '2023-09-22', 24, 12),
(115, 4, '2023-09-23', 12, 5),
(116, 2, '2023-09-24', 25, 19),
(117, 4, '2023-09-25', 18, 5),
(118, 3, '2023-09-26', 25, 25),
(119, 1, '2023-09-27', 23, 23),
(120, 3, '2023-09-28', 20, 10),
(121, 4, '2023-09-29', 25, 8),
(122, 4, '2023-09-30', 20, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_Name` varchar(50) NOT NULL,
  `last_Name` varchar(50) NOT NULL,
  `join_date` date NOT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `password`, `email`, `first_Name`, `last_Name`, `join_date`) VALUES
(1, 'admin', 'adminpass', 'admin@gmail.com', 'adminFirst', 'adminLast', '2023-06-13'),
(2, 'elliot', 'awe', 'aweelliot1@gmail.com', 'Elliot', 'Awe', '2023-06-13'),
(10, 'lassy', 'lassy', 'lasso@gmial.com', 'Teddy', 'Lasso', '2023-07-15'),
(14, 'gard', 'gardgard', 'gard1@gmail.com', 'James', 'Gardner', '2023-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_counter`
--

DROP TABLE IF EXISTS `visitor_counter`;
CREATE TABLE IF NOT EXISTS `visitor_counter` (
  `counts` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor_counter`
--

INSERT INTO `visitor_counter` (`counts`) VALUES
(137);

-- --------------------------------------------------------

--
-- Structure for view `site_camping_swimming_view`
--
DROP TABLE IF EXISTS `site_camping_swimming_view`;

DROP VIEW IF EXISTS `site_camping_swimming_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `site_camping_swimming_view`  AS  select `s`.`site_id` AS `site_id`,`s`.`site_name` AS `site_name`,`s`.`site_location` AS `site_location`,`s`.`img_src` AS `img_src`,`pt`.`pitch_type_name` AS `pitch_type_name`,`cp`.`pitch_date` AS `pitch_date`,`cp`.`pitch_availability` AS `pitch_availability`,`cp`.`pitch_capacity` AS `pitch_capacity`,`ss`.`slot_date` AS `slot_date`,`ss`.`slot_availability` AS `slot_availability`,`ss`.`slot_capacity` AS `slot_capacity` from (((`sites` `s` left join `camping_pitches` `cp` on((`s`.`site_id` = `cp`.`site_id`))) left join `pitch_types` `pt` on((`cp`.`pitch_type_id` = `pt`.`pitch_type_id`))) left join `swimming_slots` `ss` on(((`s`.`site_id` = `ss`.`site_id`) and (`cp`.`pitch_date` = `ss`.`slot_date`)))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
