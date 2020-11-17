-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 02:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(3, '2020-11-16', 'Scott', 'scott.sewards@outlook.com', 0, 0, '$2y$10$XkWEhOPb0l/1qRh9S9ACMubsNN0cYg4s8i00pLT7NxiEufl3vbbBO', 'images/picture.png', 'images/banner.png'),
(4, '2020-11-16', 'George', 'george.sewards@outlook.com', 0, 1, '$2y$10$aodjKI6crW3y/tjfNOh4F.WlrvKzlcf8AwEFdF8/Kdib4dnwXrFZa', 'images/picture.png', 'images/banner.png'),
(6, '2020-11-16', 'KingKong', 'king@kong.com', 0, 1, '$2y$10$c9712srD.voH0WaCk2E1A.OtbrcxCHdt18jJpvix9.tFLDz8e08Qy', 'images/picture.png', 'images/banner.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
