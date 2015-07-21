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
||		-> blog.functions.php
| 		-> // This file contains the functions that concern the blog
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// This function will check whether or not we have a requested blog entry aboard
function au_exist_blog_entry($entry_id, $encrypted = false){

	// Do we have to decrypt?
	if($encrypted)
		$entry_id = au_decrypt_blog_id($id);

	// Try to get the entry from the database
	$entry = au_query("SELECT id FROM blog_entries WHERE id = " . $entry_id . " LIMIT 1;");

	// This function was quick, we are done already
	return ($entry->rowCount() === 1);

}

// This function gets and returns a blog entry from the database
function au_get_blog_entry($entry_id){

	// We can only get an item that exists, though
	if(!au_exist_blog_entry($entry_id))
		return false;

	// Return database object
	$query = au_query("SELECT * FROM blog_entries WHERE id = " . $entry_id . " LIMIT 1;");
	return $query->fetchObject();

}


// Category functions below:

// Function the check whether a certain category exists
function au_exists_blog_category($id){

}

// This function gets the name of a category
function au_get_blog_category_name($category_id){

	// Let's get the category in question form the database
	$category = au_query("SELECT category_name FROM blog_categories WHERE id  = {$category_id} LIMIT 1;");

	// It has to exist
	if($category->rowCount() === 0)
		return false;

	// Fetch the object
	$obtained_category = $category->fetchObject();

	// And return the name
	return $obtained_category->category_name;

}

// This function gets an database object containing all categories
function au_get_blog_categories(){
	return au_query("SELECT * FROM blog_categories ORDER BY category_order ASC;");
}


// Blog url functions:


// This function is used to rewrite urls for the blog core, if enabled though
function au_blog_url($input = '', $header = false)
{

	// Global the big $aulis
	global $aulis;

	// The input needs to be an array otherwise we will redirect to the blogindex
	if(!(is_array($input) and $input != ''))
		return au_url(((au_get_setting("enable_blog_url_rewriting") == "1") ? 'blog' : '?'), $header);

	// If we are an array, we have to have the app value
	if(!array_key_exists("app", $input))
		return au_url(((au_get_setting("enable_blog_url_rewriting") == "1") ? 'blog' : '?'), $header);

	// Is blog rewriting enabled?
	if(au_get_setting("enable_blog_url_rewriting") == "1"){
		
		// entries/number/entry-name
		if($input['app'] == "blogentry")
			return au_url("entries/" . au_encrypt_blog_id($input['id']) . "/" . strtolower(str_replace(array(" ", "?", "!", "&"), array("-", "","",""), $input['title'])), $header);
		
		// blog/?/offset/?
		else if($input['app'] == "blogindex" && array_key_exists('offset', $input))
			if(array_key_exists('search', $input))
				return au_url('blog/search/' . $input['search'] . '/offset/' . $input['offset'], $header);
			else if(array_key_exists('category', $input) && array_key_exists('category_name', $input))
				return au_url('blog/category/' . $input['category']  . '/offset/' . $input['offset'] . '/' . au_string_clean($input['category_name'], '-'), $header);
			else
				return au_url('blog/offset/' . $input['offset'], $header);
		
		// blog/category/?
		elseif($input['app'] == 'blogindex' && array_key_exists('category', $input) && array_key_exists('category_name', $input))
			return au_url('blog/category/' . $input['category'] . '/' . au_string_clean($input['category_name'], '-'), $header);

		
		// blog/search/?
		elseif($input['app'] == 'blogindex' && array_key_exists('search', $input))
			return au_url('blog/search/' . au_string_clean($input['search']), $header);

		// blog?
		else if($input['app'] == 'blogindex' && count($input) == 1)
			return au_url('blog', $header);

		// Place holder
		else
			return au_url("?".http_build_query($input), $header);
	}

	// Otherwise just a normal url
	return au_url("?".http_build_query($input), $header);

}

function au_encrypt_blog_id($id){

	// return the encrypted blog_id
	return (($id * 97) + 821) * 10;

}

function au_decrypt_blog_id($id){

	return (($id / 10) - 821) / 97;

}
