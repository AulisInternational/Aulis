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

// The database will be set up below this line
au_setup_database();

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

// Let's load the language files
au_load_language(au_get_setting("language"));

// The following part makes sure the right code is loaded

// If there is no core request in the URL, we need to simulate one.
if(empty($_GET))
	$_GET[au_get_setting("default_core")] = '';

// ^ we can do either that, or redirect via au_url("?" . au_get_setting("default_core"), true)

// Get the cores from the database
$cores = au_get_cores();

// Go through the cores
while($core = $cores->fetchObject()){

	// if the request of this core has been given in the URL, we need to load it.
	if(isset($_GET[$core->request])){

		// loading the core...
		au_load_core($core->core);

		// escaping from this loop...
		break;

	}

}

// Now it's time to finalize our output and call in the theme's base template
au_finalize_output();

// Calling the theme...
if(!au_load_theme(au_get_setting("theme")))
	die("Fatal error: theme cannot be loaded.");

// In the end, there is nothing left but star dust.
die();