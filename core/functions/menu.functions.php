<?php
/*
|| Aulis
|| Organisation:	Aulis International
|| Website:			http://germanics.org/aulis
|| Developed by: 	Robert Monden
					Thomas de Roo
|| License: 		MIT
|| Version: 		1.1 Alpha 1
|| * File information * 
||		-> menu.functions.php
| 		-> // This file contains the functions that handle the menu
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// Okay, this function basically does nothing more than checking which menu items should be shown, and returns those that can
function au_menu() {

	global $aulis;
	
	// The menu array itself
	$aulis['menu'] = array(
		'index' => array(
			'text' => MENU_INDEX,
			'link' => au_url(),
			'visible' => true,
			'active' => ($aulis['active'] == 'frontpage' ? 1 : 0),
			'target' => '_self',
			'type' => 1,
		),
		'blog' => array(
			'text' => MENU_BLOG,
			'link' => au_blog_url(),
			'visible' => true,
			'active' => ($aulis['active'] == 'blog' ? 1 : 0),
			'target' => '_self',
			'type' => 1,
		),
		'forum' => array(
			'text' => MENU_FORUM,
			'link' => au_url('?app=boardindex'),
			'visible' => true,
			'active' => ($aulis['active'] == 'forum' ? 1 : 0),
			'target' => '_self',
			'type' => 1,
		),
		'login' => array(
			'text' => MENU_LOGIN,
			'link' => au_url('?app=login'),
			'visible' => true,
			'active' => ($aulis['active'] == 'login' ? 1 : 0),
			'target' => '_self',
			'type' => 1,
		),
		'register' => array(
			'text' => MENU_REGISTER,
			'link' => au_url('?app=register'),
			'visible' => true,
			'active' => ($aulis['active'] == 'register' ? 1 : 0),
			'target' => '_self',
			'type' => 1,
		),
		'admincp' => array(
			'text' => MENU_ADMIN,
			'link' => au_url('Admin.php'),
			'visible' => true,
			'active' => ($aulis['active'] == 'admincp' ? 1 : 0),
			'target' => '_self',
			'type' => 'c7',
		),
		'moderation' => array(
			'text' => MENU_MOD,
			'link' => au_url('?app=modcp'),
			'visible' => true,
			'active' => ($aulis['active'] == 'moderation' ? 1 : 0),
			'target' => '_self',
			'type' => 'c1',
		),
	);
	
	// We're done here
	return $aulis['menu'];
}