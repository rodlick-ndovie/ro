-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 22, 2025 at 06:12 PM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ndalama_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
CREATE TABLE IF NOT EXISTS `loans` (
  `loan_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_issued` date DEFAULT NULL,
  `status` enum('Active','Paid','Overdue') DEFAULT 'Active',
  PRIMARY KEY (`loan_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date_joined` date DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

DROP TABLE IF EXISTS `shares`;
CREATE TABLE IF NOT EXISTS `shares` (
  `share_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`share_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treasurer`
--

DROP TABLE IF EXISTS `treasurer`;
CREATE TABLE IF NOT EXISTS `treasurer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
