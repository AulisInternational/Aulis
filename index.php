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

// This is the only file that can (and should) be accessed directly. Let's make sure of that.
if(!defined('aulis'))
	define('aulis', 1);
else
	exit;
	
// Important files we need to load before doing anything else.
include 'au_config.php';
global $aulis;

// It's not like that's all, we need our functions to be loaded too
foreach (glob($aulis['root_path']."/core/functions/*.functions.php") as $filename)
	include $filename;

// Make sure we're using database sessions rather than server-based sessions
// GIVES ERROR, SO I DISABLED IT FOR NOW
/* session_set_save_handler(
	'au_session_open',
	'au_session_close',
	'au_session_read',
	'au_session_write',
	'au_session_destroy',
	'au_session_cleaner'
); */
	
// Start sessions
session_start();

// The following part makes sure the right code is loaded
au_error_box("There is nothing to see here as of now, please come back later.");

// Now it's time to finalize our output and call in the theme's base template
au_finalize_output();

// Calling the theme...
if(!au_load_theme(au_get_setting("theme")))
	die("Fatal error: theme cannot be loaded.");

// In the end, there is nothing left but star dust.
die();