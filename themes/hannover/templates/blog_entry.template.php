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
||		-> blog_entry.template.php
| 		-> // This file is the template of the full view of blog entries
|| 		-> Last change: July, 2015
*/

function au_template_blog_entry(){

	// Our template needs the big $aulis
	global $aulis;

	// Let's make this thing shorter
	$e = $aulis['blog']['entry'];

	// The href to the blog entry page
	$href = au_blog_url($aulis['blog']['url_input']);

	// The wrapper
	au_out("<div class='blog_full_wrapper'>");

	// The heading
	au_out("<h1><a href='" . $href . "'>" . $e->blog_name . "</a></h1>");

	// The sub heading with time and catergory
	au_out("<span class='sub'><a class='icon i-category i-12'></a> " . sprintf(BLOG_POSTED_IN, "<a href='" . au_url("?app=blogindex&category=" . $e->blog_category) . "'>" . au_get_blog_category_name($e->blog_category) . "</a>") . "
		 <a class='icon i-clock i-12'></a> " . au_date($e->blog_date) . "</span>");

	// The content
	au_out("<p>" . au_parse_blog($e->blog_content) . "</p>");

	// Ending the wrapper
	au_out("</div>");

	// Ready for the next one
	unset($aulis['blog']['entry']);

}
