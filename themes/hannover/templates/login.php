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
| 		-> // This file is the template of login page
|| 		-> Last change: August, 2015
*/

// The login template
function au_template_login($complete = false) {

	global $setting;

	// Just show the login page
	au_out('
			<div class="reglogin_minimal">
				' . (!empty($data['error_message']) ? '<div class="error">' . implode('<br />', $data['error_message']) . '</div>' : '') . '
				<div class="sectiontitle2">
					<img src="' . $setting['theme_url'] . '/images/icons/user_green.png" /> ' . $language['login'] . '
				</div>
				<form action="' . $basefile . 'do=login" method="post">
					<input type="hidden" name="draseim_login" />
					<table class="user" width="100%">
						<tr>
							<td>' . LOGIN_USERNAME . '</td>
							<td><input type="text" name="draseim_username"' . (!empty($data['username']) ? ' value="' . $data['username'] . '"' : '') . ' /></td>
						</tr>
						<tr>
							<td>' . LOGIN_PASSWORD . '</td>
							<td><input type="password" name="draseim_password" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type="checkbox" name="draseim_forever" /> ' . LOGIN_FOREVER . '</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="' . LOGIN_SUBMIT . '" /></td>
						</tr>
					</table>
				</form>
				<p class="loginlinks">
					<a href="' . $basefile . 'do=register&activate">' . LOGIN_ACTIVATE_ACCOUNT . '</a><br />
					<a href="' . $basefile . 'do=resetpassword">' . LOGIN_RESET_PASSWORD . '</a>
				</p>
			</div>');
}