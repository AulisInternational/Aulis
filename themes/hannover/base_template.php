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
*/
global $aulis; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
	<?php
  		echo $aulis['page']['title']." - ".au_get_setting("site_title");
  	?>
    </title>
    <link rel="stylesheet" href="themes/hannover/css/main.css">
    <link rel="stylesheet" href="library/css-assets/icons.css">
 	<link rel="shortcut icon" type="image/png" href="library/static/favicon.png" />
 	<script src="library/js-assets/jquery-1.11.3.min.js"></script>
 	<script src="themes/hannover/scroll-header.js"></script>
  </head>
  <body class="bg4">
  	<header>
  		<div class="top-stripe bg1"></div>
  		<div class="logobar bg2">
	  		<div class="iconstack float-left">
	  			<a class='icon i-menu i-24' href="javascript:void();"></a>
	  			<a class='icon i-house i-24' href="javascript:void();"></a>
	  		</div> 
	  		<img src="themes/hannover/images/logo.png" />
  		</div>
  		<div class="navbar bg3">
	  		<div class="menustack float-left">
	  			<a href="javascript:void();">Home</a>
	  			<a href="javascript:void();">Forum</a>
	  			<a href="javascript:void();">Log in</a>
	  			<a href="javascript:void();">Sign up</a>
	  			<a href="javascript:void();" class="c7">Admin panel</a>
	  			<a href="javascript:void();" class="c1">Moderate (11)</a>
  			</div>
  		</div>
  		<script>
		 $('header').mouseenter(function(){
		    $('.nav-up').removeClass('nav-up');
		});
		 $('header').mouseleave(function(){
		 	if(wearedown){
		 		$(this).addClass('nav-up');
		 	}
		});
		</script>
  	</header>
  	<main>
	  	<div class="wrapper bg4">
		  	<div class="page white">
		  	<?php
		  		echo $aulis['page']['final_content'];
		  	?>
		  	</div>
	  	</div>
  	</main>
  	<div class="footer">
  	<img src="themes/hannover/images/logo_footer.png" />
  	powered by <a href="http://germanics.org/aulis">Aulis  0.01</a>
  	</div>
  	<br class="clear" />
  </body>
</html>