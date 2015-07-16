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

// This function regulates the interal display for fatal errors
function au_fatal_error($error_code, $error_message){

	// These need to be global
	global $aulis;

	// Transfer error information
	$aulis['error_code'] = $error_code;
	$aulis['error_message'] = $error_message;

	// Time to include the error template
	include_once au_get_path_from_root("library/static/error_include/error.php");

	// Stardust
	die();

	// An error is never good news
	return false;

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
		$url = au_url($exploded[1]);
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

// This functions parses the data according to aulis norms
function au_date($time_stamp, $show_time = true, $show_seconds = false, $timezone_when_possible = false) {
	
	// Everthing is added to this one
	$e = "";

	// Is it today? 
	if(date('d/m/Y') == date('d/m/Y', strtotime($time_stamp)))
	{
		$e .= DATE_TODAY;
	}

	// ... yesterday maybe?
	elseif(date("d/m/Y",mktime(0,0,0,date("m") ,date("d")-1,date("Y"))) == date('d/m/Y', strtotime($time_stamp)))
	{
		$e .= DATE_YESTERDAY;
	}

	// Tomorrow then?
	elseif(date("d/m/Y",mktime(0,0,0,date("m") ,date("d")+1,date("Y"))) == date('d/m/Y', strtotime($time_stamp)))
	{
		$e .= DATE_TOMORROW;
	}

	// This week? We just show the name of the day then
	elseif(date("W") == date("W", strtotime($time_stamp)) and date("Y") == date("Y", strtotime($time_stamp)))
	{
		$e .= constant("DATE_DAY_".date("w", strtotime($time_stamp)));
	}

	// If it is this year, we only have to show the month and the day
	elseif(date("Y") == date("Y", strtotime($time_stamp)))
	{
		if(DATE_DAYNUMBERAFTER == false)
			$e .= date("j", strtotime($time_stamp))." ";
		if(DATE_USESHORTMONTHS == true)
			$e .= constant("DATE_MONTH_SHORT_".date("n", strtotime($time_stamp)));
		if(DATE_USESHORTMONTHS == false)
			$e .= constant("DATE_MONTH_".date("n", strtotime($time_stamp)));
		if(DATE_DAYNUMBERAFTER == true)
			$e .= " ".date("j", strtotime($time_stamp));
		if(DATE_ADDSUFFIX == true)
			$e .= date("S", strtotime($time_stamp));
	}

	// This goes way back to another year, that's when we are now.
	else
	{
		
		if(DATE_DAYNUMBERAFTER == false)
			$e .= date("j", strtotime($time_stamp))." ";
		if(DATE_USESHORTMONTHS == true)
			$e .= constant("DATE_MONTH_SHORT_".date("n", strtotime($time_stamp)));
		if(DATE_USESHORTMONTHS == false)
			$e .= constant("DATE_MONTH_".date("n", strtotime($time_stamp)));
		if(DATE_DAYNUMBERAFTER == true)
			$e .= " ".date("j", strtotime($time_stamp));
		if(DATE_ADDSUFFIX == true)
			$e .= date("S", strtotime($time_stamp));
		if(DATE_SEPERATOR != "")
			$e .= DATE_SEPERATOR;
		$e .= date("Y", strtotime($time_stamp));
	}

	// Need to show time too?
	if($show_time == true)
	{
		$e .= " ".DATE_PREPOSITION_TIME." ";
		if(DATE_USE12HOUR == true)
			$e .= date("h", strtotime($time_stamp)).":".date("i", strtotime($time_stamp)).(($show_seconds == true) ? (":".date("s", strtotime($time_stamp))) : "")." ".date("A", strtotime($time_stamp));
		else
			$e .= date("H", strtotime($time_stamp)).":".date("i", strtotime($time_stamp)).(($show_seconds == true) ? (":".date("s", strtotime($time_stamp))) : "");
		if(DATE_ADDTIMEZONEINDICATOR == true and $timezone_when_possible== true)
			$e .= " ".date("T", strtotime($time_stamp));
	}

	return $e;
}
