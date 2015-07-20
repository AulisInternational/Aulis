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

	// What error do we need to show if no entries are found?
	$no_entries = BLOG_NO_ENTRIES_FOUND;

	// The sidebar, needs to be on top
	au_load_template('blog_sidebar');

	// If we are searching, we need to have a title and such
	if(isset($_GET['search']) && !isset($_GET['category'], $_GET['tag']) && $no_entries = sprintf(BLOG_SEARCH_NO_ENTRIES, $aulis['blog_search']))
		au_out('<div class="blog_preview_page_title"><h1>' . sprintf(BLOG_SEARCH_TITLE, '\'' . $aulis['blog_search'] . '\'') . '</h1></div><div class="blog_preview_page_title_sub">' . sprintf(BLOG_SEARCH_FOUND_HITS, au_format_number($aulis['blog_count'], 0), (($aulis['blog_count'] > 1 || $aulis['blog_count'] == 0) ? BLOG_SEARCH_FOUND_HITS_PLURAL : BLOG_SEARCH_FOUND_HITS_SINGULAR)) . '</div>');
	// If we are in category, the title needs to show that
	if(isset($_GET['category']) && is_numeric($_GET['category']) && !isset($_GET['search'], $_GET['tag']) and $no_entries = BLOG_CATEGORY_NO_ENTRIES)
		au_out('<div class="blog_preview_page_title"><h1>' . sprintf(BLOG_CATEGORY_TITLE, '\'' . au_get_blog_category_name($aulis['blog_category']) . '\'') . '</h1></div><div class="blog_preview_page_title_sub">' . sprintf(BLOG_FOUND_HITS, au_format_number($aulis['blog_count'], 0), (($aulis['blog_count'] > 1 || $aulis['blog_count'] == 0) ? BLOG_FOUND_HITS_PLURAL : BLOG_FOUND_HITS_SINGULAR)) . '</div>');

	// If there are no entries parsed, we need to show that
	if(!isset($aulis['page']['blog_preview']) || empty($aulis['page']['blog_preview']))
		au_out("<br /><br />", true, 'blog_preview') . au_error_box($no_entries, 'blog_preview');
		
	// We want page links!
	$links = '';
	var_dump($aulis);
	if($aulis['previous_offset'] < $aulis['blog_count'])
		$links .= '<span class="floatleft">' . BLOG_OLDER_ENTRIES . '</span>';
	au_out('<br />' . $links, true, 'blog_preview');

	// Finalize the output
	foreach($aulis['page']['blog_preview'] as $entry)
			au_out('<div class="blog_preview_wrapper">'.$entry.'</div>');

	// We want a clean page
	au_out('<br class="clear" />');

}
