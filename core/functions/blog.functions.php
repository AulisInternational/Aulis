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
function au_exist_blog_entry($entry_id){

	// Try to get the entry from the database
	$entry = au_query("SELECT id FROM blog_entries WHERE id = " . $entry_id . " LIMIT 1;");

	// This function was quick, we are done already
	return ($entry->rowCount() === 1);

}

// This function gets and returns a blog entry from the database
function au_get_blog_entry($entry_id){

	// We can only get an item that exists, though
	if(!au_get_blog_entry($entry_id))
		return false;

	// Return database object
	return au_query("SELECT * FROM blog_entries WHERE id = " . $entry_id . " LIMIT 1;");

}


// Category functions below:

// This function gets the name of a category
function au_get_blog_category_name($category_id){

	// Let's get the category in question form the database
	$category = au_query("SELECT category_name FROM blog_categories WHERE id  = {$category_id} LIMIT 1;");

	// It has to exist
	if($category->rowCount === 0)
		return false;

	// Fetch the object
	$obtained_category = $category->fetchObject();

	// And return the name
	return $obtained_category->category_name;

}