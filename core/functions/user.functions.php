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
	
// This function loads the user information into $aulis and determines whether our guest is actually a guest, or a member in disguise
function au_load_user() {

	// Since we want to store user information in the big $aulis, we have to be able to do that
	global $aulis;
	
	// Retrive the user id from the session, this will be a number if we are logged in, otherwise it will be false
	$user_session = au_session_check();

	// If it's false.. there is no point in 

	// So, are we actually logged in? Our session check needs to return an user id, so we need a nummer
	if(is_numeric($user_session)) 
		return $aulis['user'] = au_get_user($user_session);
	
	// Nope, we're a guest!
	else
		return $aulis['user'] = false;
}

// Function to check if we are logged in, returns boolean
function au_logged(){

	// The big $aulis is called, we need to check up a little on him
	global $aulis;

	// We need to know whether $aulis['user'] is an object, which means that it contains user data and whether that user exists or not
	return (is_object($aulis['user']) and au_exist_user($aulis['user']->id));

}


// This functions checks whether or not an user exists
function au_exist_user($user_id){

	// Try to get the user from the database
	$try = au_query("SELECT user_id FROM users WHERE user_id = " . $user_id);

	// If we catched one user, they must exist
	return ($try->rowCount() == 1);

}

// This function gets user information (as an object) from the database
function au_get_user($user_id){
	
	// Just return the datebase object, that's all this function has to do
	return au_query("SELECT * FROM users WHERE user_id = " . $user_id . " LIMIT 1;");

}