-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2022 at 06:25 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u832963753_skwalnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `post` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `userId` int(11) NOT NULL,
  `followerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user` int(11) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `comment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `editedAt` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `banner` text NOT NULL DEFAULT 'default.png',
  `avatar` text NOT NULL DEFAULT 'default.png',
  `bio` text NOT NULL DEFAULT 'Bio not defined yet!',
  `bannerVersion` int(11) NOT NULL DEFAULT 0,
  `avatarVersion` int(11) NOT NULL DEFAULT 0,
  `newEmail` text DEFAULT NULL,
  `newEmailToken` text DEFAULT NULL,
  `newPasswordToken` text DEFAULT NULL,
  `roles` text NOT NULL DEFAULT '',
  `settings` longtext NOT NULL DEFAULT '{}'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `createdAt`, `banner`, `avatar`, `bio`, `bannerVersion`, `avatarVersion`, `newEmail`, `newEmailToken`, `newPasswordToken`, `roles`, `settings`) VALUES
(1, 'SkwalExe', '$2y$10$K/MC45o7zu0glyeh89bmAO/LamQnwLEBfnPt0K2bJHrjSVxNRi0oe', 'skwal.net@gmail.com', '2022-06-01 05:02:11', '2.png', '2.png', 'Founder of skwal.net', 1, 2, NULL, NULL, NULL, 'admin,verified', '{\"borders\":false,\"color\":\"#CE6B82\"}'),
(2, 'Updates', '$2y$10$3MXTAVcQY7Lvvu67IgJiEOtu6zZHre1NNGMfdsOaQWyTU3dmQKUGe', 'updates@skwal.net', '2022-06-18 06:12:38', '2.png', 'default.png', 'Official skwal.net updates and informations', 1, 0, NULL, NULL, NULL, 'admin,verified', '{}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
