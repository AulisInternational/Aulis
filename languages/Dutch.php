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
|| Dialect:				Northern Netherlandic
|| Translators:			Thomas de Roo
||						Robert Monden
|| License:				MIT
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header('Location: index.php');
	
// Some basic information about the language itself
define('LANGUAGE_NAME', 'Nederlands (Nederland)');
define('LANGUAGE_CODE', 'nl');

// Strings that are used pretty much everywhere
define('FOOTER_LANGUAGE', 'Taal: ');

// These strings are used for dates
define('DATE_TODAY', 'Vandaag');
define('DATE_YESTERDAY', 'Gisteren');
define('DATE_TOMORROW', 'Morgen');

define('DATE_DAY_0', 'zondag');
define('DATE_DAY_1', 'maandag');
define('DATE_DAY_2', 'dinsdag');
define('DATE_DAY_3', 'woensdag');
define('DATE_DAY_4', 'donderdag');
define('DATE_DAY_5', 'vrijdag');
define('DATE_DAY_6', 'zaterdag');

define('DATE_MONTH_1', 'januari');
define('DATE_MONTH_2', 'februari');
define('DATE_MONTH_3', 'maart');
define('DATE_MONTH_4', 'april');
define('DATE_MONTH_5', 'mei');
define('DATE_MONTH_6', 'juni');
define('DATE_MONTH_7', 'juli');
define('DATE_MONTH_8', 'augustus');
define('DATE_MONTH_9', 'september');
define('DATE_MONTH_10', 'oktober');
define('DATE_MONTH_11', 'november');
define('DATE_MONTH_12', 'december');

define('DATE_MONTH_SHORT_1', 'jan');
define('DATE_MONTH_SHORT_2', 'feb');
define('DATE_MONTH_SHORT_3', 'maa');
define('DATE_MONTH_SHORT_4', 'apr');
define('DATE_MONTH_SHORT_5', 'mei');
define('DATE_MONTH_SHORT_6', 'jun');
define('DATE_MONTH_SHORT_7', 'jul');
define('DATE_MONTH_SHORT_8', 'aug');
define('DATE_MONTH_SHORT_9', 'sep');
define('DATE_MONTH_SHORT_10', 'okt');
define('DATE_MONTH_SHORT_11', 'nov');
define('DATE_MONTH_SHORT_12', 'dec');

define('DATE_DAYNUMBERAFTER', false);
define('DATE_USESHORTMONTHS', false);
define('DATE_ADDSUFFIX', false);
define('DATE_ADDTIMEZONEINDICATOR', true);
define('DATE_USE12HOUR', false);
define('DATE_SEPERATOR', ' ');
define('DATE_PREPOSITION_TIME', 'om');