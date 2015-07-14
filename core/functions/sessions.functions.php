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
||		-> sessions.functions.php
| 		-> // This file contains the functions that handle sessions.
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

//  Let's add a session to the database
function au_set_session($data = array()) {

	// This should actually be an array
	if(is_array($data))
		return false;
}

// This functions controls whether a session exists or not... it returns an user id if we are logged in, otherwise it's false
function au_session_check(){

	// This function needs to be written, but we have it return dummy content for now
	return 1; // The first user is doomed to be logged in for ever and always until this function is ready.

}