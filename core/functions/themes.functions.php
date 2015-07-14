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

	// We need this one to know whether we have to display a fatal error
	$return_false = false;

	// Do we have a theme, like, at all?
	if(empty($theme))
		$return_false = true;

	// Let's put our path to base_template.php in a beautiful variable
	$filename = au_get_path_from_root("themes/".$theme."/base_template.php");

	// Does our theme have a base_template, if it doesn't we don't even have to try.
	if(!file_exists($filename))
		$return_false = true;

	// Do we have to tell the bad news?
	if($return_false)
		au_fatal_error(2, "The value '" . au_get_setting("themea") . "' was assumed as theme.");

	// Apparently all is right, so let's get that party started...
	else
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
		return au_fatal_error(3, "Template '" . $filename . "' was not found.");
		
}