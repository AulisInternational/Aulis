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
||		-> au_config.php
| 		-> // This file coordinates the database connection and the elementary settings
|| 		-> Last change: July, 2015
*/

// 	We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// DEBUG <1.1 ALPHA 1> [These constants are only used for debugging]
define("DEBUG_SHOW_QUERIES", false); // Functionality is in au_query, REMEMBER TO TURN OFF!!
define("DEBUG_SHOW_PREFORMANCE", true); // Functionality is in base_template.php, REMEMBER TO TURN OFF!!
define("DEBUG_FORCE_DISABLE_CACHE", true); // Functionality is in base_template.php, REMEMBER TO TURN OFF!!

// Making a global array
global $aulis;
$aulis = array();

// The current software version
$aulis['version'] = '1.1 Alpha 1';

// Some general stuff
$aulis['file'] = 'index.php'; // You may change this, if you decide to move all functionality to another file
$aulis['settings'] = array();
$aulis['user'] = null;

//	Database Driver (which type of database are we using?)
$aulis['db_driver'] = 'mysql'; // mysql, pgsql or sqlite

//	Database prefix (Default: au_)
$aulis['db_prefix'] = "aulis_";

// 	Database information...
$aulis['db_host'] = 'localhost'; 
$aulis['db_user'] = 'root'; 
$aulis['db_password'] = ''; 
$aulis['db_database'] = 'aulis'; 
$aulis['db_query_count'] = 0; 
$aulis['db_enable_query_caching'] = 1;

// Page information
$aulis['page'] = array();
$aulis['page']['title'] = "Index"; // This will be changed via the Page title setting
$aulis['page']['menu'] = array();
$aulis['page']['head'] = array();
$aulis['page']['content'] = array();
$aulis['page']['final_content'] = '';
$aulis['page']['transfer'] = '';

// Important paths!
$aulis['root_path'] = dirname(__FILE__);
$aulis['absolute_path'] = "http://localhost/Aulis/";

// What functions do index.php and Admin.php need?
$aulis['load_functions'] = array('blog', 'cache', 'core', 'database', 'global', 'hash', 'languages', 'menu', 'output', 'pagination', 'sessions', 'settings', 'themes', 'user');