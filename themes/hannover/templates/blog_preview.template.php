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
||		-> blog_preview.template.php
| 		-> // This file the template of the preview of entries in the blog index
|| 		-> Last change: July, 2015
*/

// Let's make this thing shorter
$e = $aulis['blog']['entry'];

// The wrapper
au_out("<div class='blog_preview_wrapper'>");

// The heading
au_out("<h1>" . $e->blog_name . "</h1>");

// The sub heading with time and catergory
au_out("<span class='sub'><a class='icon i-category i-12'></a> " . sprintf(BLOG_POSTED_IN, "<a href='" . au_url("?app=blog&category=" . $e->blog_category) . "'>" . au_get_blog_category_name($e->blog_category) . "</a>") . "
	 <a class='icon i-clock i-12'></a> " . au_date($e->blog_date) . "</span>");

// The content
au_out("<p>" . au_parse_blog($e->blog_intro) . "</p>");

// Ending the wrapper
au_out("</div>");

// Ready for the next one
unset($aulis['blog']['entry']);