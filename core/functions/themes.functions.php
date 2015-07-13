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

function au_load_theme($theme){
	global $aulis;
	return @include au_get_path_from_root("themes/".$theme."/base_template.php");
}

function au_load_template($template){

	// Which is the file we want?
	$filename = au_get_path_from_root("themes/".au_get_setting("theme")."/templates/".$template.".template.php");
	$filename_hannover = au_get_path_from_root("themes/hannover/templates/".$template.".template.php");

	// If it exists, all is right, return the include
	if(file_exists($filename))
		return include $filename;

	// If it does not exist, we will have to call the file from the hannover theme
	elseif(file_exists($filename_hannover))
		return include $filename_hannover;

	// Otherwise... this is the end
		return die("Fatal template error");
		
}