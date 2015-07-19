<?php 
/*
-->> Theme for Aulis
|| Theme name:		Hannover
|| Theme date:		2015
|| Theme info:		Aulis' default theme
|| Developed by: 	Thomas de Roo 
|| License: 		MIT
|| File: 			base_template.php
|| Last change:		July, 2015


<script src="' . $aulis['absolute_path'] . 'themes/hannover/scroll-header.js"></script>

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
	  		<div class="iconstack float-left">
	  			<a href="javascript:void();">' . au_icon('menu', 24, 'black') . '</a>
	  			<a href="javascript:void();">' . au_icon('house', 24, 'black') . '</a>
	  		</div> 
	  		<img src="' . $aulis['absolute_path'] . 'themes/hannover/images/logo.svg" />
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
	  	<div class="wrapper bg4">
		  	<div class="page white">
				' . $aulis['page']['final_content'] . '
		  	</div>
	  	</div>
  	</main>
  	<div class="footer">
		<div class="float-right"><strong>' . FOOTER_LANGUAGE . '</strong>' . LANGUAGE_NAME . '</div>
		<div class="float-left"><img src="' . $aulis['absolute_path'] . 'themes/hannover/images/logo_footer.svg" /> 
		  <a href="http://germanics.org/aulis" target="_blank">' . $aulis['copyright'] . '</a></div>
  	</div>
  	<br class="clear" />
  </body>
</html>';