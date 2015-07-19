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

function au_parse_pagination($query, $only_offset = false, $position = 1, $items_per_page = 10){

	// We need a number for both the $page as the $items_per_page
	if(!(is_numeric($position) and is_numeric($items_per_page)))
		return false;

	// A flat request to the database
	$unpaged = au_query($query);

	// At first we want to know what our maximum offset is

	// Let's check if we have enough to fill more than one page...
	if($unpaged->rowCount() > $items_per_page)
		$maximum_offset = abs($unpaged->rowCount() - $items_per_page);
	// We don't... so we don't need offset then
	else
		$maximum_offset = 0;

	// Now let's calculate our offset, that is the number of the previous page times the $items_per_page

	if(!$only_offset) 
		$offset = (($position - 1) * $items_per_page);
	else
		$offset = $position;

	// Let's see if out offset is possible...
	if($maximum_offset == 0)
		$offset = 0;
	else if($offset > $maximum_offset)
		$offset = $maximum_offset;

	// Our query cannot end in ";", so if it does, we need to remove that
	$query = trim($query, ";");

	// It's time to re-run the query, with offset this time
	$paged = au_query($query. " LIMIT ".$offset.", ".$items_per_page.";");

	// Determine the modifier for the next and previous positions
	if($only_offset)
		$modifier = $items_per_page;
	else
		$modifier = 1;

	// Return an array with in it the next offset, previous offset and of course the paged database object
	return array("unpaged_count" => $unpaged->rowCount(), "paged" => $paged, "next_position" => $position + $modifier,"previous_position" => $position - $modifier);

}