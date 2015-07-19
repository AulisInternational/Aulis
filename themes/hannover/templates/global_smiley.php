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
||		-> global_smiley.php
| 		-> // This file handles how smilies are outputted
|| 		-> Last change: July, 2015
*/

// The only thing this template does is defining a variable that is used for icon display
function au_template_global_smiley(){

	// Our template needs the big $aulis
	global $aulis;

	// This defines the smiley display, handled by the au_smiley function
	$aulis['smiley_display'] = '<img class="smiley s-%s" src="%s" />';

}