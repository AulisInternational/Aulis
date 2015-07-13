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
||		-> icons_stylesheet.php
| 		-> // This file forms the stylesheet reffering to all the svg icons
|| 		-> Last change: July, 2015
*/
header("Content-type: text/css");

foreach (glob("../icons/*.svg") as $filename)
	echo ".i-".basename($filename, ".svg")."{
	mask-image: url(".$filename.");
    -webkit-mask-image: url(".$filename.");
	}";