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
||		-> menu.functions.php
| 		-> // This file contains the functions that handle caching
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// This will just delete all cache files in a certain section
function au_force_clean_cache($section){

	global $aulis;

	foreach(glob($aulis['root_path'] . '/cache/' . $section . '/*.cache') as $filename)
		unlink($filename);
	
}