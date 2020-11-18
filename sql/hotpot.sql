-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2020 at 10:31 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotpot`
--

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE `communities` (
  `id` int(11) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `picture` text NOT NULL DEFAULT 'images/picture.png',
  `banner` text NOT NULL DEFAULT 'images/banner.png',
  `subscribers` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `created`, `created_by`, `admin`, `name`, `description`, `picture`, `banner`, `subscribers`) VALUES
(0, '2020-11-17', 9, 9, 'HotPot', 'Welcome to the first community on HotPot.', 'images/picture.png', 'images/banner.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `posted` date NOT NULL DEFAULT current_timestamp(),
  `posted_by` int(11) NOT NULL,
  `posted_in` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `dislikes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `replied` date NOT NULL DEFAULT current_timestamp(),
  `reply_by` int(11) NOT NULL,
  `replied_in` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `name` text NOT NULL,
  `email` text NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `can_email` tinyint(1) NOT NULL DEFAULT 1,
  `password` text NOT NULL,
  `picture` text NOT NULL DEFAULT 'images/picture.png',
  `banner` text NOT NULL DEFAULT 'images/banner.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created`, `name`, `email`, `verified`, `can_email`, `password`, `picture`, `banner`) VALUES
(7, '2020-11-17', 'CharlieChaplin', 'charles@chaplin.co.uk', 1, 0, '$2y$10$6bPqCQaqhAAZF2Onrvuxh.lhJ.Pv32Gcu23MS5KCtmu2XOcH4XFR6', 'images/charlie.jpg', 'images/banner.png'),
(8, '2020-11-17', 'OrsonWelles', 'george.orson@welles.com', 1, 0, '$2y$10$Srh0PsU1EUsALto3su1Sjue5Ar0Qn38JnSAchK1hUHXy7tjYOAW9O', 'images/orson.jpg', 'images/banner.png'),
(9, '2020-11-17', 'ScottSewards', 'scott.sewards@outlook.com', 1, 1, '$2y$10$OJ00WHRjrkEc6aI6BhAytOq/7WvPpD/R7yNv46LJPVDKVnO4oUuXu', 'images/george.jpeg', 'images/banner.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
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
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
