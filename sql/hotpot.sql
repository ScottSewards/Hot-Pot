-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 05:25 PM
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
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `moderated_by` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_for` text DEFAULT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `picture` text NOT NULL DEFAULT 'images/picture.png',
  `banner` text NOT NULL DEFAULT 'images/banner.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `created`, `created_by`, `moderated_by`, `deleted`, `deleted_by`, `deleted_for`, `name`, `description`, `picture`, `banner`) VALUES
(3, '2020-11-20 15:45:50', 9, 9, NULL, NULL, NULL, 'hotpot', 'Welcome to the first community.', 'images/picture.png', 'images/banner.png');

-- --------------------------------------------------------

--
-- Table structure for table `community_bans`
--

CREATE TABLE `community_bans` (
  `id` int(11) NOT NULL,
  `banned` datetime NOT NULL DEFAULT current_timestamp(),
  `banned_by` int(11) NOT NULL,
  `banned_from` int(11) NOT NULL,
  `banned_for` text NOT NULL,
  `unbanned` tinyint(1) DEFAULT NULL,
  `unbanned_by` int(11) DEFAULT NULL,
  `unbanned_for` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `community_subscriptions`
--

CREATE TABLE `community_subscriptions` (
  `id` int(11) NOT NULL,
  `subscribed` datetime NOT NULL DEFAULT current_timestamp(),
  `subscriber` int(11) NOT NULL,
  `subscribed_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `posted` datetime NOT NULL DEFAULT current_timestamp(),
  `posted_by` int(11) NOT NULL,
  `posted_in` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_for` text DEFAULT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `posted`, `posted_by`, `posted_in`, `deleted`, `deleted_by`, `deleted_for`, `title`, `content`) VALUES
(14, '2020-11-20 15:48:04', 9, 3, NULL, NULL, NULL, 'My First Post', 'This is my first post to test if posting works.'),
(15, '2020-11-20 17:18:55', 8, 3, NULL, NULL, NULL, 'Who does David Fincher think he is?', 'The damned buffoon.'),
(16, '2020-11-20 17:23:24', 7, 3, NULL, NULL, NULL, 'Who said I fall in love with every woman I see', 'It was utterly a coincidence the leading ladies in my moving pictures were romantically involved with me. Bloody bastards. ');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `liked` datetime NOT NULL,
  `liked_by` int(11) NOT NULL,
  `like_for` int(11) NOT NULL,
  `like_or_dislike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `replied` datetime NOT NULL DEFAULT current_timestamp(),
  `reply_by` int(11) NOT NULL,
  `replied_in` int(11) NOT NULL,
  `replied_to` int(11) DEFAULT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `replied`, `reply_by`, `replied_in`, `replied_to`, `content`) VALUES
(4, '2020-11-20 16:40:04', 9, 14, NULL, 'This is my first reply to test if replying works.');

-- --------------------------------------------------------

--
-- Table structure for table `reply_likes`
--

CREATE TABLE `reply_likes` (
  `id` int(11) NOT NULL,
  `liked` datetime NOT NULL,
  `liked_by` int(11) NOT NULL,
  `like_for` int(11) NOT NULL,
  `like_or_dislike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `name` text NOT NULL,
  `description` text NOT NULL DEFAULT 'This user has not written a description yet.',
  `email` text NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `show_contact_form` tinyint(1) NOT NULL DEFAULT 1,
  `password` text NOT NULL,
  `picture` text NOT NULL DEFAULT 'images/picture.png',
  `banner` text NOT NULL DEFAULT 'images/banner.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created`, `name`, `description`, `email`, `verified`, `show_contact_form`, `password`, `picture`, `banner`) VALUES
(7, '2020-11-17 00:00:00', 'CharlieChaplin', 'This user has not written a description yet.', 'charles@chaplin.co.uk', 1, 0, '$2y$10$6bPqCQaqhAAZF2Onrvuxh.lhJ.Pv32Gcu23MS5KCtmu2XOcH4XFR6', 'images/charlie.jpg', 'images/banner.png'),
(8, '2020-11-17 00:00:00', 'OrsonWelles', 'This user has not written a description yet.', 'george.orson@welles.com', 1, 0, '$2y$10$Srh0PsU1EUsALto3su1Sjue5Ar0Qn38JnSAchK1hUHXy7tjYOAW9O', 'images/orson.jpg', 'images/banner.png'),
(9, '2020-11-17 00:00:00', 'ScottSewards', 'This user has not written a description yet.', 'scott.sewards@outlook.com', 1, 1, '$2y$10$OJ00WHRjrkEc6aI6BhAytOq/7WvPpD/R7yNv46LJPVDKVnO4oUuXu', 'images/george.jpeg', 'images/banner.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL,
  `subscribed` datetime NOT NULL DEFAULT current_timestamp(),
  `subscriber` int(11) NOT NULL,
  `subscribed_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_bans`
--
ALTER TABLE `community_bans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_subscriptions`
--
ALTER TABLE `community_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply_likes`
--
ALTER TABLE `reply_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `community_bans`
--
ALTER TABLE `community_bans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `community_subscriptions`
--
ALTER TABLE `community_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reply_likes`
--
ALTER TABLE `reply_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
