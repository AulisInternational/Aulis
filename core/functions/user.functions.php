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
||		-> user.functions.php
| 		-> // This file contains the function that loads the user information
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");
	
// This function loads the user information and determines whether our guest is actually a guest, or a member in disguise
function au_load_user() {

	global $aulis;
	
	// So, are we actually logged in?
	if(au_session_check() == 1) {
	
	}
	
	// Nope, we're a guest!
	else
		return 'guest';
}