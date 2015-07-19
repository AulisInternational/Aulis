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
||		-> global_error_box.php
| 		-> // This file is the template of the errorbox
|| 		-> Last change: July, 2015
*/
function au_template_global_error_box(){

	// Our template needs the big $aulis
	global $aulis;

	// This will output an errorbox in hannover style
	au_out("<div class='notice bg5 c5'>".au_icon('warning', 16, 'red')." ".$aulis['error_box_contents']."</div>", true, $aulis['error_box_output']);

}
