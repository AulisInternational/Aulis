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
	
// Languages! Let's load one. Just one. Or perhaps two, if we're feeling up to it.
function au_load_language($language = '') {
	
	// So did we actually provide ourselves with a language?
	if(empty($language))
		die('Language files not found.');
		
	// Let's create a variable to make things a little more readable
	$language_path = au_get_path_from_root('languages/' . $language . '.php');
		
	// We did! Cool. Now, does it exist?
	if(file_exists($language_path))
		return include_once $language_path;
		
	// Bugger. It doesn't. :'(
	else
		return die('Language files not found.');

}