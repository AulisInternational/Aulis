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
||		-> blog_entry.template.php
| 		-> // This file is the template of registration page
|| 		-> Last change: July, 2015
*/

// The main registration template
function au_template_register($data = array(), $iscomplete = false) {

	global $setting;
	
	// Show a thanks-page if we need to
	if($iscomplete == true) {
		
		au_out('
				<div class="reglogin">
					<div class="sectiontitle">
						' . au_icon('user_add', 16) . ' ' . REGISTER_DONE . '
					</div>
					<div class="sectioncontent">
						' . REGISTER_DONE_DESC . '
					</div>
				</div>');	
	
		return;
	}
	
	// Now let's just echo the header
	au_out('
			<div class="reglogin">
				' . (!empty($data['error_message']) ? '<div class="notice bg5 c5"><span class="float-right">' . au_icon('warning', 24, 'red') . '</span> ' . implode('<br />', $data['error_message']) . '</div>' : '') . '
				<div class="sectiontitle">
					' . au_icon('user_add', 16) . ' ' . REGISTER . '
				</div>
				<div class="sectioncontent">
					' . REGISTER_WELCOME . '
					<hr />
					<form action="' . au_url('?app=register') . '" method="post">
						<input type="hidden" name="aulis_register" value="1" />
						<table class="user" width="100%">
							<tr>
								<td><span>' . REGISTER_USERNAME . '</span><br />' . REGISTER_USERNAME_DESCRIPTION . '</td>
								<td><input type="text" name="aulis_username"' . (!empty($data['username']) ? ' value="' . $data['username'] . '"' : '') . ' /></td>
							</tr>
							<tr>
								<td><span>' . REGISTER_PASSWORD . '</span><br />' . REGISTER_PASSWORD_DESCRIPTION . '</td>
								<td><input type="password" name="aulis_password" /></td>
							</tr>
							<tr>
								<td><span>' . REGISTER_PASSWORD2 . '</span><br />' . REGISTER_PASSWORD2_DESCRIPTION . '</td>
								<td><input type="password" name="aulis_password2" /></td>
							</tr>
							<tr>
								<td><span>' . REGISTER_EMAIL . '</span><br />' . REGISTER_EMAIL_DESCRIPTION . '</td>
								<td><input type="text" name="aulis_email"' . (!empty($data['email']) ? ' value="' . $data['email'] . '"' : '') . ' /></td>
							</tr>
							<tr>
								<td><span>' . REGISTER_BIRTHDATE . '</span><br />' . REGISTER_BIRTHDATE_DESCRIPTION . '</td>
								<td>
									<select name="aulis_month" id="aulis_month">');
									
						// Display the months
						for($month = 1; $month <= 12; $month++) {
							au_out('
										<option value="' . $month . '"' . (!empty($data['birthdate_month']) && $month == $data['birthdate_month'] ? ' selected="selected"' : '') . '>' . constant('DATE_MONTH_' . $month) . '</option>');
						}

						au_out('
									</select>
									<select name="aulis_day" id="aulis_day">');
	
						// And the days
						for($day = 1; $day <= 31; $day++) {
							au_out('
										<option value="' . $day . '"' . (!empty($data['birthdate_day']) && $month == $data['birthdate_day'] ? ' selected="selected"' : '') . '>' . $day . '</option>');
						}
						
						au_out('
									</select>
									<select name="aulis_year" id="aulis_year">');
									
						// Now continue with the years
						foreach(range(date('Y'), (date('Y') - 100)) as $year)
							au_out('
										<option value="' . $year . '"' . (!empty($data['birthdate_year']) && $month == $data['birthdate_year'] ? ' selected="selected"' : '') . '>' . $year . '</option>');

						au_out('
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2" id="agreement">
									<strong>' . REGISTER_SIGN_AGREEMENT . '</strong><br />
									' . REGISTER_AGREEMENT . '
								</td>
							</tr>');
				
			// Do we have registration questions to display?
			if(!empty($data['questions']))
				foreach($data['questions'] as $question)
					au_out('
							<tr>
								<td><span>' . $question['question_title'] . '</span><br />' . $question['question_description'] . '</td>
								<td><input type="text" name="aulis_squestion_' . $question['question_id'] . '" /></td>
							</tr>');
				
		au_out('
							<tr>
								<td></td>
								<td><input type="submit" value="' . REGISTER_SUBMIT . '" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>');
}