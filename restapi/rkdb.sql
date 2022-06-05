-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2022 at 05:57 AM
-- Server version: 8.0.28
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rkdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int NOT NULL,
  `bus_no` int DEFAULT NULL,
  `route` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `bus_no`, `route`, `status`) VALUES
(3, 100, 'Kuantan - Gambang', 'Active'),
(5, 400, 'TSK - Pekan', 'Active'),
(7, 200, 'Balok - Pekan', 'Active'),
(8, 401, 'Bandar - Gambang', 'Active'),
(9, 600, 'Bukit Panaroma - Sungai Isap', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `bus_id` int DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `user_id`, `bus_id`, `status`) VALUES
(7, 8, 3, 'Active'),
(8, 9, 5, 'Active'),
(9, 10, 3, 'Active'),
(10, 12, 8, 'Active'),
(11, 13, 9, 'Active'),
(12, 14, 7, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `id` int NOT NULL,
  `bus_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `arrival_time` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `current_location` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `next_location` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `route_perday` int DEFAULT NULL,
  `date` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`id`, `bus_id`, `user_id`, `arrival_time`, `current_location`, `next_location`, `route_perday`, `date`, `time`, `status`) VALUES
(3, 3, 8, '5', 'BSP', 'Gambang', 4, '22-05-2022', '09:51 AM', 'Active'),
(4, 3, 8, '12', 'Testa', 'UMP', 1, '22-05-2022', '02:59 AM', 'Active'),
(5, 3, 8, '12', 'Pantai Barat', 'Batu Hitam', 2, '21-05-2022', '02:59 AM', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` int DEFAULT NULL,
  `datetime` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`, `datetime`) VALUES
(1, 'admin', '21232F297A57A5A743894A0E4A801FC3', 3, '21-05-2022 22:13PM'),
(8, 'adam@gmail.com', 'e75c325988a835bda7a7377db096deb9', 2, '22-05-2022 01:46AM'),
(9, 'test@gmail.com', '216a36bfacab2a2110ee627b7b33a1b0', 2, '22-05-2022 01:47AM'),
(10, 'asdf@gmail.com', 'a0dd774096e8ed4d6c2db3ce30e4ff22', 2, '22-05-2022 01:47AM'),
(11, 'adamz@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 1, '22-05-2022 03:30AM'),
(12, 'red@gmail.com', 'af3a6dff32f00abd77016337b4481029', 2, '22-05-2022 10:07AM'),
(13, 'blue@gmail.com', '9cc054917abe1bdbe337f901a57e60f3', 2, '22-05-2022 10:07AM'),
(14, 'black@gmail.com', '0c6ac0bed70ef44ed39cce48a1f599ca', 2, '22-05-2022 10:08AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `driver_ibfk_1` (`bus_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `driver_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
