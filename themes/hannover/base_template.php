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
||		-> base_template.php
| 		-> // This file handles the display of the site
|| 		-> Last change: July, 2015

-------------------------------------------------------
-->> Theme for Aulis
	Hannover version 1.0
	Thomas de Roo & Robert Monden

*/

echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
		' . $aulis['page_title']. '
    </title>
    <link rel="stylesheet" href="' . $aulis['absolute_path'] . '/themes/hannover/css/main.css">
    <link rel="stylesheet" href="' . $aulis['absolute_path'] . '/library/css-assets/icons.css">
 	<link rel="shortcut icon" type="image/png" href="' . $aulis['absolute_path'] . 'library/static/favicon.png" />
 	<script src="' . $aulis['absolute_path'] . 'library/js-assets/jquery-1.11.3.min.js"></script>
  </head>
  <body class="bg4">
  	<header>
  		<div class="top-stripe bg1"></div>
  		<div class="logobar bg2">
  			<div class="userstack float-right">
  				<a href=""><img src="' . $aulis['absolute_path'] . '/uploads/avatars/80183_1.png" /></a>
  				<span class="username"><a href="">Charlie ' . au_icon('small_arrow_down', 8, 'black') . '</a></span>
  			</div>
	  		<div class="iconstack float-left">
	  			<a href="javascript:void();">' . au_icon('menu', 24, 'black') . '</a>
	  			<a href="javascript:void();">' . au_icon('house', 24, 'black') . '</a>
	  		</div> 
	  		<a href="' . au_url() . '"><img src="' . $aulis['absolute_path'] . 'themes/hannover/images/logo.svg" /></a>
  		</div>
  		<div class="navbar bg3">
	  		<div class="menustack float-left">';
			
			
		// Load the main menu
		$menu_tabs = au_menu();
			
		// Show the tabs
		foreach($menu_tabs as $tab)
			if($tab['visible'] == true)
				echo '
					<a href="' . $tab['link'] . '"' . (($tab['active'] == 1 || $tab['type'] != 1) ? ' class="' . ($tab['active'] == 1 ? 'active' : '') . ($tab['type'] != 1 ? ($tab['active'] == 1 ? ' ' : '') . $tab['type'] : '') . '"' : '') . ' target="' . $tab['target'] . '">' . $tab['text'] . '</a>';
			
		echo '
  			</div>
  		</div>
  		<script>
		 $(\'header\').mouseenter(function(){
		    $(\'.nav-up\').removeClass(\'nav-up\');
		});
		 $(\'header\').mouseleave(function(){
		 	if(wearedown){
		 		$(this).addClass(\'nav-up\');
		 	}
		});
		</script>
  	</header>
  	<main>
	  	<div class="wrapper">
		  	<div class="page white">
				' . $aulis['page']['final_content'] . '
		  	</div>
	  	</div>
  	</main>
  	<footer>
		<div class="float-right"><strong>' . FOOTER_LANGUAGE . '</strong>' . LANGUAGE_NAME . '</div>
		 <a href="http://aulis.germanics.org" target="_blank">' . $aulis['copyright'] . '</a><br />
		 ' . ((DEBUG_SHOW_PREFORMANCE) ? '<span class="generated">' . sprintf(FOOTER_PAGE_GENERATED, au_format_number(((array_sum(explode(' ', microtime())) - $aulis['start_time']) * 1000)), $aulis['db_query_count']) . '</span><br />' : '') . '
  	</footer>
  	<br class="clear" />
  </body>
</html>';