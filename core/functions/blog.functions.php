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



// Blog url functions:


// This function is used to rewrite urls for the blog core, if enabled though
function au_blog_url($input, $header = false)
{

	// Global the big $aulis
	global $aulis;

	// The input needs to be an array
	if(!is_array($input) and array_key_exists("app", $input))
		return au_url("?", $header);

	// Is blog rewriting enabled?
	if(au_get_setting("enable_blog_url_rewriting") == "1"){
		if($input['app'] == "blogentry")
			return au_url("entries/" . au_encrypt_blog_id($input['id']) . "/" . strtolower(str_replace(array(" ", "?", "!", "&"), array("-", "","",""), $input['title'])), $header);
		// Place holder
		else
			return au_url("?".http_build_query($input));
	}

	// Otherwise just a normal url
	return au_url("?".http_build_query($input));

}

function au_encrypt_blog_id($id){

	// return the encrypted blog_id
	return $id * 8273 + 100;

}

function au_decrypt_blog_id($id){

	return ($id - 100) / 8273;

}