-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2022 at 06:14 AM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `post` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`post`, `user`, `content`, `created_at`, `id`) VALUES
(2, 1, 'Ea autem fugiat quo nihil odio ex maiores perspiciatis. Et iste dignissimos aut debitis corporis qui delectus quidem.', '2022-06-13 15:30:32', 1),
(2, 1, 'Lorem ipsum dolor sit amet. Sed assumenda quae hic aspernatur esse a similique sint et assumenda facere et dolor corrupti et animi sint eum libero reiciendis. Aut eveniet quam eos odio cumque aut numquam autem qui iusto tempore. Aut nesciunt repellendus sed iusto reiciendis ea laboriosam molestiae. Et voluptas tempore hic laboriosam placeat ea autem omnis ut mollitia sint?', '2022-06-13 16:03:10', 2),
(1, 1, 'Lorem ipsum dolor sit amet. Aut nesciunt vitae non repellat corrupti aut numquam repellat. Et dolores vitae 33 quaerat quae quo eius iste rem quia voluptas. Qui odit nobis aut doloribus animi non magni ipsa et architecto laudantium ut enim quam ad assumenda nihil.', '2022-06-13 16:39:18', 3),
(1, 1, 'Aut rerum error qui optio eligendi ut optio repellat non Quis asperiores. Eum minima magnam saepe alias et fuga vel consequatur omnis hic nesciunt perspiciatis est explicabo unde 33 officiis dolor. Qui nemo aspernatur qui unde ratione et tempore reprehenderit est odit dolorum.\n\nAut consectetur odit vel voluptatem tempora aut dolorem galisum id deserunt aliquam? Quo error architecto sed vitae distinctio ea officiis ratione in suscipit delectus non omnis error ut veritatis praesentium. Aut sunt quos ut aliquid similique eum natus galisum non accusamus magni non quidem dolor?', '2022-06-13 16:39:25', 4);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `userId` int(11) NOT NULL,
  `followerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user` int(11) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user`, `post`, `comment`, `id`) VALUES
(1, 1, NULL, 1),
(1, 2, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `title` text NOT NULL,
  `content` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `editedAt` timestamp NULL DEFAULT NULL,
  `author` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`title`, `content`, `createdAt`, `editedAt`, `author`, `id`) VALUES
('Lorem Ipsum', 'Lorem ipsum dolor sit amet. Aut nesciunt vitae non repellat corrupti aut numquam repellat. Et dolores vitae 33 quaerat quae quo eius iste rem quia voluptas. Qui odit nobis aut doloribus animi non magni ipsa et architecto laudantium ut enim quam ad assumenda nihil.\n\nAut rerum error qui optio eligendi ut optio repellat non Quis asperiores. Eum minima magnam saepe alias et fuga vel consequatur omnis hic nesciunt perspiciatis est explicabo unde 33 officiis dolor. Qui nemo aspernatur qui unde ratione et tempore reprehenderit est odit dolorum.\n\nAut consectetur odit vel voluptatem tempora aut dolorem galisum id deserunt aliquam? Quo error architecto sed vitae distinctio ea officiis ratione in suscipit delectus non omnis error ut veritatis praesentium. Aut sunt quos ut aliquid similique eum natus galisum non accusamus magni non quidem dolor?', '2022-06-11 05:23:08', NULL, 1, 1),
('Hello', 'Lorem ipsum dolor sit amet. Sed assumenda quae hic aspernatur esse a similique sint et assumenda facere et dolor corrupti et animi sint eum libero reiciendis. Aut eveniet quam eos odio cumque aut numquam autem qui iusto tempore. Aut nesciunt repellendus sed iusto reiciendis ea laboriosam molestiae. Et voluptas tempore hic laboriosam placeat ea autem omnis ut mollitia sint?\n\nEa autem fugiat quo nihil odio ex maiores perspiciatis. Et iste dignissimos aut debitis corporis qui delectus quidem.', '2022-06-11 05:24:21', NULL, 1, 2);

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
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '{}' CHECK (json_valid(`settings`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `createdAt`, `banner`, `avatar`, `bio`, `bannerVersion`, `avatarVersion`, `newEmail`, `newEmailToken`, `newPasswordToken`, `roles`, `settings`) VALUES
(1, 'skwal', '$2y$10$Shfcj3PaVgIaiPcuolU5euiRSubqzkxYrcKPynQDNyGNR1j8Ihnm6', 'skwal@skwal.net', '2022-05-31 05:02:47', '1.jpg', '1.jpg', 'Hi', 1, 1, NULL, NULL, NULL, 'verified,admin', '{}'),
(2, 'john', '$2y$10$/LbdSr4KdNocJKZqhYI9YOcZfPSmGghFwwyGjweX5YZQAYif0gcSC', 'john@skwal.net', '2022-05-31 05:03:18', '2.jpg', '2.jpeg', 'Hello', 1, 1, NULL, NULL, NULL, 'verified', '{}');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
