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
||		-> database.functions.php
| 		-> // This file contains the functions that handle database queries
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");


// This function setups the database connection.
function au_setup_database(){
		
	// This thing is important, it contains the database settings
	global $aulis;

	// Let's see if we maybe need MySQL or PSQL
	if($aulis['db_driver'] == 'mysql' || $aulis['db_driver'] == 'psql')
		try{
			$db = new PDO($aulis['db_driver'] . ':host='.$aulis['db_host'].';dbname='.$aulis['db_database'], $aulis['db_user'], $aulis['db_password']);
		}
		catch(PDOException $e){
			die($e->getMessage());
		}

	// Or some database saved in files... who knows?
	elseif($aulis['db_driver'] == 'sqlite')
		try{
			$db = new PDO('sqlite:'.$aulis['db_database']);
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
		
	// Apparently someone didn't get the message.
	else
		die('Database type unknown.');

	// Transfer the connection to $aulis
	return $aulis['db'] = $db;

}

function au_query($sql){
	global $aulis;

	// Make sure we have the right database prefix.
	$search = array("FROM ", "INTO ", "UPDATE ");
	$replace = array("FROM ".$aulis['db_prefix'], "INTO ".$aulis["db_prefix"], "UPDATE ".$aulis["db_prefix"]);
	$sql = str_replace($search, $replace, $sql);
	// Let's run the query
	return $aulis["db"]->query($sql);
}

function au_db_quote($value){
	global $aulis;

	// Return a proper quoted version of our value
	return $aulis['db']->quote($value);
}