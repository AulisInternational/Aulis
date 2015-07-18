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

define('DATE_DAY_0', 'Zondag');
define('DATE_DAY_1', 'Maandag');
define('DATE_DAY_2', 'Dinsdag');
define('DATE_DAY_3', 'Woensdag');
define('DATE_DAY_4', 'Donderdag');
define('DATE_DAY_5', 'Vrijdag');
define('DATE_DAY_6', 'Zaterdag');

define('DATE_MONTH_1', 'Januari');
define('DATE_MONTH_2', 'Februari');
define('DATE_MONTH_3', 'Maart');
define('DATE_MONTH_4', 'April');
define('DATE_MONTH_5', 'Mei');
define('DATE_MONTH_6', 'Juni');
define('DATE_MONTH_7', 'Juli');
define('DATE_MONTH_8', 'Augustus');
define('DATE_MONTH_9', 'September');
define('DATE_MONTH_10', 'Oktober');
define('DATE_MONTH_11', 'November');
define('DATE_MONTH_12', 'December');

define('DATE_MONTH_SHORT_1', 'Jan');
define('DATE_MONTH_SHORT_2', 'Feb');
define('DATE_MONTH_SHORT_3', 'Maa');
define('DATE_MONTH_SHORT_4', 'Apr');
define('DATE_MONTH_SHORT_5', 'Mei');
define('DATE_MONTH_SHORT_6', 'Jun');
define('DATE_MONTH_SHORT_7', 'Jul');
define('DATE_MONTH_SHORT_8', 'Aug');
define('DATE_MONTH_SHORT_9', 'Sep');
define('DATE_MONTH_SHORT_10', 'Okt');
define('DATE_MONTH_SHORT_11', 'Nov');
define('DATE_MONTH_SHORT_12', 'Dec');

define('DATE_DAYNUMBERAFTER', false);
define('DATE_USESHORTMONTHS', true);
define('DATE_ADDSUFFIX', true);
define('DATE_ADDTIMEZONEINDICATOR', true);
define('DATE_USE12HOUR', false);
define('DATE_SEPERATOR', ', ');
define('DATE_PREPOSITION_TIME', 'om');