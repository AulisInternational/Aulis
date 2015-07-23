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
||		-> index.php -> The empty file
| 		-> // This handles caching, if enabled.
|| 		-> Last change: July, 2015
*/

// The caching feature is yet to come, but this file will start it all.

// There are some apps that can't be cached
$cache_blacklist = array('');

// Get the request hash
$hash = md5('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$cache_folder = au_get_path_from_root('cache/output');
$cache_file = au_get_path_from_root('cache/output/'.$hash.'.cache');
$cache_time = $setting['caching_time'];

// We need to if our cache file exists
if(file_exists($cache_file) and is_writable($cache_folder)){

	
	// Our file exists... let's get its creation time
	$cache_file_time = filemtime($cache_file);

	// We need to know if our file is from yesterday, we only accept files from today
	// ... we also need to know if our cache file is valid
	if(!(date('Ymd', $cache_file_time) == date('Ymd', strtotime('yesterday'))) && (time() - $cache_file_time < $cache_time))
		die(file_get_contents($cache_file));

	// Otherwise we need to delete the cache file and start output buffering
	else if(unlink($cache_file))
		ob_start();

}

// If we are still here and our cache folder is writable, we need to start caching the output
else if(is_writable($cache_folder)){

	// ob_start, we start output buffering
	ob_start();

}

// Otherwise... nothing happens

	