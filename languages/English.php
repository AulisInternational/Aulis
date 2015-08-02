<?php
/*
|| Aulis
|| Organisation:		Aulis International
|| Website:				http://germanics.org/aulis
|| Developed by:	 	Robert Monden
						Thomas de Roo
|| License: 			MIT
|| Version: 			1.1 Alpha 1
||
||------------------------------------------------
|| ENGLISH TRANSLATION
||------------------------------------------------
|| Software version:	1.1 Alpha 1
|| Version:				1.0.0
|| Dialect:				American English
|| Translators:			Thomas de Roo
||						Robert Monden
|| License:				MIT
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header('Location: index.php');
	
global $setting;

$setting['sub_files'] = array('blog', 'admin');
	
// Some basic information about the language itself
define('LANGUAGE_NAME', 'English (US)');
define('LANGUAGE_CODE', 'en');
define('LANGUAGE_NUMBER_DECIMALS_SEPARATOR', '.');
define('LANGUAGE_NUMBER_DECIMALS', 2);
define('LANGUAGE_NUMBER_THOUSANDS_SEPARATOR', ',');

// Strings that are used pretty much everywhere
define('FOOTER_LANGUAGE', 'Language: ');
define('FOOTER_PAGE_GENERATED', 'Page generated in %s ms with %s queries.');

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
define('MENU_MOD', 'Security');
define('MENU_REGISTER', 'Sign up');
define('MENU_LOGIN', 'Log in');

// Page titles
define('TITLE_FORUM', 'Forum');
define('TITLE_LOGIN', 'Log in');
define('TITLE_REGISTER', 'Register');

// The registration page
define('REGISTER', 'Register new account');
define('REGISTER_WELCOME', 'Thank you for choosing to register an account with ' . $setting['site_title'] . '. The registration process only lasts a few minutes, and after that you\'ll be able to post new topics, reply to existing ones, and much more!');
define('REGISTER_USERNAME', 'Username:');
define('REGISTER_USERNAME_DESCRIPTION', 'Your username, this will be used to distinguish your posts from those made by other accounts. Maximum length: 16 characters.');
define('REGISTER_PASSWORD', 'Password:');
define('REGISTER_PASSWORD_DESCRIPTION', 'For protection, needs to be at least 5 characters, contain both capital and lower case characters, and have a maximum length of 16 characters. Cannot contain your username, and should include at least 1 number.');
define('REGISTER_PASSWORD2', 'Confirm password:');
define('REGISTER_PASSWORD2_DESCRIPTION', 'Confirm the password you provided above by retyping it here.');
define('REGISTER_EMAIL', 'Email address:');
define('REGISTER_EMAIL_DESCRIPTION', 'If this forum uses activation by email, an activation link will be sent to this email address.');
define('REGISTER_BIRTHDATE', 'Date of birth:');
define('REGISTER_BIRTHDATE_DESCRIPTION', 'Your birthdate. This forum requires users to be at least <i>' . $setting['minimum_age'] . '</i> years old.');
define('REGISTER_SUBMIT', 'Register');
define('REGISTER_SIGN_AGREEMENT', 'Registration agreement:');
define('REGISTER_AGREEMENT', 'As a member of this forum, you will agree never to post content that could be considered hateful, discriminating, harassing or anything sort alike. By registering to this forum, you authorize us to remove any content that violates our forum rules. You will be expected to comply with the forum rules, and will not try to work around bans received for breaking them.<br /><br />Users are required to provide an email address and their birthdate. These personal details will NEVER be shared with outsiders, and it is the administrators\' duty to make sure this doesn\'t happen. When pressing the submit button, your IP address is included in the registration process, and will never be shared with outsiders.<br /><br />This forum makes use of cookies, and by registering to this forum, you agree to this. These cookies are only used for functions like login, logout.<br /><br />This forum has a minimum age of ' . $setting['minimum_age'] . ' years, and you agree to be at least of that age.<br /><br />The ' . $setting['site_title'] . ' team reserves the right to delete your account at any time, with or without warning.<br /><br />By registering to this forum, you agree to the terms and conditions of this registration agreement, and agree to be legally bound by it.');
define('REGISTER_PLEASE_NO_BLANK_USERNAME', 'Please enter a username.');
define('REGISTER_PLEASE_NO_BLANK_PASSWORD', 'Please enter a password.');
define('REGISTER_PLEASE_NO_BLANK_PASSWORD2', 'Please confirm your password.');
define('REGISTER_PLEASE_NO_BLANK_EMAIL', 'Please enter your email address.');
define('REGISTER_PLEASE_NO_BLANK_BIRTHDATE', 'Please enter your birthdate.');
define('REGISTER_USERNAME_TOO_LONG', 'The username you provided is too long. Usernames can only have 16 characters.');
define('REGISTER_USERNAME_TOO_SHORT', 'The username you provided is too short. Usernames should have at least 5 characters.');
define('REGISTER_USERNAME_NO_HTML', 'Usernames should not contain HTML.');
define('REGISTER_PASSWORD_TOO_LONG', 'The password you provided is too long. Passwords shouldn\'t contain more than 16 characters.');
define('REGISTER_PASSWORD_TOO_SHORT', 'The password you provided is too short. Passwords should have at least 16 characters.');
define('REGISTER_PASSWORD_WEAK', 'The password you provided is too weak. Passwords must contain both capital and lower case characters, and at least one number.');
define('REGISTER_PASSWORD_NO_USERNAME', 'The password cannot be the same as the username.');
define('REGISTER_PASSWORD_NO_MATCH', 'The provided passwords do not match.');
define('REGISTER_EMAIL_INVALID', 'Please enter a valid email address.');
define('REGISTER_BIRTHDATE_DAY_NOT_NUMERIC', 'Please select a day of birth from the select box.');
define('REGISTER_BIRTHDATE_MONTH_NOT_NUMERIC', 'Please select a month of birth from the select box.');
define('REGISTER_BIRTHDATE_YEAR_NOT_NUMERIC', 'Please select a year of birth from the select box.');
define('REGISTER_BIRTHDATE_WRONG', 'The provided date of birth is incorrect.');
define('REGISTER_CONFIRM_AGE', 'Please confirm your age.');
define('REGISTRATION_FAILED', 'Unfortunately we weren\'t able to add your account to the database. Please try again.');
define('REGISTER_USERNAME_UNAVAILABLE', 'There is already a user registered by that username.');
define('REGISTER_EMAIL_IN_USE', 'The specified email is already in use by another member.');
define('REGISTER_DONE', 'Registration successful');
define('REGISTER_DONE_DESC', 'Your account was successfully registered. You are now a full member of the forum, meaning you can now post new topics, reply to existing ones, communicate with other members, and much more.<br /><br /><a href="' . $aulis['file'] . '">Click here to return to the site index</a>');
define('REGISTER_TOO_YOUNG', 'Unfortunately we are not able to register your account, due to the minimum age being ' . $setting['minimum_age']);
define('REGISTER_QUESTION_WRONG', 'The answer to the following registration question was incorrect: ');
define('REGISTER_QUESTION_FRAUD', 'Please fill in all registration questions.');

// Let's log in
define('LOGIN', 'Forum login');
define('LOGIN_USERNAME', 'Username:');
define('LOGIN_PASSWORD', 'Password:');
define('LOGIN_SUBMIT', 'Login');
define('LOGIN_ACTIVATE_ACCOUNT', 'Activate my account');
define('LOGIN_RESET_PASSWORD', 'I forgot my password');
define('LOGIN_NO_USERNAME', 'Please enter your username.');
define('LOGIN_NO_PASSWORD', 'Please enter your password.');
define('LOGIN_USERNAME_NO_HTML', 'Usernames can\'t contain HTML.');
define('LOGIN_FOREVER', 'Stay logged in forever');
define('LOGIN_PASSWORD_FAIL', 'The entered password was incorrect. Please try again.');
define('LOGIN_SUCCESS_TITLE', 'Login successful');
define('LOGIN_SUCCESS', 'You have successfully logged in. Please click on the link below to proceed.');
define('LOGIN_LINK', 'Click here to proceed to the board index');