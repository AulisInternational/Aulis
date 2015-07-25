<?php 

/*
|| Aulis
|| Organisation:  Aulis International
|| Website:     http://germanics.org/aulis
|| Developed by:  Robert Monden
          Thomas de Roo
|| License:     MIT
|| Version:     0.01
|| * File information * 
||    -> base_template.php
|     -> // This file handles the display of the site
||    -> Last change: July, 2015

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
    <link rel="stylesheet" href="' . $aulis['absolute_path'] . '/themes/hannover/css/admin.css">
    <link rel="stylesheet" href="' . $aulis['absolute_path'] . '/library/css-assets/icons.css">
  <link rel="shortcut icon" type="image/png" href="' . $aulis['absolute_path'] . 'library/static/favicon.png" />
  <script src="' . $aulis['absolute_path'] . 'library/js-assets/jquery-1.11.3.min.js"></script>
  </head>
  <body class="admin">
  	<div class="topbar">
          <a class="button" href="index.php">' . au_icon('arrow_left', 12) . ' ' . ADMIN_BACK_TO_SITE . '</a>
          <img class="logo" alt="[au]lis" src="' . $aulis['absolute_path'] . 'themes/hannover/images/logo.svg" />  
       <br class="clear" /> 
    </div>
  <div class="icon-menu">
  aaa
      <br class="clear" />
  </div>
  <div class="side-menu">
      <br class="clear" />
	</div>
	<div class="canvas">
		<div class="logo-container">

		</div>
    <br class="clear" />  	
	</div>  	

  </body>
</html>';