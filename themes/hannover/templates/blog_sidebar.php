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
||		-> blog_sidebar.php
| 		-> // This file is the full, merged template of the blog index where the sidebar and blog previews are shown
|| 		-> Last change: July, 2015
*/


// The main function containing the contents of the side bar
function au_template_blog_sidebar(){

	// Our template needs the big $aulis
	global $aulis;

	return au_out('<div class="blog_sidebar">
			' . au_blog_sidebar_search() . '
			' . au_blog_sidebar_categories() . '
		</div>');

}

function au_blog_sidebar_search($value = ''){

	// Do we need to show the previous search query?
	if(isset($_GET['search']))
		$value = $_GET['search'];

	// The form
	$search_form =  '<form method="POST" action="' . au_url('?app=blogindex') . '">
				<input name="search" type="text" value="' . $value . '"/>
				<input type="submit" value="' . BLOG_SEARCH_BTN . '" />
		</form>';

	// Creating the block
	return au_sidebar_block(BLOG_SEARCH, 'search', $search_form);

}

function au_sidebar_block($title, $icon, $content){

	return '<div class="block">
		<span class="title">' . au_icon($icon, 12) . ' ' . $title . '</span><br />
		' . $content . '
		</div>';

}

function au_blog_sidebar_categories(){

	// Temp output
	$output = '';

	// The title and such

	// We need to get the blog categories
	$categories = au_get_blog_categories();

	// If there are no categories, that needs to be shown
	if($categories->rowCount() === 0)
		return au_sidebar_block(BLOG_CATEGORIES, 'category', BLOG_CATEGORIES_NONE);

	// For each category we need to show a line 
	while($category = $categories->fetchObject()){

		// We need an url element for the au_blog_url function
		$category_url = array(
			"app" => "blogindex",
			"category" => $category->id,
			"category_name" => $category->category_name
		);

		$output .= '<a href=' . au_blog_url($category_url) . '>' . $category->category_name . '</a><br />';
	}

	// Remove the final <br />
	$output = preg_replace('/'. preg_quote('<br />', '/') . '$/', '', $output);

	// Return a neat side bar block
	return au_sidebar_block(BLOG_CATEGORIES, 'category', $output);

}
