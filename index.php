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

// The big $aulis is our friend, he needs te be by our side.
global $aulis;

// Ok, we need a copyright line. We might as well create it here
$aulis['copyright'] = '<a href="http://germanics.org/aulis" target="_blank">Powered by Aulis, version ' . $aulis['version'] . '</a>';

// It's not like that's all, we need our functions to be loaded too
foreach(glob($aulis['root_path'] . '/core/functions/*.functions.php') as $filename)
	include $filename;

// The database will be set up below this line
au_setup_database();
	
// Start sessions
session_start();

// Load the user information into $aulis
au_load_user();

// Let's load the language files
au_load_language(au_get_setting("language"));

// What apps do we have and can we load?
$apps = array(
	'frontpage' => array(
		'core' => 'Frontpage.php',
		'function' => 'au_load_frontpage',
		'maintenance' => false,
		'load_file' => true,
		'load_function' => true,
		'title' => '',
	),
);

	// Verify the user's input
	if(!empty($_GET['app']) && array_key_exists($_GET['app'], $apps))
		$current_app = $_GET['app'];
	
	// Okay, the requested page doesn't exist
	elseif(empty($_GET['app']) || !array_key_exists($_GET['app'], $apps))
		$current_app = 'frontpage';
		
	// Things are fine the way they are
	else
		$current_app = $_GET['app'];
		
	// Do we need to load an extra file?
	if($apps[$current_app]['load_file'] == true)
		require $aulis['root_path'] . '/core/' . $apps[$current_app]['core'];
		
	// We need a page title. Let's create one.
	$aulis['page_title'] = (!empty($apps[$current_app]['title']) ? $apps[$current_app]['title'] . ' | ' : '') . au_get_setting('site_title') . (!empty(au_get_setting('site_slogan')) ? ' | ' . au_get_setting('site_slogan') : '');

	// Let's load the function, if we need to
	if($apps[$current_app]['load_function'] == true)
		$apps[$current_app]['function']();
	
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
au_load_theme(au_get_setting("theme"));

// In the end, there is nothing left but star dust.
die();