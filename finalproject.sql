-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2025 at 04:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproject`
--
CREATE DATABASE IF NOT EXISTS `finalproject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `finalproject`;

-- --------------------------------------------------------

--
-- Table structure for table `diy`
--

CREATE TABLE `diy` (
  `id` int(11) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `troubleshooting` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diy`
--

INSERT INTO `diy` (`id`, `problem`, `troubleshooting`, `created_at`) VALUES
(1, 'yawa', 'yawa', '2025-05-19 07:33:31'),
(2, 'Nabuang naka dawg', 'Justin lesgo', '2025-05-19 07:41:41'),
(3, 'Nabuang na', 'Krishnan', '2025-05-19 07:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dept` int(11) NOT NULL DEFAULT current_timestamp(),
  `phone_no` varchar(20) NOT NULL,
  `priority` int(11) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ID`, `fname`, `lname`, `email`, `dept`, `phone_no`, `priority`, `issue`, `description`, `created_at`) VALUES
(3, 'Justin', 'Nabunturan', 'dawg@gmail.con', 4, '09238823211', 1, 'Nabuang na', 'Hala noh!', '2025-05-19 07:40:47'),
(4, 'sds', 'sds', 'sds@gmail.com', 2, '232', 1, 'hala', 'sdsd', '2025-05-19 13:43:25'),
(5, 'Michael', 'Gonzaga', 'gonz@gmail.com', 9, '09112121', 1, 'Student', 'Nabuang na', '2025-05-19 13:47:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diy`
--
ALTER TABLE `diy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diy`
--
ALTER TABLE `diy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
