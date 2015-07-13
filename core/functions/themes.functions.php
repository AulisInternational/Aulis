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
||		-> themes.functions.php
| 		-> // This file contains all functions regarding themes
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// This function will try to load the theme and returns whether or not that succeeded. 
function au_load_theme($theme){

	// Do we have a theme, like, at all?
	if(empty($theme))
		exit;

	// Let's put our path to base_template.php in a beautiful variable
	$filename = au_get_path_from_root("themes/".$theme."/base_template.php");

	// Does our theme have a base_template, if it doesn't we don't even have to try.
	if(!file_exists($filename))
		exit;

	// Apparently all is right, so let's get that party started...
	return include_once $filename;

}

function au_load_template($template){

	// Which is the file we want?
	$filename = au_get_path_from_root("themes/".au_get_setting("theme")."/templates/".$template.".template.php");
	$filename_hannover = au_get_path_from_root("themes/hannover/templates/".$template.".template.php");

	// If it exists, all is right, return the include
	if(file_exists($filename))
		return include_once $filename;

	// If it does not exist, we will have to call the file from the hannover theme
	elseif(file_exists($filename_hannover))
		return include_once $filename_hannover;

	// Otherwise... this is the end
		return die("Fatal template error");
		
}