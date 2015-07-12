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
function au_out($output){
	global $aulis;

	// In the future, the output can be modified here. Think of BCC parsing etc. etc.

	// Add the desired output to the big haystack
	return $aulis['page']['content'][] = $output;
}

function au_finalize_output(){
	global $aulis;

	// Well, we want to finalize the output, to make it ready to use. 
	foreach($aulis['page']['content'] as $section)
		$aulis['page']['final_content'] .= "$section \n";

	// Functions have to have something to return, so we do that
	return true;
}

function au_error_box($error){
	global $aulis;

	// Transfer the error via the $aulis variable
	$aulis['transfer'] = $error;

	// Load the error box template
	return au_load_template("errorbox");
}