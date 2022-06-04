-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2022 at 07:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skwal`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `isBanned` tinyint(1) NOT NULL DEFAULT 0,
  `isVerified` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `banner` text NOT NULL DEFAULT 'default.png',
  `avatar` text NOT NULL DEFAULT 'default.png',
  `bio` text NOT NULL DEFAULT 'Bio not defined yet!',
  `bannerVersion` int(11) NOT NULL DEFAULT 0,
  `avatarVersion` int(11) NOT NULL DEFAULT 0,
  `newEmail` text DEFAULT NULL,
  `newEmailToken` text DEFAULT NULL,
  `newPasswordToken` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `isAdmin`, `isBanned`, `isVerified`, `createdAt`, `banner`, `avatar`, `bio`, `bannerVersion`, `avatarVersion`, `newEmail`, `newEmailToken`, `newPasswordToken`) VALUES
(1, 'skwal', '$2y$10$Shfcj3PaVgIaiPcuolU5euiRSubqzkxYrcKPynQDNyGNR1j8Ihnm6', 'skwal@skwal.net', 0, 0, 0, '2022-05-31 05:02:47', '1.jpg', '1.jpg', 'Hi', 1, 1, NULL, NULL, NULL),
(2, 'john', '$2y$10$/LbdSr4KdNocJKZqhYI9YOcZfPSmGghFwwyGjweX5YZQAYif0gcSC', 'john@skwal.net', 0, 0, 0, '2022-05-31 05:03:18', '2.jpg', '2.jpeg', 'Hello', 1, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
