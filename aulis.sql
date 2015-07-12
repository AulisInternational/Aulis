-- Adminer 3.3.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `aulis_questions`;
CREATE TABLE `aulis_questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_title` text NOT NULL,
  `question_description` text NOT NULL,
  `question_answer1` text NOT NULL,
  `question_answer2` text NOT NULL,
  `question_language` tinytext NOT NULL,
  PRIMARY KEY (`question_id`),
  UNIQUE KEY `question_id` (`question_id`),
  FULLTEXT KEY `question_title` (`question_title`,`question_description`,`question_answer1`,`question_answer2`,`question_language`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `aulis_sessions`;
CREATE TABLE `aulis_sessions` (
  `session_id` char(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `session_date` text NOT NULL,
  PRIMARY KEY (`session_id`),
  UNIQUE KEY `session_id` (`session_id`),
  FULLTEXT KEY `session_data` (`session_data`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `aulis_settings`;
CREATE TABLE `aulis_settings` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` text NOT NULL,
  `setting_value` text NOT NULL,
  PRIMARY KEY (`id_setting`),
  UNIQUE KEY `id_setting` (`id_setting`),
  FULLTEXT KEY `setting_name` (`setting_name`,`setting_value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `aulis_settings` (`id_setting`, `setting_name`, `setting_value`) VALUES
(1,	'theme',	'hannover'),
(2,	'site_title',	'Aulis');

DROP TABLE IF EXISTS `aulis_users`;
CREATE TABLE `aulis_users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2015-07-13 01:16:12