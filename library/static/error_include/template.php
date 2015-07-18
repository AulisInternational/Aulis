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
||		-> error_template.php
| 		-> // This template for fatal error display
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Oops</title>
    <style>
    	.page{
    		margin: 100px auto;
    		width: 80%;
    		border-radius: 10px;
    		background-color: white;
    		padding: 30px;
    		padding-top: 10px;
    	}
    	body{
    		font-family: Calibri, Arial, Verdana;
    		background-color: #c83737!important;
    	}
    	.icon{
    		color: #eee;
    		font-size: 80px;
    		float: right;
    		font-style: italic;
    		user-select: none;
			-moz-user-select: none; 
       		-webkit-user-select: none; 
    	}
    	.details
    	{
    		padding: 15px;
    		font-family: monospace;
    		color: #777;
    		background-color: #e3e3e3;
    		border: lightgray 1px solid;
    		margin-top: 30px;
    	}
    </style>
  </head>
  <body>
  	<div class="page">
  		<div class='icon'>[!]</div>
  		<h1>Fatal error</h1>
  		We are sorry. Aulis failed in preforming your request, details are shown below.<br />
  		<div class="details">
  			<strong>Error code <?php echo $aulis['error_code'] ?></strong><br/><br/>
  			<em><?php echo $aulis['error_display'] . " " . $aulis['error_message']; ?></em>
  		</div>
  	</div>
  </body>
</html>