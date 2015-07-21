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
||		-> pagination.functions.php
| 		-> // This file contains the functions that concern pagination of all kinds
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// This functions parses a query an puts pagination limits on it
function au_parse_pagination($query, $only_offset = false, $position = 1, $items_per_page = 10){

	// We need a number for both the $page as the $items_per_page
	if(!(is_numeric($position) and is_numeric($items_per_page)))
		return false;

	// A flat request to the database
	$unpaged = au_query($query);

	// Now let's calculate our offset, that is the number of the previous page times the $items_per_page

	if(!$only_offset) 
		$offset = (($position - 1) * $items_per_page);
	else
		$offset = $position;

	// Our query cannot end in ";", so if it does, we need to remove that
	$query = trim($query, ";");

	// It's time to re-run the query, with offset this time
	$paged = au_query($query. " LIMIT ".$offset.", ".$items_per_page.";");

	// Determine the modifier for the next and previous positions
	if($only_offset)
		$modifier = $items_per_page;
	else
		$modifier = 1;

	// Let's calculate our maximum offset
	$max_offset = $unpaged->rowCount() - $items_per_page;

	// If the maximum offset is negative, it is 0
	if($max_offset < 0)
		$max_offset = 0;

	// Return an array with in it the next offset, previous offset and of course the paged database object
	return array("max_offset" => $max_offset, $items_per_page, "unpaged_count" => $unpaged->rowCount(), "paged" => $paged, "next_position" => $position + $modifier,"previous_position" => $position - $modifier);

}

// This function checks if an offset is right or not
function au_check_offset($offset, $items_per_page, $max_offset){

	if($offset < 0)
		return false;
	else if($offset == 0)
		return true;
	else if($offset > $max_offset)
		return false;
	else if (!($offset % $items_per_page == 0))
		return false;
	else if ($offset % $items_per_page == 0)
		return true;

}


// This functions makes an offset valid
function au_validate_offset($offset, $items_per_page, $max_offset){

	if($offset < 0)
		$offset = 0;
	else if($offset > $max_offset)
		$offset = $max_offset;

	$new_offset = (ceil($offset)%$items_per_page === 0) ? ceil($offset) : round(($offset+$items_per_page/2)/$items_per_page)*$items_per_page;

	// We need to check it though
	while(au_check_offset($new_offset, $items_per_page, $max_offset) === false){
		$new_offset = $new_offset - $items_per_page;
	}

	return $new_offset;

}