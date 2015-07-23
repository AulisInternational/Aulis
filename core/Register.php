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
||		-> Register.php
| 		-> // This file contains the functions that handle the user registration process
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");

// The main registration function
function au_register(){

	global $aulis, $setting, $language;
	
	// We might need this later
	$errormsg = array();
	$register = array();
	
	// Ok, so are we currently attempting to add a new account to the database?
	if(!empty($_POST['aulis_register'])) {
	
		// Let's check if we've filled out the entire form
		$reg_fields = array('username', 'password', 'password2', 'email', 'month', 'day', 'year');
		
			// Have they?
			foreach($reg_fields as $impfield) {

				// It's empty...
				if(empty($_POST['aulis_' . $impfield])) {
				
					// The error message
					$errormsg[] = constant('REGISTER_PLEASE_NO_BLANK_' . ($impfield == 'month' || $impfield == 'day' || $impfield == 'year' ? 'BIRTHDATE' : strtoupper($impfield)));
					
					// We don't want to continue
					$fail = true;
				}
				
				// Now create a variable that should be easier to type
				else {

					// But first, make sure we don't screw up the database
					$_POST['aulis_' . $impfield] = au_db_escape($_POST['aulis_' . $impfield]);
					
					// And now let's do what we came here to do
					$register[$impfield] = $_POST['aulis_' . $impfield];
				}
			}
			
		// Continue if we didn't mess up
		if(empty($fail)) {
		
			// The username shouldn't be too long
			if(strlen($register['username']) > 16)
				$errormsg[] = REGISTER_USERNAME_TOO_LONG;
				
			// Nor should it be too short
			elseif(strlen($register['username']) < 5)
				$errormsg[] = REGISTER_USERNAME_TOO_SHORT;
				
			// Does it contain HTML?
			if($register['username'] != htmlspecialchars($register['username'], ENT_NOQUOTES, 'UTF-8', false))
				$errormsg[] = REGISTER_USERNAME_NO_HTML;
				
			// Check the password length
			if(strlen($register['password']) > 16)
				$errormsg[] = REGISTER_PASSWORD_TOO_LONG;
				
			// It's too short
			elseif(strlen($register['password']) < 5)
				$errormsg[] = REGISTER_PASSWORD_TOO_SHORT;
				
			// Does it contain both letters and numbers? Thanks to Mohammad Naji (Stackoverflow)
			if(!preg_match('/[A-Z]+[a-z]+[0-9]+/', $register['password']))
				$errormsg[] = REGISTER_PASSWORD_WEAK;
				
			// Is the password the same as the username?
			if($register['username'] == $register['password'])
				$errormsg[] = REGISTER_PASSWORD_NO_USERNAME;
				
			// Do the passwords match?
			if(!$register['password'] == $register['password2'])
				$errormsg[] = REGISTER_PASSWORD_NO_MATCH;
				
			// Let's proceed with the email.
			if(!filter_var($register['email'], FILTER_VALIDATE_EMAIL))
				$errormsg[] = REGISTER_EMAIL_INVALID;
				
			// Okay, so now let's check the day of birth
			if(!is_numeric($register['day']))
				$errormsg[] = REGISTER_BIRTHDATE_DAY_NOT_NUMERIC;
				
			// The month should also be numeric
			if(!is_numeric($register['month']))
				$errormsg[] = REGISTER_BIRTHDATE_MONTH_NOT_NUMERIC;
				
			// And the year?
			if(!is_numeric($register['year']))
				$errormsg[] = REGISTER_BIRTHDATE_YEAR_NOT_NUMERIC;
				
			// Okay, so can the user actually be born on this date?
			$months = array(
				1 => 31,
				2 => 29,
				3 => 31,
				4 => 30,
				5 => 31,
				6 => 30,
				7 => 31,
				8 => 31,
				9 => 30,
				10 => 31,
				11 => 30,
				12 => 31
			);
			
				// Please tell me we didn't somehow mess up the month
				if($register['month'] > 12 || $register['month'] < 1)
					$errormsg[] = REGISTER_BIRTHDATE_WRONG;
			
				// Check if the day is okay
				elseif($register['day'] > $months[$register['month']])
					$errormsg[] = REGISTER_BIRTHDATE_WRONG;
					
				// It should at least be on the first day of the specified month
				if($register['day'] < 1)
					$errormsg[] = REGISTER_BIRTHDATE_WRONG;
					
			// Validate the age
			if((date("Y") - $register['year']) > 100)
				$errormsg[] = REGISTER_CONFIRM_AGE;
			elseif((date("Y") - $register['year']) < $setting['minimum_age'])
				$errormsg[] = REGISTER_TOO_YOUNG;
				
			// Registration questions!
			if(!$setting['security_questions'] == 0) {
			
				// Start with 0 questions
				$questions = 0;
				
				// Get all the questions from the database
				$result = au_query("
					SELECT *
						FROM questions
				", true);
				
					// Now check them
					foreach($result as $question) {
					
						// Was it in the form?
						if(!empty($_POST['aulis_squestion_' . $question['question_id']])) {
						
							// Convert the answer to lowercase
							$_POST['aulis_squestion_' . $question['question_id']] = strtolower($_POST['aulis_squestion_' . $question['question_id']]);
						
							// Wrong answer.
							if(!$_POST['aulis_squestion_' . $question['question_id']] == $question['question_answer1'] && !$_POST['aulis_squestion_' . $question['question_id']] == $question['question_answer2'])
								$errormsg[] = REGISTER_QUESTION_WRONG . $question['question_title'];
						
							// Increase the number of questions that have been answered, but only if it's the right language
							if($question['question_language'] == 'English' || $question['question_language'] == $setting['lang_current'])
								$questions + 1;
						}
						
						// Nope
						else
							$errormsg[] = REGISTER_QUESTION_FRAUD;
					}
					
				// So do we have all of them?
				if($questions < $setting['security_questions']) {
				
					// Apparently not. How many questions SHOULD it have shown?
					$number_questions = 0;
					
					// Let's find out
					foreach($result as $question)
						if($question['question_language'] == $setting['lang_current'])
							$number_questions + 1;
							
					// Is there a reason for us to fall back to English questions?
					if($number_questions < $setting['security_questions'] && $setting['lang_current'] != 'English') {
					
						// So how many ENGLISH questions are there
						$result = au_query("
							SELECT *
								FROM questions
								WHERE question_language = 'English'
						");
						
						// Let's count
						foreach($result as $anotherquestion)
							$number_questions + 1;
					}
					
					// Okay, so do we have enough now?
					if(!$questions == $number_questions)
						$errormsg[] = REGISTER_QUESTION_FRAUD;
				}
			}
				
			// Do we already have a user registered with the same name?
			$result = au_query("
				SELECT user_id, user_username
					FROM users
					WHERE user_username = '" . $register['username'] . "'
			", true);
			
				// Let's check.
				foreach($result as $foundusername)
					$errormsg[] = REGISTER_USERNAME_UNAVAILABLE;
					
			// What about the email?
			$result2 = au_query("
				SELECT user_id, user_email
					FROM users
					WHERE user_email = '" . $register['email'] . "'
			", true);
			
				// Let's check again
				foreach($result2 as $foundemail)
					$errormsg[] = REGISTER_EMAIL_IN_USE;
					
			// Generate a random activation code
			$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			
				// Start with an empty code
				$register['activation_code'] = '';
				
				// Now let's walk through the characters we want to use
				for($chars = 0; $chars < 15; $chars++)
					$register['activation_code'] .= $characters[rand(0, 61)];
				
			// Okay, somehow we still haven't messed up. Let's proceed with the registration process
			if(empty($errormsg)) {
			
				// Hash the password
				$register['password'] = au_hash($register['password']);
				
				// Create a joint birthdate string
				$register['birthdate'] = $register['month'] . '/' . $register['day'] . '/' . $register['year'];
				
				// Are we using email verification?
				if($setting['email_activation'] == 1)
					$register['activated'] = 0;
				else
					$register['activated'] = 1;
			
				// Exiting times. Let's add the account to the database.
				$result = au_query("
					INSERT INTO users (user_username, user_password, user_email, user_birthdate, user_ip, user_language, user_theme, user_activated, user_actcode)
					VALUES (
						'" . $register['username'] . "',
						'" . $register['password'] . "',
						'" . $register['email'] . "',
						'" . $register['birthdate'] . "',
						'" . $_SERVER['REMOTE_ADDR'] . "',
						'" . $setting['lang_current'] . "',
						'" . $setting['theme_current'] . "',
						'" . $register['activated'] . "',
						'" . $register['activation_code'] . "'
					)
				");
				
				// Did it work?
				if(!$result == true)
					$errormsg[] = REGISTRATION_FAILED;;
					
				// Send an activation email
				if($setting['email_activation'] == 1) {
				
					// Get the email app
					include $setting['dir_apps'] . '/Email.app.php';
					
					// Send it
					$result = au_activation_mail($register['activation_code'], $register['username'], $register['email']);
					
					// Did it actually work?
					if(!$result)
						$errormsg[] = REGISTER_FAIL_MAIL;
				}
			
				// We've just registered our account. Let's show a 'Thank you!'-message
				if(empty($errormsg))
					$registration_complete = true;
			}
		}
	}
	
	// This array is used in the template, and determines what should be shown, i.e. if there are any errors, what fields have already been filled in, etc.
	$reg_data = array(
		'errors' => (empty($_POST['aulis_register']) ? 0 : 1),
		'error_message' => $errormsg,
		'username' => (!empty($register['username']) ? $register['username'] : ''),
		'email' => (!empty($register['email']) ? $register['email'] : ''),
		'birthdate_year' => (!empty($register['year']) ? $register['year'] : ''),
		'birthdate_month' => (!empty($register['month']) ? $register['month'] : ''),
		'birthdate_day' => (!empty($register['day']) ? $register['day'] : ''),
		'questions' => array(),
	);
	
	// Do we have any registration questions set?
	if(!$setting['security_questions'] == 0) {
	
		// Okay, so what we're going to do now is pretty simple. We're just going to load the questions from the database, and the template deals with showing them.
		$result = au_query("
			SELECT *
				FROM questions
				WHERE question_language = '" . $setting['lang_current'] . "'
				ORDER BY RAND()
				LIMIT " . $setting['security_questions'] . "
		", true);

		$questions = 0;
		
		// Walk through each of them
		foreach($result as $question) {
		
			// Add it to the array
			$reg_data['questions'][] = $question;
		
			// Increase the number of questions
			$questions + 1;
		}
		
		// Do we have enough questions? It's possible this language doesn't have too many, but maybe English does
		if(!$questions == $setting['security_questions'] && !$setting['lang_current'] == 'English') {
		
			// How many are we missing?
			$missing = $questions['security_questions'] - $questions;
			
			// Now get those questions from the ENGLISH list
			$result = au_query("
				SELECT *
					FROM questions
					WHERE question_language = 'English'
					ORDER BY RAND()
					LIMIT " . $missing . "
			", true);
			
			// Add these to the template as well. This time we don't need to increase the number of questions.
			foreach($result as $question)
				$reg_data['questions'][] = $question;
		}
	}

	// Okay, load this app's template
	au_load_template('Register', false);
	
	// Show the registration template
	au_template_register($reg_data, (!empty($registration_complete) ? true : false));
}