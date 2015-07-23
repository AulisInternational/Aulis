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

// The caching feature is yet to come, but this file will end it all.

// If output buffering has been started we need to save it to the cache
if(ob_get_status()){

	// They need to know the file will be loaded from cache in the future
	$contents = "<!--FILE WAS LOADED FROM CACHE-->\n" . ob_get_contents();

	// We need to write to cache
	file_put_contents($cache_file, $contents);

	// End the output buffering
	ob_end_flush();

}