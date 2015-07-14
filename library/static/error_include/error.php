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
||		-> error.php
| 		-> // Fatal error display
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// Another one as well
$aulis['error_display'] = "test";

// Find the perfect error information for our code
switch ((int)$aulis['error_code']) {
  case 1:
    $aulis['error_display'] = "Database error.";
    break; 
  case 2:
    $aulis['error_display'] = "Failed to load the theme.";
    break;
  case 3:
    $aulis['error_display'] = "Template could not be loaded.";
    break;
  case 4:
    $aulis['error_display'] = "Language file could not be loaded.";
    break;
  case 5:
    $aulis['error_display'] = "Database type is unknown.";
    break; 
  default:
    $aulis['error_display'] = "Unknown error.";
    break;
}

// IT'S VERY IMPORTANT THAT WE NEUTRALIZE THE DATABASE USERNAME AND PASSWORD
$aulis['db_user'] = "*******";
$aulis['db_password'] = "*******";

// Well, it's time for the template, simple to find in this static folder
include_once "template.php"; 


?>