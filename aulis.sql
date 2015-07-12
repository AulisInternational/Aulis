-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2015 at 04:23 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aulis`
--

-- --------------------------------------------------------

--
-- Table structure for table `aulis_questions`
--

CREATE TABLE IF NOT EXISTS `aulis_questions` (
`question_id` int(11) NOT NULL,
  `question_title` text NOT NULL,
  `question_description` text NOT NULL,
  `question_answer1` text NOT NULL,
  `question_answer2` text NOT NULL,
  `question_language` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aulis_sessions`
--

CREATE TABLE IF NOT EXISTS `aulis_sessions` (
  `session_id` char(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `session_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aulis_settings`
--

CREATE TABLE IF NOT EXISTS `aulis_settings` (
`id_setting` int(11) NOT NULL,
  `setting_name` text NOT NULL,
  `setting_value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aulis_settings`
--

INSERT INTO `aulis_settings` (`id_setting`, `setting_name`, `setting_value`) VALUES
(1, 'lang_default', 'English'),
(2, 'theme_default', 'Hurricane'),
(3, 'forum_title', 'Aulis'),
(4, 'forum_slogan', 'Let''s build a community'),
(5, 'email_activation', '0'),
(6, 'minimum_age', '13'),
(7, 'security_questions', '2');

-- --------------------------------------------------------

--
-- Table structure for table `aulis_users`
--

CREATE TABLE IF NOT EXISTS `aulis_users` (
`user_id` int(11) NOT NULL,
  `user_username` tinytext NOT NULL,
  `user_password` text NOT NULL,
  `user_email` tinytext NOT NULL,
  `user_birthdate` tinytext NOT NULL,
  `user_gender` int(11) NOT NULL,
  `user_group` int(11) NOT NULL,
  `user_include_groups` mediumtext NOT NULL,
  `user_avatar` text NOT NULL,
  `user_signature` text NOT NULL,
  `user_ip` tinytext NOT NULL,
  `user_language` tinytext NOT NULL,
  `user_theme` tinytext NOT NULL,
  `user_ban` smallint(6) NOT NULL,
  `user_activated` int(11) NOT NULL,
  `user_actcode` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aulis_questions`
--
ALTER TABLE `aulis_questions`
 ADD PRIMARY KEY (`question_id`), ADD UNIQUE KEY `question_id` (`question_id`), ADD FULLTEXT KEY `question_title` (`question_title`,`question_description`,`question_answer1`,`question_answer2`,`question_language`);

--
-- Indexes for table `aulis_sessions`
--
ALTER TABLE `aulis_sessions`
 ADD PRIMARY KEY (`session_id`), ADD UNIQUE KEY `session_id` (`session_id`), ADD FULLTEXT KEY `session_data` (`session_data`);

--
-- Indexes for table `aulis_settings`
--
ALTER TABLE `aulis_settings`
 ADD PRIMARY KEY (`id_setting`), ADD UNIQUE KEY `id_setting` (`id_setting`), ADD FULLTEXT KEY `setting_name` (`setting_name`,`setting_value`);

--
-- Indexes for table `aulis_users`
--
ALTER TABLE `aulis_users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_id` (`user_id`), ADD FULLTEXT KEY `user_username` (`user_username`,`user_password`,`user_email`,`user_birthdate`,`user_include_groups`,`user_avatar`,`user_signature`,`user_ip`,`user_language`,`user_theme`), ADD FULLTEXT KEY `user_actcode` (`user_actcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aulis_questions`
--
ALTER TABLE `aulis_questions`
MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `aulis_settings`
--
ALTER TABLE `aulis_settings`
MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `aulis_users`
--
ALTER TABLE `aulis_users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
