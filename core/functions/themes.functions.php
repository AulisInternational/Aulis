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
||		-> themes.functions.php
| 		-> // This file contains all functions regarding themes
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// This function will try to load the theme and returns whether or not that succeeded. 
function au_load_theme($theme){

	// Our base_template needs access to $aulis too, you know?
	global $aulis, $setting;

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

	// Do we have to tell the bad news? au_fatal_error shows an error and returns false.
	if($return_false)
		return au_fatal_error(2, "The value '" . $theme . "' was assumed as theme.");

	// Apparently all is right, so let's get that party started...
	else
		return require_once $filename;

}


// We might not need the theme at first, but we do need some of its settings
function au_load_theme_settings(){

	// Global setting
	global $setting;
	
	// Which file paths do we need
	$settings_file = au_get_path_from_root("themes/".$setting['theme']."/theme_settings.php");
	$settings_file_hannover = au_get_path_from_root("themes/hannover/theme_settings.php");

	// If the settings_file from the current theme exists, it's alright
	if(file_exists($settings_file))
		return require_once $settings_file;

	// ...otherwise we need to fallback
	else if(file_exists($settings_file_hannover))
		return require_once $settings_file_hannover;

	// ...otherwise a fatal error is handy
	else
		return au_fatal_error(7, 'Setting files ' . $settings_file_hannover . ' and ' . $settings_file . ' do not exist.');


}

function au_load_template($template){

	// Global setting
	global $setting;

	// Which file paths do we need?
	$filename = au_get_path_from_root("themes/".$setting['theme']."/templates/".$template.".php");
	$filename_hannover = au_get_path_from_root("themes/hannover/templates/".$template.".php");
	$settings_file_hannover = au_get_path_from_root("themes/hannover/theme_settings.php");

	// If it exists, all is right, return the include
	if(file_exists($filename))
		$fallback = !(require_once $filename);

	// If it does not exist, we will have to call the file from the hannover theme
	elseif(file_exists($filename_hannover))
		$fallback = require_once $filename_hannover;

	// Otherwise... this is the end, show an error and return false.
	else
		return au_fatal_error(3, "Template '" .  $filename_hannover . "' was not found.");

	// We need to load the hannover settings file, if we have a fallback situation and if it hasn't been loaded already

	if($fallback and !defined('HANNOVER_SETTINGS'))
		// We need to load the settings from hannover
		if(file_exists($settings_file_hannover))
			require_once $settings_file_hannover;
		else
			return au_fatal_error(3, "Settings file '$settings_hannover' could not be loaded, it does not exist.");

	// The name of the template's main function
	$function = 'au_template_' . $template;

	// We need to know whether we can exectute the template's main function
	if(!function_exists($function))
		return au_fatal_error(3, "The template '$template' ('" . $filename . "') should have a function called '$function();', this function was not found.");
	
	// We can execute our function, hooray	
		return call_user_func($function);
		
}