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
||		-> viewblog.php
| 		-> // This file contains the logic for the blog view
|| 		-> Last change: July, 2015
*/

function au_show_entry(){

	// Praise the big $aulis
	global $aulis;

	// We can't access this file, if not from index.php, so let's check
	if(!defined('aulis'))
		header("Location: index.php");

	// We need to decrypt the blog id, if numeric
	if(isset($_GET['id']) and is_numeric($_GET['id']))
		$entry_id = au_decrypt_blog_id($_GET['id']);
	// No id...
	else
		$entry_id = 0;

	// Try to obtain the entry from the big (or small, it all depends) database
	if($aulis['blog']['entry'] = au_get_blog_entry($entry_id)){

		// Prepare some url inputs
		$aulis['blog']['url_input'] = array(
			"app" => "blogentry",
			"id" => $aulis['blog']['entry']->entry_id,
			"title" => $aulis['blog']['entry']->blog_name
		);

		// Load the template
		au_load_template("blog_entry");

	}

	// Bummer... we have to dissappoint them :'(
	else
		au_error_box(BLOG_NOT_FOUND);

}


