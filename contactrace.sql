-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2020 at 01:32 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contactrace`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `id` int(11) NOT NULL,
  `bname` text NOT NULL,
  `estpop` int(11) DEFAULT NULL,
  `blevel` text DEFAULT NULL,
  `latitude` decimal(11,6) NOT NULL,
  `longitude` decimal(11,6) NOT NULL,
  `idcm` int(11) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`id`, `bname`, `estpop`, `blevel`, `latitude`, `longitude`, `idcm`, `remarks`) VALUES
(9, 'Mansilingan', 12, 'Level 1', '10.631100', '122.973900', 14, '10'),
(10, 'Taculing', 20, 'Level 1', '10.647300', '122.952900', 14, '20'),
(15, 'Alijis', 12, 'Level 1', '10.633800', '122.951200', 14, '1'),
(16, 'Tangub', 66, 'Level 1', '10.630200', '122.934500', 14, '69'),
(21, 'Handumanan', 1, 'Level 1', '10.606200', '122.965200', 14, ''),
(22, 'Pahanocoy', 1, 'Level 1', '10.612700', '122.930100', 14, '11');

-- --------------------------------------------------------

--
-- Table structure for table `citymun`
--

CREATE TABLE `citymun` (
  `id` int(11) NOT NULL,
  `cmdesc` text NOT NULL,
  `latitude` decimal(11,6) NOT NULL,
  `longitude` decimal(11,6) NOT NULL,
  `cmclass` text NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citymun`
--

INSERT INTO `citymun` (`id`, `cmdesc`, `latitude`, `longitude`, `cmclass`, `remarks`) VALUES
(14, 'Bacolod', '10.674400', '122.951800', 'City', '10'),
(15, 'Bago', '10.538400', '122.835700', 'City', '20'),
(16, 'Murcia', '10.605900', '123.040700', 'Municipality', '2'),
(17, 'Talisay', '10.736300', '122.966700', 'City', '77'),
(22, 'Silay', '10.796500', '122.976000', 'City', ''),
(23, 'Valladolid', '10.460100', '122.824600', 'City', ''),
(24, 'San Enrique', '10.411000', '122.853900', 'City', ''),
(25, 'Salvador Benedicto', '10.577100', '123.220700', 'City', ''),
(26, 'La Carlota', '10.425000', '122.921700', 'City', ''),
(27, 'Pontevedra', '10.367100', '122.869800', 'City', ''),
(28, 'Hinigaran', '10.271000', '122.851700', 'City', ''),
(29, 'Binalbagan', '10.190200', '122.859000', 'City', ''),
(30, 'La Castellana', '10.322900', '123.018800', 'City', ''),
(31, 'Victorias', '10.900700', '123.071500', 'City', ''),
(32, 'Cadiz', '10.956400', '123.305700', 'City', ''),
(33, 'Sagay', '10.895800', '123.415800', 'City', ''),
(34, 'Escalante', '10.840900', '123.499300', 'City', ''),
(35, 'San Carlos', '10.485400', '123.418900', 'City', ''),
(36, 'Kabankalan', '9.988100', '122.813100', 'City', ''),
(37, 'Ilog', '10.025100', '122.768400', 'City', ''),
(38, 'Cauayan', '9.971900', '122.624200', 'City', ''),
(39, 'Sipalay', '9.748800', '122.404300', 'City', ''),
(40, 'Hinoa-an', '9.602000', '122.467300', 'City', ''),
(41, 'Candoni', '9.827400', '122.642400', 'City', ''),
(42, 'Isabela', '10.202900', '122.987100', 'City', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `first_name` tinytext DEFAULT 'first_name',
  `last_name` tinytext DEFAULT 'last_name',
  `birthday` date DEFAULT '1950-01-01',
  `dp_url` text DEFAULT '\'uploads/profile_picture/default.png\''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `first_name`, `last_name`, `birthday`, `dp_url`) VALUES
(3, 'user1', 'f5025787425954b3ed290da3c9b2bb9d982c5aac6f93035c0efad7da1619c9fa', 'John Stephen2', 'Degillo', '1999-09-15', 'uploads/profile_picture/5f685e9b3167f7.62943356.png'),
(18, 'user', 'f5025787425954b3ed290da3c9b2bb9d982c5aac6f93035c0efad7da1619c9fa', 'first_name', 'last_name', '1950-01-01', '/uploads/profile_picture/default.png'),
(19, 'user2', 'f5025787425954b3ed290da3c9b2bb9d982c5aac6f93035c0efad7da1619c9fa', 'first_name', 'last_name', '1950-01-01', '/uploads/profile_picture/default.png'),
(20, 'user25', 'f5025787425954b3ed290da3c9b2bb9d982c5aac6f93035c0efad7da1619c9fa', 'first_name', 'last_name', '1950-01-01', 'uploads/profile_picture/5f6851c9e4a7e8.94910997.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citymun`
--
ALTER TABLE `citymun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `citymun`
--
ALTER TABLE `citymun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
