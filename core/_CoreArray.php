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
||		-> _CoreArray.php
| 		-> // This file contains the information about all actions our main index.php can preform. 
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");


// This is the big array that contains the information about all actions our main index.php can preform. 
// ! an entry into this array should contain: core, function, maintenance, load_file and title.

$aulis['apps'] = array(
	'frontpage' => array(
		'core' => 'Frontpage.php',
		'function' => 'au_load_frontpage',
		'maintenance' => false,
		'load_file' => true,
		'execute_function' => true,
		'section' => 'frontpage',
		'title' => '',
	),
	'boardindex' => array(
		'core' => 'BoardIndex.php',
		'function' => 'au_show_boardindex',
		'maintenance' => false,
		'load_file' => true,
		'execute_function' => true,
		'section' => 'forum',
		'title' => '',
	),
	'blogindex' => array(
		'core' => 'BlogIndex.php',
		'function' => 'au_show_blogindex',
		'maintenance' => false,
		'load_file' => true,
		'execute_function' => true,
		'section' => 'blog',
		'title' => '',
	),
	'blogentry' => array(
		'core' => 'ViewEntry.php',
		'function' => 'au_show_entry',
		'maintenance' => false,
		'load_file' => true,
		'execute_function' => true,
		'section' => 'blog',
		'title' => '',
	),
	'blogactions' => array(
		'core' => '',
		'function' => 'au_preform_blog_actions',
		'maintenance' => false,
		'load_file' => false,
		'execute_function' => true,
		'section' => 'blog',
		'title' => '',
	),
	'register' => array(
		'core' => 'Register.php',
		'function' => 'au_register',
		'maintenance' => false,
		'load_file' => true,
		'execute_function' => true,
		'section' => 'register',
		'title' => '',
	),
);