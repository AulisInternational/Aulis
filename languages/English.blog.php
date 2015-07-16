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
|| ENGLISH TRANSLATION - BLOG
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
	header("Location: index.php");
	
// Global blog strings
define('BLOG_ENTRY', "entry");
define('BLOG_ENTRIES', "entries");
define('BLOG_NO_ENTRIES_FOUND', "No entries have been found.");

// Blog information
define('BLOG_POSTED_IN', "Posted in %S");