-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 12:17 PM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment_by_id` int(11) UNSIGNED NOT NULL,
  `comment_in_id` int(11) UNSIGNED NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `edited` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment_deletes`
--

CREATE TABLE `comment_deletes` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment_id` int(11) UNSIGNED NOT NULL,
  `deleted` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `deleted_by_id` int(11) UNSIGNED NOT NULL,
  `deleted_date` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_reason` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment_edits`
--

CREATE TABLE `comment_edits` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment_id` int(11) UNSIGNED NOT NULL,
  `edit_by_id` int(11) UNSIGNED NOT NULL,
  `edit_from` varchar(1000) NOT NULL,
  `edit_to` varchar(1000) NOT NULL,
  `edit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `liked` tinyint(2) NOT NULL COMMENT '-2 to +2',
  `like_from_id` int(11) UNSIGNED NOT NULL,
  `like_to_id` int(11) UNSIGNED NOT NULL,
  `like_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE `communities` (
  `id` int(11) UNSIGNED NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by_id` int(11) UNSIGNED NOT NULL,
  `quarantined` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `quarantined_date` datetime DEFAULT NULL,
  `quarantined_by_id` int(11) UNSIGNED DEFAULT NULL,
  `quarantined_reason` varchar(300) DEFAULT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_date` datetime DEFAULT NULL,
  `deleted_by_id` int(11) UNSIGNED DEFAULT NULL,
  `deleted_reason` varchar(300) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `nsfw` tinyint(1) NOT NULL DEFAULT 0,
  `nsfl` tinyint(1) NOT NULL DEFAULT 0,
  `picture` text NOT NULL DEFAULT 'images/picture.png',
  `banner` text NOT NULL DEFAULT 'images/banner.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `community_bans`
--

CREATE TABLE `community_bans` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `banned` tinyint(2) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'is banned?',
  `banned_by_id` int(11) UNSIGNED NOT NULL,
  `banned_from_id` int(11) UNSIGNED NOT NULL,
  `banned_date` datetime NOT NULL DEFAULT current_timestamp(),
  `banned_reason` varchar(300) NOT NULL,
  `unbanned` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `unbanned_by_id` int(11) UNSIGNED DEFAULT NULL,
  `unbanned_reason` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `community_follows`
--

CREATE TABLE `community_follows` (
  `id` int(11) UNSIGNED NOT NULL,
  `followed` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `follow_from_id` int(11) UNSIGNED NOT NULL,
  `follow_to_id` int(11) UNSIGNED NOT NULL,
  `followed_date` datetime NOT NULL DEFAULT current_timestamp(),
  `unfollowed_date` datetime DEFAULT NULL,
  `unfollowed_reason` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `community_moderators`
--

CREATE TABLE `community_moderators` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `community_id` int(11) UNSIGNED NOT NULL,
  `moderator` tinyint(2) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'is moderator?',
  `promotion_date` datetime NOT NULL DEFAULT current_timestamp(),
  `demotion_date` datetime DEFAULT NULL,
  `demotion_reason` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `posted` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'is moderated?',
  `post_by_id` int(11) UNSIGNED NOT NULL,
  `post_in_id` int(11) UNSIGNED NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `pinned` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `pinned_by_id` int(11) UNSIGNED DEFAULT NULL,
  `pinned_date` datetime DEFAULT NULL,
  `deleted` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_by_id` int(11) UNSIGNED DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted_reason` varchar(300) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `edited` tinyint(2) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_content_edits`
--

CREATE TABLE `post_content_edits` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `edit_by_id` int(11) UNSIGNED NOT NULL,
  `edit_from` varchar(2000) NOT NULL,
  `edit_to` varchar(2000) NOT NULL,
  `edit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_deletes`
--

CREATE TABLE `post_deletes` (
  `id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `like_from_id` int(11) UNSIGNED NOT NULL,
  `like_to_id` int(11) UNSIGNED NOT NULL,
  `like_date` datetime NOT NULL DEFAULT current_timestamp(),
  `liked` tinyint(2) NOT NULL COMMENT '-2 to +2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_title_edits`
--

CREATE TABLE `post_title_edits` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `edit_from` varchar(100) NOT NULL,
  `edit_to` varchar(100) NOT NULL,
  `edit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `verify_token` int(6) UNSIGNED ZEROFILL NOT NULL,
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `newsletter_sub` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT 'NULL',
  `picture` varchar(100) NOT NULL DEFAULT '''images/picture.png''',
  `banner` varchar(100) NOT NULL DEFAULT '''images/banner.png''',
  `deleted` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_date` datetime DEFAULT NULL,
  `deleted_reason` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_blocks`
--

CREATE TABLE `user_blocks` (
  `id` int(11) UNSIGNED DEFAULT NULL,
  `blocked` tinyint(2) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'is blocked?',
  `block_from_id` int(11) UNSIGNED NOT NULL COMMENT 'user id that is blocked',
  `block_against_id` int(11) UNSIGNED NOT NULL,
  `block_date` datetime NOT NULL,
  `unblock_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_follows`
--

CREATE TABLE `user_follows` (
  `id` int(11) UNSIGNED NOT NULL,
  `followed` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `follow_from_id` int(11) UNSIGNED NOT NULL,
  `follow_to_id` int(11) UNSIGNED NOT NULL,
  `followed_date` datetime NOT NULL DEFAULT current_timestamp(),
  `unfollowed_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_friends`
--

CREATE TABLE `user_friends` (
  `id` int(11) UNSIGNED NOT NULL,
  `friends` tinyint(2) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'are friends?',
  `friend_a_id` int(11) UNSIGNED NOT NULL COMMENT 'sent request',
  `friend_b_id` int(11) UNSIGNED NOT NULL COMMENT 'accepted reqiest',
  `befriend_date` datetime NOT NULL DEFAULT current_timestamp(),
  `unfriend_by_id` int(11) UNSIGNED DEFAULT NULL,
  `unfriend_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_friend_requests`
--

CREATE TABLE `user_friend_requests` (
  `id` int(11) UNSIGNED NOT NULL,
  `requesting` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `request_from_id` int(11) UNSIGNED NOT NULL,
  `request_to_id` int(11) UNSIGNED NOT NULL,
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `response` tinyint(2) NOT NULL DEFAULT 0 COMMENT '-1 to 1',
  `response_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `message_from_id` int(11) UNSIGNED NOT NULL,
  `message_to_id` int(11) UNSIGNED NOT NULL,
  `message_date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` varchar(300) NOT NULL,
  `deleted` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_by_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_name_changes`
--

CREATE TABLE `user_name_changes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `change_from` varchar(50) NOT NULL,
  `change_to` varchar(50) NOT NULL,
  `change_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_reports`
--

CREATE TABLE `user_reports` (
  `id` int(11) UNSIGNED NOT NULL,
  `reporting` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `report_from_id` int(11) UNSIGNED NOT NULL,
  `report_against_id` int(11) UNSIGNED NOT NULL,
  `report_date` datetime NOT NULL DEFAULT current_timestamp(),
  `report` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_sign_ins`
--

CREATE TABLE `user_sign_ins` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `sign_in_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(128) NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_sign_outs`
--

CREATE TABLE `user_sign_outs` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `sign_out_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(128) NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_sign_ups`
--

CREATE TABLE `user_sign_ups` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `sign_up_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(128) NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_deletes`
--
ALTER TABLE `comment_deletes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_edits`
--
ALTER TABLE `comment_edits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `community_follows`
--
ALTER TABLE `community_follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_moderators`
--
ALTER TABLE `community_moderators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_content_edits`
--
ALTER TABLE `post_content_edits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_deletes`
--
ALTER TABLE `post_deletes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_title_edits`
--
ALTER TABLE `post_title_edits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_follows`
--
ALTER TABLE `user_follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_friends`
--
ALTER TABLE `user_friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_friend_requests`
--
ALTER TABLE `user_friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_name_changes`
--
ALTER TABLE `user_name_changes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_reports`
--
ALTER TABLE `user_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sign_ins`
--
ALTER TABLE `user_sign_ins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sign_outs`
--
ALTER TABLE `user_sign_outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sign_ups`
--
ALTER TABLE `user_sign_ups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment_deletes`
--
ALTER TABLE `comment_deletes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_edits`
--
ALTER TABLE `comment_edits`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `community_bans`
--
ALTER TABLE `community_bans`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `community_follows`
--
ALTER TABLE `community_follows`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `community_moderators`
--
ALTER TABLE `community_moderators`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `post_content_edits`
--
ALTER TABLE `post_content_edits`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_deletes`
--
ALTER TABLE `post_deletes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_title_edits`
--
ALTER TABLE `post_title_edits`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_follows`
--
ALTER TABLE `user_follows`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_friends`
--
ALTER TABLE `user_friends`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_friend_requests`
--
ALTER TABLE `user_friend_requests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_name_changes`
--
ALTER TABLE `user_name_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_reports`
--
ALTER TABLE `user_reports`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sign_ins`
--
ALTER TABLE `user_sign_ins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sign_outs`
--
ALTER TABLE `user_sign_outs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sign_ups`
--
ALTER TABLE `user_sign_ups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
