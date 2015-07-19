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
||		-> blog_preview.php
| 		-> // This file the template of the preview of entries in the blog index
|| 		-> Last change: July, 2015
*/
function au_template_blog_preview(){

	// Our template needs the big $aulis
	global $aulis;

	// Let's make this thing shorter
	$e = $aulis['blog']['entry'];

	// We might have to highlight stuff
	if(isset($_GET['search']))
	{
		$exploded_search = explode(' ', $aulis['blog_search']);
		foreach ($exploded_search as $keyword) {
			$e->blog_name = au_highlight($keyword, $e->blog_name, "<span class='highlight'>", "</span>");
			$e->blog_intro = au_highlight($keyword, $e->blog_intro, "<span class='highlight'>", "</span>");
		}
	}

	// The href to the blog entry page
	$href = au_blog_url($aulis['blog']['url_input']);

	// The heading
	au_out("<h1><a href='" . $href . "'>" . $e->blog_name . "</a></h1>", true, 'blog_entries');

	// The sub heading with time and catergory
	au_out("<span class='sub'>" . au_icon('category', 12) . ' ' . sprintf(BLOG_POSTED_IN, "<a href='" . au_url("?app=blogindex&category=" . $e->blog_category) . "'>" . au_get_blog_category_name($e->blog_category) . "</a>") . "
		 " . au_icon('clock', 12) . ' ' . au_date($e->blog_date) . "</span>", true, 'blog_entries');

	// The content
	au_out("<p>" . au_parse_blog($e->blog_intro) . "</p>", true, 'blog_entries');

	// Ready for the next one
	unset($aulis['blog']['entry']);

}