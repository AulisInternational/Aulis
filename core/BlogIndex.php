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
	global $aulis, $setting;

	// Did our lovely user specify an offset?
	if(isset($_GET['offset']) && is_numeric($_GET['offset']))
		$offset = $_GET['offset'];

	// Oh noes... he didn't, we need to assume the initial offset of 0 then
	else
		$offset = 0;

	// Extra parameters, in case we need them
	$extra_parameters = '';

	// Are we searching?
	if(isset($_REQUEST['search']) && !isset($_REQUEST['category'], $_REQUEST['tag']))
	{

		// Empty searches are not allowed
		if(trim($_REQUEST['search']) == '')
			au_blog_url('', true);

		// Do we maybe need to clean a search string before redirecting?
		if(isset($_POST['search']) && $_POST['search'] != '')
		{

			// Do we need to clean it or is urlencode enough?
			if($setting['enable_blog_url_rewriting'] == 1)
				$search_string = au_string_clean($_POST['search']);
			else
				$search_string = urlencode($_POST['search']);

			// The cleaned string cannot be empty
			if($search_string != '')
				// Redirect to clean url if possible
				if($setting['enable_blog_url_rewriting'] == 1)
					au_url('blog/search/'.$search_string, true);
				// Otherwise, we need to redirect to normal url
				else
					au_url('?app=blogindex&search=' . $search_string, true);

			// Nothing more here for us now
			die();

		}

		// Do we maybe need to unclean the search string?
		if(isset($_GET['search']) && isset($_GET['rewrite']))
			$aulis['blog_search'] = str_replace("+", " ", $_GET['search']);
		// We need to decode it instead, if it exists, though
		else if(isset($_GET['search']))
			$aulis['blog_search'] = urldecode($_GET['search']);
		else
			$aulis['blog_search'] = '';

		// Time to form the extra parameters
		$exploded_search = explode(' ', $aulis['blog_search']);
		foreach ($exploded_search as $keyword) {
			$regex = "REGEXP '[[:<:]]".$keyword."[[:>:]]'";
			$extra_parameters .=  " AND (blog_name {$regex} OR blog_intro {$regex} OR blog_content {$regex})";
		}

	}

	// Do we have to add parameters for category or tag to the query?
	if((isset($_GET['category']) && is_numeric($_GET['category'])) && !isset($_GET['search'], $_GET['tag']) && $aulis['blog_category'] = $_GET['category'])
		$extra_parameters .= ' AND '.(isset($_GET['category']) ? "blog_category = {$_GET['category']}" : '');

	// Let's build the query
	$query = "SELECT * FROM blog_entries WHERE blog_activated = 1 and blog_in_queue = 0 {$extra_parameters} ORDER BY blog_date DESC;";

	// Let's load all blog entries that are activated and are not in the queue (thus are published)
	$entries = au_parse_pagination($query, true, $offset, THEME_BLOG_ENTRIES_PER_PAGE);

	// For each blog item, we want to show its preview
	while($entry = $entries['paged']->fetchObject())
		au_show_blog_preview($entry);

	// We might want to transfer the information about the pagination, so that it can be used in the template
	$aulis['blog_count'] = $entries['unpaged_count'];
	$aulis['blog_current_offset'] = $offset;
	$aulis['blog_next_offset'] = $entries['next_position'];
	$aulis['blog_previous_offset'] = $entries['previous_position'];

	// This will load the wrapper! :)
	return au_load_template('blog_index');	
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