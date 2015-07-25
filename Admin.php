<?php
/*
|| Aulis
|| Organisation:	Aulis International
|| Website:			http://germanics.org/aulis
|| Developed by: 	Robert Monden
					Thomas de Roo
|| License: 		MIT
|| Version: 		1.1 Alpha 1
|| * File information * 
||		-> Admin.php
| 		-> // This file contains the administration panel
|| 		-> Last change: July, 2015
*/

// DEBUG <1.1 ALPHA 1> [These constants are only used for debugging]
define("DEBUG_SHOW_QUERIES", false); // Functionality is in au_query, REMEMBER TO TURN OFF!!
define("DEBUG_SHOW_PREFORMANCE", true); // Functionality is in base_template.php, REMEMBER TO TURN OFF!!
define("DEBUG_FORCE_DISABLE_CACHE", false); // Functionality is in base_template.php, REMEMBER TO TURN OFF!!

// We need to do is, otherwise other files will shut us out.
if(!defined('aulis'))
	define('aulis', 1);
else
	exit;
	
// Important files we need to load before doing anything else.
require_once 'au_config.php';

// The big $aulis is our friend, he needs to be by our side, also here in the Admin Panel.
global $aulis;

// It's not like that's all, we need our functions to be loaded too
foreach($aulis['load_functions'] as $filename)
	require_once $aulis['root_path'] . '/core/functions/' . $filename . '.functions.php';

// The database will be set up below this line
au_setup_database();

// Get the settings
$setting = au_get_settings();
	
// Start sessions
session_start();

// Load the user information into $aulis
au_load_user();

// We might not need the theme at first, but we do need some of its settings to be loaded
au_load_theme_settings();

// Let's load the language files, I mean, we want to communicate with them, right?
au_load_language($setting['language']);

		
// We need a page title. Let's create one.
$aulis['page_title'] = $setting['site_title'] . ' | ' .  ADMIN_PAGE_TITLE;
	
// Now it's time to finalize our output and call in the theme's base template
au_finalize_output();

// Calling the theme... for the admin template this time.
au_load_theme($setting['theme'], true);

// In the end, there is nothing left but star dust.
die();