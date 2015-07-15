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

// Function to get an user's ID only by their name (CASE SENSITIVE)
function au_get_user_by_name($user_name)
{

	// Empty username's are NOT allowed
	if(empty($user_name))
		return false;

	// Get the user
	$user = au_query("SELECT * FROM users WHERE user_username = " . $user_name . " LIMIT 1;");

	// If this potential user exists, it's all right, return it
	if($user->rowCount() === 1)
		return $user;

	// Otherwise, we have a problem, Houston.
	else
		return false;

}


// Compares given login data with data in the database, returns boolean
function au_compare_login_data($given_user_name, $given_password){

	// Given information cannot be blank, this should already have been tested, but just to be sure
	if(empty($given_user_name) or empty($given_password))
		return false;

	// We need access to the user's information.
	$user = au_get_user_by_name($given_user_name);

	// The user must exist in the database, otherwise we will return false
	if(!$user)
		return false;

	// What should the hash be according to the input?
	$desired_hash = au_hash_password($given_password, $user->user_username, $user->user_regdate);

	// What IS the hash in the database?
	$hash = $user->user_password;

	// Let's compare both
	return ($hash === $desired_hash);

}