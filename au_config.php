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
||		-> au_config.php
| 		-> // This file coördinates the database connection and the elemantary settings
|| 		-> Last change: July, 2015
*/
// 	We can't access this file, if not from index.php, so let's check
if(!defined('aulis')){
	// Oops.
	header("Location: index.php");
}
// -> Great, let's go on with our job.

//	Database Driver (which type of database are we using?)
$db_driver = 'mysql'; // mysql, pgsql or sqlite

//	Database prefix (Default: au_)
$db_prefix = "au_";

// 	Setting up Database connection
$db_host = 'localhost'; 
$db_user = 'root'; 
$db_password = ''; 
$db_database = 'aulis'; 
if($db_driver == 'mysql')
	try
	{
		$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		exit;
	}
if($db_driver == 'pgsql')
	try
	{
		$db = new PDO('pgsql:host='.$db_host.';dbname='.$db_database, $db_user, $db_password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		exit;
	}
if($db_driver == 'sqlite')
	try
	{
		$db = new PDO('sqlite:'.$db_database);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		exit;
	}

//	Making a global array
global $aulis;
$aulis = array();
$aulis['file'] = 'index.php'; // You may change this, if you decide to move all functionality to another file
$aulis['settings'] = array();

// 	Page information
$aulis['page'] = array();
$aulis['page']['title'] = "Aulis"; // This will be changed via the Page title setting
$aulis['page']['menu'] = array();
$aulis['page']['head'] = array();
$aulis['page']['content'] = array();

// Transfer the database to $aulis
$aulis['db'] = $db;
$aulis['db_prefix'] = $db_prefix;

//	Important paths!
$aulis['root_path'] = dirname(__FILE__);
$aulis['absolute_path'] = "http://localhost/aulis/Aulis";

// 	Unsetting the from here onwards unused database variables
unset($db);
unset($db_prefix);
unset($db_host);
unset($db_user);
unset($db_password);

/*
----------------------------------------------------------------------------
	The Folowing part of this file will be used to define some basic functions.
----------------------------------------------------------------------------
*/

// Function to load (require) all other functions that are safely saved somewhere in other directories.
function au_LoadFunctions($module = null)
{
	global $aulis;
	// Do we have to load the built in functions...
	if(is_null($module))
	{
		foreach (glob($aulis['root_path']."/functions/*.functions.php") as $filename)
		{
			require $filename;
		}
	}
	// ...or the ones that go with a certain module
	else
	{
		foreach (glob($aulis['root_path']."/modules/".$module."/functions/*.functions.php") as $filename)
		{
			require $filename;
		}
	}
}


// Password hash function

function au_Hash($password, $extradata = '')
{
	// The Salt (this is unique for every instalation and also quite tasty, because it's salt).
	$salt = md5("672kjaujnfu72ujnajfll91").sha1("aulis0.01");
	// Setting up the basic hash, we suppose this is safe.
	$hash = hash('ripemd160', md5(sha1(sha1(md5(sha1(md5($salt).$salt.$password).$password).md5(strlen($password)).$salt.md5($password)))));
	// If we want to add some extra data to the hash, such as user ID or what not, we can do that too.
	if($extradata != '')
		$hash = hash('ripemd160', sha1($hash.$salt.$extradata).$extradata.sha1($salt));
	// For aesthetic effect, we do one final hash to make it a short sha1-string
	$hash = sha1($hash);
	// Now we kindly return this hash.
	return $hash;
}

// This string function, to check whether a string starts with a piece of string, might come in handy.

function au_StartsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

// And this other string function, to check whether a string starts with a piece of string, might come in handy.


function au_EndsWith($haystack, $needle)
{
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}
		
// Well... this is also handy because it can be used for paths within Aulis and URLs.

function au_Url($url = '', $redirect = false)
{
	global $aulis;
	// If we have a request starting with ?, it's for the main file
		if(au_StartsWith($url, '?'))
		{
			$url = $aulis['absolute_path'].$aulis['file'].$url;
		}
	// If our request starts with au://, we have to load a file from the main directory
		elseif(au_StartsWith($url, 'au://'))
		{
			$exploded = explode('au://', $url);
			// Recursion is awesome!
			$url = au_Url($exploded[1]);
		}
	// Normal internet URLs are welcome too
		elseif(au_StartsWith($url, 'http://') or au_StartsWith($url, 'ftp://') or au_StartsWith($url, 'https://'), or au_StartsWith($url, 'mailto:'))
		{
			$url = $url;
		}
	// If the request is nothing from the above, we have to do with a request for something in the main directory, for example another file
		else
		{
			$url = $aulis['absolute_path'].$url;
		}
	// If we are requested to redirect us to the given URL, we have to do that of course. 
		if($redirect)
		{
			return header("Location:".$url);
		}
	// Otherwise, we have to just kindly return the url
		else
		{
			return $url;
		}
}

// This function gives the path to a file from the root.

function au_FromRoot($url)
{
	global $aulis;
	return $aulis['root_path'].'/'.$url;
}

// Sometimes it might come in handy to now whether we are on a mobile platform or not

function au_AreWeMobile()  {
  	if (preg_match("/Mobile|Android|BlackBerry|iPhone|Windows Phone/", $_SERVER['HTTP_USER_AGENT']) and !isset($_REQUEST['wap']) and !isset($_REQUEST['ajax'])) {
    	return true;
	}
	else{
		return false;
	}
}

// End of file, bye! 

?>