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
||		-> global.functions.php
| 		-> // This file contains some very important globally used functions.
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

function au_get_cores(){

	// We hereby fetch all core information from the database
	return au_query("SELECT * FROM core;");

}

// This function loads a core file from the /core folder.
function au_load_core($core) {
   	
   	// So did we actually provide ourselves with a core?
	if(empty($core))
		return die('Fatal error: core not found.');
		
	// Let's create a variable to make things a little more readable
	$core_path = au_get_path_from_root('core/' . $core . '.php');
		
	// We did! Cool. Now, does it exist?
	if(file_exists($core_path))
		return include_once $core_path;
		
	// Bugger. It doesn't. :'(
	else
		return die('Fatal error: core not found.');

}
