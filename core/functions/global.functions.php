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
||		-> global.functions.php
| 		-> // This file contains some very important globally used functions.
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// This function checks whether a string starts with another string.
function au_string_starts_with($haystack, $needle) {
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

// ...and this one does the same, but checks the end.
function au_string_ends_with($haystack, $needle) {
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}

// This function is used for urls and paths
function au_url($url = '', $redirect = false) {
	global $aulis;
	
	// If we have a request starting with ?, it's for the main file
	if(au_string_starts_with($url, '?'))
		$url = $aulis['absolute_path'].$aulis['file'].$url;
	
	// If our request starts with au://, we have to load a file from the main directory
	elseif(au_string_starts_with($url, 'au://')) {
		$exploded = explode('au://', $url);
		
		// Recursion is awesome!
		$url = au_Url($exploded[1]);
	}
	
	// Normal internet URLs are welcome too
	elseif(au_string_starts_with($url, 'http://') or au_string_starts_with($url, 'ftp://') or au_string_starts_with($url, 'https://') or au_string_starts_with($url, 'mailto:'))
		$url = $url;
	
	// If the request is nothing from the above, we have to do with a request for something in the main directory, for example another file
	else
		$url = $aulis['absolute_path'] . $url;
	
	// If we are requested to redirect us to the given URL, we have to do that of course. 
	if($redirect)
		return header("Location:".$url);
	
	// Otherwise, we have to just kindly return the url
	else
		return $url;
}

// This function adds the root path to a relative path
function au_get_path_from_root($url) {
	global $aulis;
	return $aulis['root_path'].'/'.$url;
}

// This function checks whether we are one a mobile platform or not
function au_check_mobile() {
  	if (preg_match("/Mobile|Android|BlackBerry|iPhone|Windows Phone/", $_SERVER['HTTP_USER_AGENT']) and !isset($_REQUEST['wap']) and !isset($_REQUEST['ajax']))
    	return true;
	else
		return false;
}