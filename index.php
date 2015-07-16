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

// Let's load the language files, I mean, we want to communicate with them, right?
au_load_language(au_get_setting("language"));

// Information about apps and their cores are listed and added to $aulis in /core/_CoreArray.php
include au_get_path_from_root('core/_CoreArray.php');

// Verify the user's input
if(!empty($_GET['app']) && array_key_exists($_GET['app'], $aulis['apps']))
	$current_app = $_GET['app'];

// Okay, the requested page doesn't exist
elseif(empty($_GET['app']) || !array_key_exists($_GET['app'], $aulis['apps']))
	$current_app = 'frontpage';
	
// Things are fine the way they are
else
	$current_app = $_GET['app'];
	
// Do we need to load an extra file?
if($aulis['apps'][$current_app]['load_file'] == true)
	require $aulis['root_path'] . '/core/' . $aulis['apps'][$current_app]['core'];
	
// We need a page title. Let's create one.
$aulis['page_title'] = (!empty($aulis['apps'][$current_app]['title']) ? $aulis['apps'][$current_app]['title'] . ' | ' : '') . au_get_setting('site_title') . (!empty(au_get_setting('site_slogan')) ? ' | ' . au_get_setting('site_slogan') : '');

// Let's load the function, if we need to
if($aulis['apps'][$current_app]['load_function'] == true)
	$aulis['apps'][$current_app]['function']();
	
// Now it's time to finalize our output and call in the theme's base template
au_finalize_output();

// Calling the theme..., let's hope it responds our call.
au_load_theme(au_get_setting("theme"));

// In the end, there is nothing left but star dust.
die();