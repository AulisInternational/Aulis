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
		'title' => '',
	),
	'boardindex' => array(
		'core' => 'BoardIndex.php',
		'function' => 'au_show_boardindex',
		'maintenance' => false,
		'load_file' => true,
		'execute_function' => true,
		'title' => '',
	),
	'blogindex' => array(
		'core' => 'BlogIndex.php',
		'function' => 'au_show_blogindex',
		'maintenance' => false,
		'load_file' => true,
		'execute_function' => true,
		'title' => '',
	),
	'entry' => array(
		'core' => 'ViewEntry.php',
		'function' => 'au_show_entry',
		'maintenance' => false,
		'load_file' => true,
		'execute_function' => true,
		'title' => '',
	),
);