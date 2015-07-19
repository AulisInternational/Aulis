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
| 		-> // This file is the full, merged template of the blog index where the sidebar and blog previews are shown
|| 		-> Last change: July, 2015
*/

function au_template_blog_index(){

	// Our template needs the big $aulis
	global $aulis;

	// If we are searching, we need to have a title and such
	if(isset($_GET['search']))
		au_out('<h1>' . sprintf(BLOG_SEARCH_TITLE, '\'' . $aulis['blog_search'] . '\'') . '</h1>' . sprintf(BLOG_SEARCH_FOUND_HITS, au_format_number($aulis['blog_count'], 0), (($aulis['blog_count'] > 1 || $aulis['blog_count'] == 0) ? BLOG_SEARCH_FOUND_HITS_PLURAL : BLOG_SEARCH_FOUND_HITS_SINGULAR)));

	// The sidebar

	au_load_template('blog_sidebar');

	// The previews:

	foreach($aulis['page']['blog_entries'] as $entry)
		au_out('<div class="blog_preview_wrapper">'.$entry.'</div>');

}
