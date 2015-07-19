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
||		-> boardindex.php
| 		-> // This file contains the logic for the boardindex
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

function au_show_boardindex(){

	global $aulis; 

	// Dummy content
	au_out("This is dummy content, we will show the smilies here, because they need to be tested anyway.<br /><br/>");

	foreach (glob($aulis['root_path'] . '/library/smilies/*.svg') as $smiley)
		au_out(au_smiley(basename($smiley,'.svg')) . ' ');

}

