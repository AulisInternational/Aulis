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
||		-> languages.functions.php
| 		-> // This file contains all functions regarding languages
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");
	
// Languages! Let's load one. Just one. Or perhaps two, if we're feeling up to it, bilingualism is a good thing.
function au_load_language($language = '') {
	
	global $aulis, $setting;

	// So did we actually provide ourselves with a language? If the language is empty... it doesn't work, like at all
	if(empty($language))
		return false;

	// Let's create a variable to make things a little more readable
	$language_main_path = au_get_path_from_root('languages/' . $language . '.php');

	// Does this language exist?
	if(!file_exists($language_main_path))
		return au_fatal_error(4, "Language files were not found.");

	// It does exists, let's load the main file
	include_once $language_main_path;

	// Now all other files
	foreach($setting['sub_files'] as $filename)
		include au_get_path_from_root('languages/' . $language . '.' . $filename . '.php');
		
	// We might need this
	$setting['lang_current'] = $language;

	return true;

}