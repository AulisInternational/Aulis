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
		</div>');

}

function au_blog_sidebar_search($value = ''){

	// Do we need to show the previous search query?
	if(isset($_GET['search']))
		$value = $_GET['search'];

	return '<form method="POST" action="' . au_url('?app=blogindex') . '">
				<input name="search" type="text" value="' . $value . '"/>
				<input type="submit" value="Search" />
		</form>';

}

function au_blog_sidebar_category(){

	// We need to get the blog categories

}
