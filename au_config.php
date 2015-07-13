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

//	Database Driver (which type of database are we using?)
$db_driver = 'mysql'; // mysql, pgsql or sqlite

//	Database prefix (Default: au_)
$db_prefix = "aulis_";

// 	Setting up Database connection
$db_host = 'localhost'; 
$db_user = 'root'; 
$db_password = ''; 
$db_database = 'aulis'; 
if($db_driver == 'mysql')
	try
	{
		$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		exit;
	}
if($db_driver == 'pgsql')
	try
	{
		$db = new PDO('pgsql:host='.$db_host.';dbname='.$db_database, $db_user, $db_password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		exit;
	}
if($db_driver == 'sqlite')
	try
	{
		$db = new PDO('sqlite:'.$db_database);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		exit;
	}

// Making a global array
global $aulis;
$aulis = array();
$aulis['file'] = 'index.php'; // You may change this, if you decide to move all functionality to another file
$aulis['settings'] = array();

// Page information
$aulis['page'] = array();
$aulis['page']['title'] = "Index"; // This will be changed via the Page title setting
$aulis['page']['menu'] = array();
$aulis['page']['head'] = array();
$aulis['page']['content'] = array();
$aulis['page']['final_content'] = '';
$aulis['page']['transfer'] = '';

// Transfer the database to $aulis
$aulis['db'] = $db;
$aulis['db_prefix'] = $db_prefix;

// Important paths!
$aulis['root_path'] = dirname(__FILE__);
$aulis['absolute_path'] = "http://localhost/Aulis";

// Unsetting the from here onwards unused database variables
unset($db);
unset($db_prefix);
unset($db_host);
unset($db_user);
unset($db_password);

