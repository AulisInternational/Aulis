<?php
/*
|| Aulis
|| Organisation:	Aulis International
|| Website:			http://germanics.org/aulis
|| Developed by: 	Robert Monden
					Thomas de Roo
|| License: 		MIT
|| Version: 		0.01
|| * File information * 
||		-> index.php
| 		-> // This file coordinates the whole display of the site.
|| 		-> Last change: July, 2015
*/

// This is the only file that can (and should) be accessed directly. Let's make sure of that
if(!defined('aulis'))
	define('aulis', 1);
else
	exit;
	
// Important files we need to load before doing anything else
include 'au_config.php';
include 'functions/Session.php';

// Make sure we're using database sessions rather than server-based sessions
session_set_save_handler(
	'aulis_session_open',
	'aulis_session_close',
	'aulis_session_read',
	'aulis_session_write',
	'aulis_session_destroy',
	'aulis_session_cleaner'
);
	
// Start sessions
session_start();