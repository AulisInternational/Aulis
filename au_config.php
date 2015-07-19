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
||		-> au_config.php
| 		-> // This file coordinates the database connection and the elementary settings
|| 		-> Last change: July, 2015
*/

// 	We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// Making a global array
global $aulis;
$aulis = array();

// The current software version
$aulis['version'] = '0.01';

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