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
||		-> icon.template.php
| 		-> // This file handles how icons are outputted
|| 		-> Last change: July, 2015
*/

// The only thing this template does is defining a constant that is used for icon display
function au_template_icon(){

	// Our template needs the big $aulis
	global $aulis;

	// This defines the icon display, handled by the au_icon function
	$aulis['icon_display'] = '<span class="icon i-%s">%s</span>';

}
