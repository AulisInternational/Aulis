-- Adminer 3.3.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `aulis_blog_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_order` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `aulis_blog_categories` (`category_id`, `category_name`, `category_order`) VALUES
(1, 'General entries',  0),
(2, 'Music',  1),
(3, 'Countries',  -2),
(4, 'Song lyrics',  0),
(5, 'Linguistics',  0);

CREATE TABLE `aulis_blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `logged` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `aulis_blog_comments` (`comment_id`, `blog_id`, `logged`, `user_id`, `user_name`, `content`, `post_date`) VALUES
(1, 12, 0,  0,  'Gast comment', 'Dit is de allereerste comment',  '2015-07-21 23:54:11');

CREATE TABLE `aulis_blog_entries` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_intro` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blog_poster` int(11) NOT NULL,
  `blog_parse_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'markdown',
  `blog_activated` int(11) NOT NULL,
  `blog_featured` int(11) NOT NULL,
  `blog_in_queue` int(11) NOT NULL,
  `blog_can_comment` int(11) NOT NULL,
  `blog_category` int(11) NOT NULL,
  PRIMARY KEY (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `aulis_blog_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `publish_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `aulis_blog_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `aulis_blog_tags_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_id` (`entry_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `aulis_core` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request` varchar(255) NOT NULL,
  `core` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `aulis_core` (`id`, `request`, `core`) VALUES
(1, 'entry',  'ViewEntry'),
(2, 'topic',  'ViewTopic'),
(3, 'blogindex',  'BlogIndex'),
(4, 'board',  'ViewBoard');

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


CREATE TABLE `aulis_sessions` (
  `session_id` char(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `session_date` text NOT NULL,
  PRIMARY KEY (`session_id`),
  UNIQUE KEY `session_id` (`session_id`),
  FULLTEXT KEY `session_data` (`session_data`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `aulis_settings` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` text NOT NULL,
  `setting_value` text NOT NULL,
  PRIMARY KEY (`id_setting`),
  UNIQUE KEY `id_setting` (`id_setting`),
  FULLTEXT KEY `setting_name` (`setting_name`,`setting_value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `aulis_settings` (`id_setting`, `setting_name`, `setting_value`) VALUES
(1, 'theme',  'hannover'),
(2, 'site_title', 'Aulis'),
(3, 'language', 'English'),
(4, 'default_core', 'blogindex'),
(5, 'site_slogan',  'Hello'),
(6, 'enable_maintenance', '0'),
(7, 'enable_blog_url_rewriting',  '1'),
(8, 'minimum_age',  '13'),
(9, 'blog_about', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. nnThis blog is mostly about Lorem, but Ipsum is also a popular topic here.'),
(10, 'enable_cache', '1'),
(11, 'enable_query_caching', '1'),
(12, 'query_caching_time', '150'),
(13, 'security_questions', '3'),
(14, 'email_activation', '0');

CREATE TABLE IF NOT EXISTS `aulis_users` (
`user_id` int(11) NOT NULL,
  `user_username` tinytext NOT NULL,
  `user_password` text NOT NULL,
  `user_email` tinytext NOT NULL,
  `user_birthdate` tinytext NOT NULL,
  `user_regdate` tinytext NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `aulis_users` (`user_id`, `user_username`, `user_password`, `user_email`, `user_birthdate`, `user_regdate`, `user_gender`, `user_group`, `user_include_groups`, `user_avatar`, `user_signature`, `user_ip`, `user_language`, `user_theme`, `user_ban`, `user_activated`, `user_actcode`) VALUES
(1, 'Charlie',  '3d1623a30d2f71f14a1104a855230f03bfdfee0d', 'charlie@germanics.org',  '2015-07-12 00:00:00',  '2015-07-15 01:01:39',  0,  0,  '', '80183_1.png',  '', '', '1',  '', 0,  1,  '');

-- 2015-07-23 12:38:12