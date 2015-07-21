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
		au_out('<div class="blog_preview_page_title"><span class="float-right lowercase">' . sprintf(BLOG_SEARCH_FOUND_HITS, au_format_number($aulis['blog_count'], 0), (($aulis['blog_count'] > 1 || $aulis['blog_count'] == 0) ? BLOG_SEARCH_FOUND_HITS_PLURAL : BLOG_SEARCH_FOUND_HITS_SINGULAR)) . '</span>
			<h1>' . sprintf(BLOG_SEARCH_TITLE, '\'' . $aulis['blog_search'] . '\'') . '</h1></div>
			<div class="blog_preview_page_title_sub"><a class="button" href="' . au_blog_url() . '">' . au_icon('arrow_left', 8) . 'Back to blog</a><br /><br /></div>');
	// If we are in category, the title needs to show that
	if(isset($_GET['category']) && is_numeric($_GET['category']) && !isset($_GET['search'], $_GET['tag']) and $no_entries = BLOG_CATEGORY_NO_ENTRIES)
		au_out('<div class="blog_preview_page_title"><span class="float-right lowercase">' . sprintf(BLOG_FOUND_HITS, au_format_number($aulis['blog_count'], 0), (($aulis['blog_count'] > 1 || $aulis['blog_count'] == 0) ? BLOG_FOUND_HITS_PLURAL : BLOG_FOUND_HITS_SINGULAR)) . '</span>
			<h1>' . sprintf(BLOG_CATEGORY_TITLE, '\'' . au_get_blog_category_name($aulis['blog_category']) . '\'') . '</h1></div>
			<div class="blog_preview_page_title_sub"><a class="button" href="' . au_blog_url() . '">' . au_icon('arrow_left', 8) . 'Back to blog</a><br /><br /></div>');

	// If there are no entries parsed, we need to show that
	if(!isset($aulis['page']['blog_preview']) || empty($aulis['page']['blog_preview']))
		au_error_box($no_entries, 'blog_preview');
		
	// Let's output the page links we want into $aulis['blog_preview'], so that it gets parsed in a nice wrapper
	au_out('<br /><div class="maxwidth">' . au_blog_index_timeline_links() . '</div>', ($aulis['blog_count'] != 0 and $aulis['blog_max_offset'] != 0), 'blog_preview');

	// Finalize the output; rendering it into nice wrappers.
	$output = '';

	foreach($aulis['page']['blog_preview'] as $number => $entry)
		$output .= '<div class="blog_preview_wrapper w-' . $number . '">'.$entry.'</div>';

	// Wrap it again, for easy jQuery selection of all preview elements
	au_out('<div class="blog_previews">' . $output . '</div>');

	// We want a clean page
	au_out('<br class="clear" />');

}

function au_blog_index_timeline_links(){

	// We need $aulis, all information we need is stored there
	global $aulis;

	$links = '';

	// We need to make input for the au_blog_url function
	$href_older = array(
			"app" => "blogindex",
			"offset" => $aulis['blog_next_offset']
		);
	$href_newer = array(
			"app" => "blogindex",
			"offset" => $aulis['blog_previous_offset']
		);

	// Do we need a to add search, category or tag paramaters to the hrefs?
	if(isset($_GET['search']) and !isset($_GET['tag'], $_GET['category'])){
		$href_older['search'] = $_GET['search'];
		$href_newer['search'] = $_GET['search'];
	}
	if(isset($_GET['category']) and !isset($_GET['tag'], $_GET['search'])){
		$href_older['category'] = $_GET['category'];
		$href_older['category_name'] = au_get_blog_category_name($_GET['category']);
		$href_newer['category_name'] = au_get_blog_category_name($_GET['category']);
		$href_newer['category'] = $_GET['category'];
	}
	if(isset($_GET['tag']) and !isset($_GET['category'], $_GET['search'])){
		$href_older['tag'] = $_GET['tag'];
		$href_newer['tag'] = $_GET['tag'];
	}

	// Is the newer link the link to the newest entries, we don't need offset then
	if($href_newer['offset'] == 0)
		unset($href_newer['offset']);

	// Are we that far behind that we have newer as well?
	if($aulis['blog_current_offset'] != 0)
		$links .= '<span class="float-right"><a href="' . au_blog_url($href_newer) . '">' . BLOG_NEWER_ENTRIES . '</a></span>';

	// Are there, like, any older entries?
	if($aulis['blog_next_offset'] < $aulis['blog_count'])
		$links .= '<span class="float-left"><a href="' . au_blog_url($href_older) . '">' . BLOG_OLDER_ENTRIES . '</a></span>';
	

	return $links;
}
