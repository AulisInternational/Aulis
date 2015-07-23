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

INSERT INTO `aulis_blog_entries` (`entry_id`, `blog_name`, `blog_intro`, `blog_content`, `blog_date`, `blog_poster`, `blog_parse_mode`, `blog_activated`, `blog_featured`, `blog_in_queue`, `blog_can_comment`, `blog_category`) VALUES
(4, 'Abbey Road', '', 'Abbey Road is the eleventh studio album by the English rock band the Beatles, released on 26 September 1969 in the United Kingdom and on 1 October 1969 in the United States. The recording sessions for the album were the last in which all four Beatles participated. \n\nAlthough Let It Be was the final album that the Beatles completed before the band\'s dissolution in April 1970, most of the album had been recorded before the Abbey Road sessions began.[1] A double A-side single from the album, \"Something\"/\"Come Together\", released in October, topped the Billboard chart in the US.\n\nAbbey Road is a rock album[2] that incorporates genres such as blues, pop and progressive rock,[3] and it makes prominent use of the Moog synthesizer and the Leslie speaker. Side two contains a medley of nine songs that has subsequently been covered by other notable artists. The album was recorded amidst a more collegial atmosphere than the Get Back/Let It Be sessions earlier in the year, but there were still frequent confrontations within the band, particularly over Paul McCartney\'s song \"Maxwell\'s Silver Hammer\", one of four tracks on which John Lennon did not perform. He had privately left the group by the time the album was released and McCartney publicly quit the following year.', '2015-07-21 17:57:39',  1,  'markdown', 1,  0,  0,  1,  2),
(5, 'Let it be',  '', 'Let It Be is the twelfth and final studio album by the British rock band the Beatles. It was released on 8 May 1970, almost a month after the group\'s break-up. Like most of the band\'s previous releases, it was a number one album in many countries, including both the US and the UK, and was released in tandem with the motion picture of the same name.\n\nThe album was conceived as Get Back, a return to the Beatles\' earlier, less complicated approach to music. It was recorded and projected for release before their album Abbey Road (1969). For this reason, some critics and fans, such as Mark Lewisohn, argue that Abbey Road should be considered the group\'s final album and Let It Be the penultimate.\n\nThe recording sessions began at Twickenham Film Studios in January 1969 as part of a planned documentary showing the Beatles preparing to return to live performance. A project instigated by Paul McCartney, the filmed rehearsals were marked by ill-feeling within the band, leading to George Harrison\'s temporary departure from the group. As a condition of his return, the Beatles reconvened at their own Apple Studio, where they completed the recordings with the help of guest musician Billy Preston.',  '2015-07-21 17:56:50',  1,  'markdown', 1,  0,  0,  1,  2),
(6, 'Hedgehog', '', 'A hedgehog is any of the spiny mammals of the subfamily Erinaceinae, which is in the order Erinaceomorpha. There are seventeen species of hedgehog in five genera, found through parts of Europe, Asia, Africa and New Zealand (by introduction). There are no hedgehogs native to Australia, and no living species native to the Americas. Hedgehogs share distant ancestry with shrews (family Soricidae), with gymnures possibly being the intermediate link, and have changed little over the last 15 million years.[2] Like many of the first mammals, they have adapted to a nocturnal way of life.[3] Hedgehogs\' spiny protection resembles that of the unrelated rodent porcupines and monotreme echidnas.\n\nThe name hedgehog came into use around the year 1450, derived from the Middle English heyghoge, from heyg, hegge (\"hedge\"), because it frequents hedgerows, and hoge, hogge (\"hog\"), from its piglike snout.[4] Other names include urchin, hedgepig and furze-pig. The collective noun for a group of hedgehogs is array or prickle.', '2015-07-21 17:57:39',  1,  'markdown', 1,  0,  0,  1,  1),
(9, 'The Netherlands',  '', 'The Netherlands&#x27; name literally means &#x22;Low Countries&#x22;, influenced by its low land and flat geography, with only about 50% of its land exceeding one metre above sea level.[13] Most of the areas below sea level are man-made. Since the late 16th century, large areas (polders) have been reclaimed from the sea and lakes, amounting to nearly 17% of the country&#x27;s current land mass.\n\nWith a population density of 407 people per km&#xB2; &#x2013; 500 if water is excluded &#x2013; the Netherlands is a very densely populated country for its size. Only Bangladesh, South Korea, and Taiwan have both a larger population and a higher population density. Nevertheless, the Netherlands is the world&#x27;s second-largest exporter of food and agricultural products, after the United States.[14][15] This is due to the fertility of the soil and the mild climate.',  '2015-07-21 17:57:08',  1,  'markdown', 1,  0,  0,  1,  3),
(11,  'Get Back lyrics',  '', 'Jojo was a man who thought he was a loner\nBut he knew it wouldn\'t last.\nJojo left his home in Tucson, Arizona\nFor some California grass.\n\nGet back, get back.\nGet back to where you once belonged\nGet back, get back.\nGet back to where you once belonged.\nGet back Jojo. Go home\nGet back, get back.\nBack to where you once belonged\nGet back, get back.\nBack to where you once belonged.\nGet back Jo.\n\nSweet Loretta Martin thought she was a woman\nBut she was another man\nAll the girls around her say she\'s got it coming\nBut she gets it while she can\n\nGet back, get back.\nGet back to where you once belonged\nGet back, get back.\nGet back to where you once belonged.\nGet back Loretta. Go home\nGet back, get back.\nGet back to where you once belonged\nGet back, get back.\nGet back to where you once belonged.\nSongwriters: Lennon, John / Mccartney, Paul James',  '2015-07-21 18:02:13',  1,  'markdown', 1,  0,  0,  1,  4),
(12,  'Bluegrass music',  '', 'Bluegrass music is a form of American roots music, and a subgenre of country music. Bluegrass was inspired by the music of Appalachia.[1] It has mixed roots in Irish, Scottish, Welsh, and English[2] traditional music, and also later influenced by the music of African-Americans[3] through incorporation of jazz elements. Settlers from the United Kingdom and Ireland arrived in Appalachia during the 18th century, and brought with them the musical traditions of their homelands. These traditions consisted primarily of English and Scottish ballads&#x2014;which were essentially unaccompanied narrative&#x2014;and dance music, such as Irish reels, which were accompanied by a fiddle.[4] Many older bluegrass songs come directly from the British Isles. Several Appalachian bluegrass ballads, such as &#x22;Pretty Saro&#x22;, &#x22;Barbara Allen&#x22;, &#x22;Cuckoo Bird&#x22; and &#x22;House Carpenter&#x22;, come from England and preserve the English ballad tradition both melodically and lyrically.[5] Others, such as The Twa Sisters, also come from England; however, the lyrics are about Ireland.[6] Some bluegrass fiddle songs popular in Appalachia, such as &#x22;Leather Britches&#x22;, and &#x22;Pretty Polly&#x22;, have Scottish roots.[7] The dance tune Cumberland Gap may be derived from the tune that accompanies the Scottish ballad Bonnie George Campbell.[8] Other songs have different names in different places; for instance in England there is an old ballad known as &#x22;A Brisk Young Sailor Courted Me&#x22;, but exactly the same song in North American bluegrass is known as &#x22;I Wish My Baby Was Born&#x22;.[9]', '2015-07-21 18:26:03',  1,  'markdown', 1,  0,  0,  1,  2),
(13,  'Irish declension', '', 'Nouns in Irish are divided into two genders, masculine and feminine. While gender should be learned when the noun is learned, there are some rules that can be followed:\n\nIn general, words ending in a broad consonant are masculine, while words ending in a slender consonant are feminine.\n\nThere are some exceptions, mostly dealing with specific endings and suffixes; for example, words ending in -&#xF3;ir/-eoir and -&#xED;n (with a slender /&#x27E;&#x2B2;/ and /n&#x2B2;/ respectively) are masculine, while words ending in -&#xF3;g/-eog (with a broad /&#x261;/) are feminine. This leads to some unexpected gender assignments, such as cail&#xED;n &#x22;girl&#x22; (masculine) and gas&#xF3;g &#x22;boy scout&#x22; (feminine).\n\nIrish has four cases: common (usually called nominative, but it covers the role of an accusative as well), vocative, genitive, and dative.',  '2015-07-22 00:15:27',  1,  'markdown', 1,  0,  0,  1,  5),
(14,  'The copula', '', 'In linguistics, a copula (plural: copulas or copulae) is a word used to link the subject of a sentence with a predicate (a subject complement), such as the word is in the sentence &#x22;The sky is blue.&#x22; The word copula derives from the Latin noun for a &#x22;link&#x22; or &#x22;tie&#x22; that connects two different things.[1]\n\nA copula is often a verb or a verb-like word, though this is not universally the case.[2] A verb that is a copula is sometimes called a copulative or copular verb. In English primary education grammar courses, a copula is often called a linking verb. In other languages, copulas show more resemblances to pronouns, as in Classical Chinese and Guarani, or may take the form of suffixes attached to a noun, as in Beja, Ket, and Inuit languages.\n\nMost languages have one main copula (although some, like Spanish, Portuguese and Thai, have more than one, and some have none). In the case of English, this is the verb to be. While the term copula is generally used to refer to such principal forms, it may also be used to refer to some other verbs with similar functions, like become, get, feel and seem in English (these may also be called &#x22;semi-copulas&#x22; or &#x22;pseudo-copulas&#x22;).',  '2015-07-22 00:18:02',  1,  'markdown', 1,  0,  0,  1,  5),
(15,  'Markdown test',  '', '## Markdown is awesome\n\n- We \n- Can \n- Make\n- Lists\n\nAnd... **tables**:\n\n|tabeles     |do       |work   |\n|---   |---    |---  |\n|really    |       |     |\n|they    |do       |     |\n\nHere\'s a footnote [^1].\n\n[^1]: Footnote text goes here.', '2015-07-23 01:10:09',  1,  'markdown', 1,  0,  0,  1,  4);

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
(9, 'blog_about', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. \n\nThis blog is mostly about Lorem, but Ipsum is also a popular topic here.'),
(10,  'enable_cache', '1'),
(11,  'enable_query_caching', '1'),
(12,  'query_caching_time', '600'),
(13,  'security_questions', '3'),
(14,  'caching_time', '450');

CREATE TABLE `aulis_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` tinytext NOT NULL,
  `user_password` text NOT NULL,
  `user_email` tinytext NOT NULL,
  `user_birthdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_regdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `user_actcode` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `aulis_users` (`user_id`, `user_username`, `user_password`, `user_email`, `user_birthdate`, `user_regdate`, `user_gender`, `user_group`, `user_include_groups`, `user_avatar`, `user_signature`, `user_ip`, `user_language`, `user_theme`, `user_ban`, `user_activated`, `user_actcode`) VALUES
(1, 'Charlie',  '3d1623a30d2f71f14a1104a855230f03bfdfee0d', 'charlie@germanics.org',  '2015-07-12 00:00:00',  '2015-07-15 01:01:39',  0,  0,  '', '80183_1.png',  '', '', '1',  '', 0,  1,  ''),

-- 2015-07-23 22:24:40