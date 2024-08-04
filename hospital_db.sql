-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 04, 2024 at 07:37 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

DROP TABLE IF EXISTS `admissions`;
CREATE TABLE IF NOT EXISTS `admissions` (
  `admission_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int DEFAULT NULL,
  `ward` varchar(50) DEFAULT NULL,
  `datetime_of_admission` datetime DEFAULT NULL,
  `datetime_of_discharge` datetime DEFAULT NULL,
  PRIMARY KEY (`admission_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`admission_id`, `patient_id`, `ward`, `datetime_of_admission`, `datetime_of_discharge`) VALUES
(1, 22, 'ICU', '2024-08-04 13:46:00', NULL),
(2, 21, 'Psychiatric Ward', '2024-08-04 13:43:00', NULL),
(3, 1, 'OB Ward', '2024-08-04 14:03:00', '2024-08-04 14:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `patient_id` int NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `last_name`, `first_name`, `middle_name`, `gender`, `date_of_birth`, `address`) VALUES
(1, 'Quitasol', 'Jerome', 'A.', 'Female', '1935-08-30', '25 Leonard Wood Rd, Baguio, Benguet'),
(2, 'Martinez', 'Shin', 'G.', 'Male', '1967-09-22', '25 Leonard Wood Rd, Baguio, Benguet'),
(3, 'Quitasol', 'Mark', 'A.', 'Male', '2001-07-27', '13 Naguilian Rd, Baguio, Benguet'),
(4, 'Clasara', 'Angelo', 'G.', 'Male', '1926-07-03', '15 Loakan Rd, Baguio, Benguet'),
(5, 'Clasara', 'Shin', 'B.', 'Female', '2017-10-25', '5 Marcos Highway, Baguio, Benguet'),
(6, 'Martinez', 'Luis', 'C.', 'Male', '2011-09-12', '7 Gov Pack Rd, Baguio, Benguet'),
(7, 'Murillo', 'Jerome', 'C.', 'Female', '1944-09-30', '15 Loakan Rd, Baguio, Benguet'),
(8, 'Martinez', 'Angelo', 'B.', 'Female', '2005-06-14', '25 Leonard Wood Rd, Baguio, Benguet'),
(9, 'Martinez', 'Mark', 'G.', 'Male', '1938-04-07', '15 Loakan Rd, Baguio, Benguet'),
(10, 'Quitasol', 'Angelo', 'C.', 'Female', '1958-08-22', '25 Leonard Wood Rd, Baguio, Benguet'),
(11, 'Polgue', 'Luis', 'E.', 'Male', '2017-04-27', '13 Naguilian Rd, Baguio, Benguet'),
(12, 'Clasara', 'Madel', 'B.', 'Male', '1984-09-01', '25 Leonard Wood Rd, Baguio, Benguet'),
(13, 'Polgue', 'Luis', 'B.', 'Female', '1983-01-24', '13 Naguilian Rd, Baguio, Benguet'),
(14, 'Fernandez', 'Mark', 'D.', 'Male', '2019-11-17', '13 Naguilian Rd, Baguio, Benguet'),
(15, 'Fernandez', 'Madel', 'G.', 'Female', '2013-08-02', '7 Gov Pack Rd, Baguio, Benguet'),
(16, 'Murillo', 'Mark', 'B.', 'Male', '2002-09-18', '13 Naguilian Rd, Baguio, Benguet'),
(17, 'Martinez', 'Angelo', 'E.', 'Female', '1971-07-17', '7 Gov Pack Rd, Baguio, Benguet'),
(18, 'Polgue', 'Luis', 'F.', 'Female', '1922-09-02', '15 Loakan Rd, Baguio, Benguet'),
(19, 'Polgue', 'Shin', 'G.', 'Male', '1936-03-22', '13 Naguilian Rd, Baguio, Benguet'),
(20, 'Quitasol', 'Madel', 'C.', 'Male', '1939-11-02', '5 Marcos Highway, Baguio, Benguet'),
(21, 'Fernandez', 'Ernelle Jhay', 'P.', 'Male', '2002-05-22', 'Pinsao Pilot\r\n'),
(22, 'Balatbat', 'Mac', 'T.', 'Male', '2000-01-16', 'Sto. Rosario \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$GXdZaoc446V5rvl6BdhFuOvZqZuDvu7MpBocKT0EHs5YKSdbFBxl2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
