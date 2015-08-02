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
||		-> Login.php
| 		-> // This file makes sure we're able to log in
|| 		-> Last change: August, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");
	
// This function thinks it's pretty important. It's probably right.
function au_login() {

	global $aulis;
	
	// Error messages!
	$errormsg = array();
	
	// Are we currently attempting to login?
	if(isset($_POST['au_login'])) {
	
		// Did we provide our username?
		if(empty($_POST['au_username']))
			$errormsg[] = LOGIN_NO_USERNAME;
			
		// What about our password?
		if(empty($_POST['au_password']))
			$errormsg[] = LOGIN_NO_PASSWORD;
			
		// Create variables that are easier to type
		$login['username'] = $_POST['au_username'];
		$login['password'] = $_POST['au_password'];
			
		// Usernames don't contain HTML
		if($login['username'] != htmlspecialchars($login['username'], ENT_NOQUOTES, 'UTF-8', false))
			$errormsg[] = LOGIN_USERNAME_NO_HTML;
			
		// We don't want to mess up the database
		$login['username'] = mysqli_real_escape_string($aulis['connection'], $login['username']);
		
		// Hash the password
		$login['password'] = au_hash($login['password']);
		
		// Okay. Now check if the database has any record of the user
		$result = au_query("
			SELECT user_id, user_username, user_password
				FROM users
				WHERE user_username = '" . $login['username'] . "'
		");
		
			// This is only run if the user exists
			foreach($result as $userlogin) {
			
				// Get the user id
				$userid = $userlogin['user_id'];
			
				// Does the password match?
				if($userlogin['user_password'] == $login['password'])
					$correctpass = true;
				else
					$errormsg[] = LOGIN_PASSWORD_FAIL;
			}
			
		// Can we login?
		if(!empty($correctpass)) {
		
			// The user agent
			$login['user_agent'] = mysqli_real_escape_string($aulis['connection'], $_SERVER['HTTP_USER_AGENT']);
			
			// The IP address
			$login['user_ip'] = addslashes($_SERVER['REMOTE_ADDR']);
		
			// How long should we keep the session active?
			$sessionlength = (!empty($_POST['au_forever']) ? '0' : '60');
		
			// Set the session
			$_SESSION[$setting['session_name']] = array(
				'user' => $userid,
				'agent' => $login['user_agent'],
				'ip' => $login['user_ip'],
				'sessionlength' => $sessionlength
			);
			
			// Show a nice information page
			template_info(
				'login_success',
				'login_success_title',
				'user_green.png',
				$basefilenq,
				'login_link'
			);
		}
	}
	
	// This array is used in the login template
	$logindata = array(
		'errors' => (empty($_POST['au_login']) ? 0 : 1),
		'error_message' => $errormsg,
		'username' => (!empty($login['username']) ? $login['username'] : ''),
	);

	// Okay, load this app's template
	au_load_template('login', false);
	
	// Show the registration template
	au_template_login((!empty($login_complete) ? true : false));
}