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
||		-> index.php
| 		-> // This file coordinates the whole display of the site.
|| 		-> Last change: July, 2015
*/

// Starting the timer, because we like measuring things, duh.
$start_time = array_sum(explode(' ', microtime()));

// DEBUG <1.1 ALPHA 1> [These constants are only used for debugging]
define("DEBUG_SHOW_QUERIES", false); // Functionality is in au_query, REMEMBER TO TURN OFF!!
define("DEBUG_SHOW_PREFORMANCE", true); // Functionality is in base_template.php, REMEMBER TO TURN OFF!!
define("DEBUG_FORCE_DISABLE_CACHE", false); // Functionality is in base_template.php, REMEMBER TO TURN OFF!!

// This is the only file that can (and should) be accessed directly. Let's make sure of that.
if(!defined('aulis'))
	define('aulis', 1);
else
	exit;
	
// Important files we need to load before doing anything else.
require_once 'au_config.php';

// The big $aulis is our friend, he needs to be by our side.
global $aulis;

// We have a first task for $aulis the great, he needs to keep track of the time, $start_time is getting fired
$aulis['start_time'] = $start_time;
unset($start_time);

// Ok, we need a copyright line. We might as well create it here
$aulis['copyright'] = 'Powered by Aulis ' . $aulis['version'];

// What function files do we need?
$load_functions = array('blog', 'cache', 'core', 'database', 'global', 'hash', 'languages', 'menu', 'output', 'pagination', 'sessions', 'settings', 'themes', 'user');

	// It's not like that's all, we need our functions to be loaded too
	foreach($load_functions as $filename)
		require_once $aulis['root_path'] . '/core/functions/' . $filename . '.functions.php';

// The database will be set up below this line
au_setup_database();


// Get the settings
$setting = au_get_settings();

// Now if we need to cache, we need to cache, obviously
if($setting['enable_cache'] == 1 && !DEBUG_FORCE_DISABLE_CACHE)
	require_once au_get_path_from_root('cache/cache_start.php');
	
// Start sessions
session_start();

// Load the user information into $aulis
au_load_user();

// We might not need the theme at first, but we do need some of its settings to be loaded
au_load_theme_settings();

// Let's load the language files, I mean, we want to communicate with them, right?
au_load_language($setting['language']);

// Information about apps and their cores are listed and added to $aulis in /core/_CoreArray.php
require_once au_get_path_from_root('core/_CoreArray.php');

	// Verify the user's input
	if(!empty($_GET['app']) && array_key_exists($_GET['app'], $aulis['apps']))
		$current_app = $_GET['app'];

	// Okay, the requested app doesn't exist
	elseif(empty($_GET['app']) || !array_key_exists($_GET['app'], $aulis['apps']))
		$current_app = 'frontpage';
		
	// Things are fine the way they are
	else
		$current_app = $_GET['app'];
		
	// Do we need to load an extra file?
	if($aulis['apps'][$current_app]['load_file'] == true)
		require_once $aulis['root_path'] . '/core/' . $aulis['apps'][$current_app]['core'];
		
	// So where are we now?
	$aulis['active'] = $aulis['apps'][$current_app]['section'];
		
	// We need a page title. Let's create one.
	$aulis['page_title'] = (!empty($aulis['apps'][$current_app]['title']) ? $aulis['apps'][$current_app]['title'] . ' | ' : '') . $setting['site_title'] . (!empty($setting['site_slogan']) ? ' | ' . $setting['site_slogan'] : '');

	// Let's execute the function, if we need to. 
	if($aulis['apps'][$current_app]['execute_function'] == true)
		// Let's check if the function even exists
		if(function_exists($aulis['apps'][$current_app]['function']))
			call_user_func($aulis['apps'][$current_app]['function']);
		// Oh oh, a fatal error it is then. :'(
		else
			return au_fatal_error(6, "Core '$current_app' wanted to excecute the function '{$aulis['apps'][$current_app]['function']}();'.");
	
// Now it's time to finalize our output and call in the theme's base template
au_finalize_output();

// Calling the theme..., let's hope it responds our call.
au_load_theme($setting['theme']);

// Now if we need to cache, we need to cache, obviously
if($setting['enable_cache'] == 1 && !DEBUG_FORCE_DISABLE_CACHE)
	require_once au_get_path_from_root('cache/cache_end.php');

// In the end, there is nothing left but star dust.
die();