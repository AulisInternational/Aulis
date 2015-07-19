<?php
/*
|| Aulis
|| Organisation:		Aulis International
|| Website:				http://germanics.org/aulis
|| Developed by:	 	Robert Monden
						Thomas de Roo
|| License: 			MIT
|| Version: 			0.01
||
||------------------------------------------------
|| ENGLISH TRANSLATION
||------------------------------------------------
|| Software version:	0.01
|| Version:				1.0.0
|| Dialect:				American English
|| Translators:			Thomas de Roo
||						Robert Monden
|| License:				MIT
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header('Location: index.php');
	
// Some basic information about the language itself
define('LANGUAGE_NAME', 'English (US)');
define('LANGUAGE_CODE', 'en');

// Strings that are used pretty much everywhere
define('FOOTER_LANGUAGE', 'Language: ');

// These strings are used for dates
define('DATE_TODAY', 'Today');
define('DATE_YESTERDAY', 'Yesterday');
define('DATE_TOMORROW', 'Tomorrow');

define('DATE_DAY_0', 'Sunday');
define('DATE_DAY_1', 'Monday');
define('DATE_DAY_2', 'Tuesday');
define('DATE_DAY_3', 'Wednesday');
define('DATE_DAY_4', 'Thursday');
define('DATE_DAY_5', 'Friday');
define('DATE_DAY_6', 'Saturday');

define('DATE_MONTH_1', 'January');
define('DATE_MONTH_2', 'February');
define('DATE_MONTH_3', 'March');
define('DATE_MONTH_4', 'April');
define('DATE_MONTH_5', 'May');
define('DATE_MONTH_6', 'June');
define('DATE_MONTH_7', 'July');
define('DATE_MONTH_8', 'August');
define('DATE_MONTH_9', 'September');
define('DATE_MONTH_10', 'October');
define('DATE_MONTH_11', 'November');
define('DATE_MONTH_12', 'December');

define('DATE_MONTH_SHORT_1', 'Jan');
define('DATE_MONTH_SHORT_2', 'Feb');
define('DATE_MONTH_SHORT_3', 'Mar');
define('DATE_MONTH_SHORT_4', 'Apr');
define('DATE_MONTH_SHORT_5', 'May');
define('DATE_MONTH_SHORT_6', 'Jun');
define('DATE_MONTH_SHORT_7', 'Jul');
define('DATE_MONTH_SHORT_8', 'Aug');
define('DATE_MONTH_SHORT_9', 'Sep');
define('DATE_MONTH_SHORT_10', 'Oct');
define('DATE_MONTH_SHORT_11', 'Nov');
define('DATE_MONTH_SHORT_12', 'Dec');

define('DATE_DAYNUMBERAFTER', true);
define('DATE_USESHORTMONTHS', true);
define('DATE_ADDSUFFIX', true);
define('DATE_ADDTIMEZONEINDICATOR', true);
define('DATE_USE12HOUR', true);
define('DATE_SEPERATOR', ', ');
define('DATE_PREPOSITION_TIME', 'at');

// Menu strings
define('MENU_INDEX', 'Frontpage');
define('MENU_BLOG', 'Blog');
define('MENU_FORUM', 'Forum');
define('MENU_ADMIN', 'Admin CP');
define('MENU_MOD', 'Moderation');
define('MENU_REGISTER', 'Sign up');