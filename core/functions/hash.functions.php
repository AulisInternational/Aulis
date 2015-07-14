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
||		-> hash.functions.php
| 		-> // This file contains the functions that have to do with password hashing
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

function au_hash($password, $extra_data = '') {

	// The Salt (this is unique for every installation and also quite tasty, because it's salt).
	$salt = md5("672kjaujnfu72ujnajfll91").sha1("aulis0.01");
	
	// Setting up the basic hash, we suppose this is safe.
	$hash = hash('ripemd160', md5(sha1(sha1(md5(sha1(md5($salt).$salt.$password).$password).md5(strlen($password)).$salt.md5($password)))));
	
	// If we want to add some extra data to the hash, such as user ID or what not, we can do that too.
	if($extra_data != '')
		$hash = hash('ripemd160', sha1($hash.$salt.$extra_data).sha1($extra_data).sha1($salt));
		
	// For aesthetic effect, we do one final hash to make it a short sha1-string
	$hash = sha1($hash);
	
	// Now we kindly return this hash.
	return $hash;

}