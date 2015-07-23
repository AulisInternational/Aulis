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
||		-> hash.functions.php
| 		-> // This file contains the functions that have to do with password hashing
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// This functions combines the password with extra data and hashes it
// For optimal use, combine the password with an unique user_id, user_name and user_regdate
function au_hash($input, $extra_data = '') {

	// The salt (this is unique for every installation and also quite tasty, because it's salt).
	$salt = md5("672kjaujnfu72ujnajfll91//").sha1("aulis0.01");
	
	// Setting up the basic hash, we suppose this is safe. Or at least it's harder to reverse
	$hash = hash('ripemd160', md5(sha1(sha1(md5(sha1(md5($salt) . $salt . $input) . $input) . md5(strlen($input)) . $salt . md5($input)))));
	
	// If we want to add some extra data to the hash, such as user ID or what not, we can do that too.
	if($extra_data != '')
		$hash = hash('ripemd160', sha1($hash . $salt . $extra_data) . sha1($extra_data) . sha1($salt));
		
	// For aesthetic effect, we do one final hash to make it a short sha1-string
	$hash = sha1($hash . strlen($input) . strlen($extra_data));
	
	// Now we kindly return this hash.
	return $hash;

}

// This function is for use with a password, a username and a registration date
function au_hash_password($password, $user_name, $user_regdate){

	// Let's make the $extra_data
	$extra_data = $user_name . ":" . $user_regdate;

	// Now let's hash this thing
	return au_hash($password, $extra_data);

}