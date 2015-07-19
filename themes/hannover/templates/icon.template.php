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

global $aulis;

$aulis['icon_output'] = "<span class='icon'>" . file_get_contents(au_get_path_from_root('library/icons/' . $aulis['icon_name'] . '.svg')) . "</span>";

//$aulis['icon_output'] = "<svg viewBox='0 0 16 16' width='16' height='16'><use xlink:href='" . au_url('library/icons/' . $aulis['icon_name'] . '.svg') . "'></use></svg>";