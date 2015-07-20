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
||		-> output.functions.php
| 		-> // This file contains all functions regarding output preparation
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// This function adds output to the big $aulis variable.
function au_out($output, $allowed = true, $aulis_key = 'content'){
	
	// This is important.
	global $aulis;

	// In the future, the output can be modified here. Think of BCC parsing etc. etc.

	// Are we allowed to do this?
	if($allowed)
		// Add the desired output to the big haystack
		return $aulis['page'][$aulis_key][] = $output;

	// ... no we are not, bye
	else
		return false;

}

// This function finalizes the output, by adding the contents of the array, separated by new lines to $aulis['page']['final_content']
function au_finalize_output(){

	// Hello there, $aulis
	global $aulis;

	// Well, we want to finalize the output, to make it ready to use. 
	foreach($aulis['page']['content'] as $section)
		$aulis['page']['final_content'] .= "$section \n";

	// Functions have to have something to return, so we do that
	return true;

}


// This functions formats a number according to the rules of the language we are dealing with
function au_format_number($number, $decimals = LANGUAGE_NUMBER_DECIMALS){

	// Return formatted number
	return number_format($number, $decimals, LANGUAGE_NUMBER_DECIMALS_SEPARATOR, LANGUAGE_NUMBER_THOUSANDS_SEPARATOR);

}

// This function loads an icon, according to templates, uses Aulis' built  in svg's
function au_icon($icon_name, $icon_size = 24, $icon_color = "black"){

	// This is important.
	global $aulis;

	// We need to see whether or not our icon exists.
	if(!file_exists(au_get_path_from_root('library/icons/' . $icon_name . '.svg')))
		return false;

	// The size needs to be known by the icons.css file
	if(!in_array($icon_size, array(8, 12, 16, 24, 32, 48, 64, 128, 256)))
		return false;

	// The color mode can either be black, red, blue or green if it does not start with a # and is a hex
	if(!(au_string_is_hex($icon_color) || in_array($icon_color, array('black', 'white', 'green', 'red', 'blue'))))
		return false;

	// If we are hex, all is fine already, otherwise we need to change the color mode to a hex
	if(!au_string_is_hex($icon_color))
		$icon_color = str_replace(array('black', 'white', 'green', 'red', 'blue'), array('#000000', '#FFFFFF', '#2CA05A', '#C83737', '#2C89A0'), $icon_color);

	// Load the icon template, this makes the variable $aulis['icon_display'] avaible.
	au_load_template("global_icon");

	// Let's load the svg, with the correct color
	$svg = str_replace(array('#000', '#000000'), $icon_color, file_get_contents(au_get_path_from_root('library/icons/' . $icon_name . '.svg')));

	// return the icon output by the template
	return sprintf($aulis['icon_display'], $icon_size, $svg);

}


function au_smiley($smiley_name, $smiley_code = '', $smiley_size = 24){

	// This is important.
	global $aulis;

	// We need to see whether or not our smiley exists.
	if(!file_exists(au_get_path_from_root('library/smilies/' . $smiley_name . '.svg')))
		return false;

	// The size needs to be known by the icons.css file
	if(!in_array($smiley_size, array(16, 24, 32, 48, 64)))
		return false;

	// Load the icon template, this makes the variable $aulis['smiley_display'] avaible.
	au_load_template("global_smiley");

	// The url of the smiley
	$smiley = au_url('library/smilies/' . $smiley_name . '.svg');

	// return the icon output by the template
	return sprintf($aulis['smiley_display'], $smiley_size, $smiley);

}

// This function loads the error box templates for the specified error
function au_error_box($error, $output = 'content'){

	// Hello there, $aulis...
	global $aulis;

	// Transfer the error via the $aulis variable
	$aulis['error_box_contents'] = $error;
	$aulis['error_box_output'] = $output;

	// Load the error box template
	return au_load_template("global_error_box");

}


// This function wraps tags around a keyword to highlight it.
function au_highlight($needle, $haystack, $before, $after){

	return preg_replace('/' . preg_quote($needle) . '/i', $before . '$0' . $after, $haystack);

}

// This function parses the output for blog entries
function au_parse_blog($content){

	// DUMMY FUNCTION
	return nl2br($content);

}