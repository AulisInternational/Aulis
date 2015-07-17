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
||		-> blogindex.php
| 		-> // This file contains the logic for the blog index
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");


// This core has some requirments for the big $aulis
$aulis['blog'] = array();


function au_show_blogindex(){

	// $aulis might come in handy here
	global $aulis;

	// Did our lovely user specify a page?
	if(isset($_GET['page']) && is_numeric($_GET['page']))
		$page = $_GET['page'];
	else
		$page = 1;

	// Let's load all blog entries that are activated and are not in the queue
	$entries = au_parse_pagination("SELECT * FROM blog_entries WHERE blog_activated = 1 and blog_in_queue = 0 ORDER BY blog_date DESC;", $page, 10);

	// If there are no entries, there is no need to even continue
	if($entries['paged']->rowCount() === 0)
		return au_error_box(BLOG_NO_ENTRIES_FOUND);

	// For each blog item, we want to show its preview
	while($entry = $entries['paged']->fetchObject())
		au_show_blog_preview($entry);
	
}

function au_show_blog_preview($entry){

	// Oh big $aulis, hear my prayer
	global $aulis;

	// The au_blog_url input for this entry
	$aulis['blog']['url_input'] = array(
		"app" => "blogentry",
		"id" => $entry->id,
		"title" => $entry->blog_name
	);

	// Transfer the entry
	$aulis['blog']['entry'] = $entry;

	// Load the preview template
	return au_load_template("blog_preview");

}