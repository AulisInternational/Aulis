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
||		-> settings.functions.php
| 		-> // This file contains the functions that have to do with settings
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");
	
// Load the settings from the database
function au_get_settings() {

	global $aulis;
	
	// Create a temporal array for the settings
	$temp_settings = array();
	
	// Let's take the database out for a drink
	$result = au_query("
		SELECT setting_name, setting_value
			FROM settings
	");
	
	// Now, let's add them to the array
	foreach($result as $tempsetting)
		$temp_settings[$tempsetting['setting_name']] = $tempsetting['setting_value'];
	
	// Let's return the array
	return $temp_settings;
}

function au_get_setting($setting){
	global $aulis;

	// Try to get the setting, if it isn't possible, we'll have to disappoint you.
	if(!($obtained_setting = au_query("SELECT * FROM settings WHERE setting_name = ".au_db_quote($setting).";")))
		return false;

	// Let's check if there is a setting to return.
	if($obtained_setting->rowCount() == 0)
		return false;

	// Well, let's get its value then
	while($fetch_setting = $obtained_setting->fetchObject())
		$value = $fetch_setting->setting_value;

	// Let's return the value, we have to be fair, if it's empty, an empty string should be returned, no booleans
	return $value;
}

function au_set_setting($setting, $value){
	global $aulis;

	// Try to get the setting, if it isn't possible, we can't change it, can we?
	if(!($obtained_setting = au_query("SELECT * FROM settings WHERE setting_name = ".au_db_quote("setting").";")))
		return false;

	// Let's check if there is a setting to return.
	if($obtained_setting->rowCount === 0)
		return false;

	// Well, now we know that the setting exist, so we can change it now.
	return au_query("UPDATE settings SET setting_value = ".au_db_quote($value)." WHERE setting_name = ".au_db_quote($setting).";");

	// Let's return the value, we have to be fair, if it's empty, an empty string should be returned, no booleans
	return $value;
}