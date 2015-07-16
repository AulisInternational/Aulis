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
function au_out($output, $allowed = true){
	
	// This is important.
	global $aulis;

	// In the future, the output can be modified here. Think of BCC parsing etc. etc.

	// Are we allowed to do this?
	if($allowed)
		// Add the desired output to the big haystack
		return $aulis['page']['content'][] = $output;

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

function au_icon($icon_name, $icon_size = 24, $icon_color = "black"){

	// For this task we need $aulis...
	global $aulis;

	// Transfer all icon information to $aulis
	$aulis['icon_name'] = $icon_name;
	$aulis['icon_size'] = $icon_size;
	$aulis['icon_color'] = $icon_color;

	// Load the icon template
	au_load_template("icon");

	// return the icon output by the template
	return $aulis['icon_output'];

}

// This function loads the error box templates for the specified error
function au_error_box($error){

	// Hello there, $aulis...
	global $aulis;

	// Transfer the error via the $aulis variable
	$aulis['transfer'] = $error;

	// Load the error box template
	return au_load_template("errorbox");

}

// This function parses the output for blog entries
function au_parse_blog($content){

	// DUMMY FUNCTION
	return nl2br($content);

}