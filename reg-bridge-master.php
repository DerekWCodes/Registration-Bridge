<?php
/*
Plugin Name: Registration Bridge Master
Plugin URI: https://profoundsyntax.com
Description:  Registration Bridge Master.
Version: 1.0
Author: Derek Williams
Author URI: https://derekwcodes.monster, https://profoundsyntax.com

 Registration Bridge Master.
 
	MIT License

	Copyright (c) 2023 Derek Williams

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all
	copies or substantial portions of the Software.
	
	Please make sure you add credit to my developments if you are using them to build or expand from this file there forward. Yes, if you are to make money with my starting code I would like to be a moment in your statements on where you got it, respect.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	SOFTWARE.
 
*/
/*Begin Admin Page*/
add_action('admin_menu', 'reg_bridge_master_add_menu');
function reg_bridge_master_add_menu() {
	$page = add_options_page('Reg Bridge Master', 'Reg Bridge Master', 'manage_options', 'reg-bridge-master', 'reg_bridge_master_settings_page');
}

add_action('admin_init', 'reg_bridge_master_admin_init');
function reg_bridge_master_admin_init() {	
	register_setting('reg_bridge_master_sites', 'reg_bridge_master_sites', 'reg_bridge_master_validate');
    add_settings_section('reg_bridge_master_main', '', 'reg_bridge_master_section_text', 'reg-bridge-master');
}

function reg_bridge_master_settings_page() { ?>
    <div class="wrap">
		<h2>Registration Bridge Master</h2>
		<form method="post" action="options.php" name="wp_auto_commenter_form">
			<?php settings_fields('reg_bridge_master_sites'); ?>
			<?php do_settings_sections('reg-bridge-master'); ?>
			<p class="submit">
				<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
			</p>
		</form>
    </div>
<?php
}

function reg_bridge_master_section_text() {
	$options = get_option('reg_bridge_master_sites');
	echo '<style type="text/css">';
		echo '#reg_bridge_master_sites_wrapper li { border: 1px solid #999999; background: #dddddd; padding: 5px; border-radius: 5px; position: relative; }';
		echo '#reg_bridge_master_sites_wrapper li .delete-button { border: medium none; cursor: pointer; height: 16px; width: 16px; float: right; background: url(data:image/bmp;base64,Qk02AwAAAAAAADYAAAAoAAAAEAAAABAAAAABABgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA3d3d3d3dJSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX63d3d3d3d3d3dJSX63d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3dJSX63d3dJSX63d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3dJSX6JSX63d3d3d3dJSX6JSX63d3d3d3d3d3d3d3d3d3d3d3dJSX6JSX63d3d3d3dJSX6JSX63d3d3d3dJSX6JSX6JSX63d3d3d3d3d3d3d3dJSX6JSX6JSX63d3d3d3dJSX6JSX63d3d3d3d3d3dJSX6JSX6JSX63d3d3d3dJSX6JSX6JSX63d3d3d3d3d3dJSX6JSX63d3d3d3d3d3d3d3dJSX6JSX6JSX6JSX6JSX6JSX63d3d3d3d3d3d3d3dJSX6JSX63d3d3d3d3d3d3d3d3d3dJSX6JSX6JSX6JSX63d3d3d3d3d3d3d3d3d3dJSX6JSX63d3d3d3d3d3d3d3d3d3dJSX6JSX6JSX6JSX63d3d3d3d3d3d3d3d3d3dJSX6JSX63d3d3d3d3d3d3d3dJSX6JSX6JSX6JSX6JSX6JSX63d3d3d3d3d3d3d3dJSX6JSX63d3d3d3d3d3dJSX6JSX6JSX63d3d3d3dJSX6JSX6JSX63d3d3d3d3d3dJSX6JSX63d3d3d3dJSX6JSX6JSX63d3d3d3d3d3d3d3dJSX6JSX6JSX63d3d3d3dJSX6JSX63d3d3d3dJSX6JSX63d3d3d3d3d3d3d3d3d3d3d3dJSX6JSX63d3d3d3dJSX6JSX63d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3dJSX63d3dJSX63d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3dJSX63d3d3d3d3d3dJSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX6JSX63d3d3d3d); }';
	echo '</style>';
	echo '<ul id="reg_bridge_master_sites_wrapper">';
	if($options) {		
		foreach($options as $option) {
			echo '<li>';
				$data = explode('######', reg_bridge_master_crypt(urldecode($option)));
				if(is_array($data) && isset($data[0]) && isset($data[1]) && (md5($data[1]) == $data[0])) {
					echo '<label>Site : <a href="'.$data[1].'">'.$data[1].'</a></label>';
					echo '<input type="hidden" id="reg_bridge_master_sites" name="reg_bridge_master_sites[]" class="input widefat" value="'.$option.'" >';
				} else {
					echo '<label>Invalid Authorization Key, Please Click Save to Remove this Key</label>';
				}
				echo '<input type="button" class="delete-button" value="" onclick="javascript: this.parentElement.parentElement.removeChild(this.parentElement);" />';
			echo '</li>';
		}		
	}
	echo '<li>';
		echo '<label>Add New Authorization Key</label>:<hr />';
		echo '<input type="text" id="reg_bridge_master_sites" name="reg_bridge_master_sites[]" class="input widefat" value="" />';
	echo '</li>';
	echo '</ul>';
}

function reg_bridge_master_validate($input) {
	$newinput = array();
	foreach($input as $item) {
		if($item != '') {
			$newinput[] = $item;
		}
	}
	return $newinput;
}

function reg_bridge_master_crypt($str, $ky = 'AC11V1LpHCYSE7IfkxHhqB2bppiy4yA5'){
	$ky = str_replace(chr(32), '', $ky);
	$k = array();
	for($i = 0; $i < 32; $i++) {
		$k[$i] = ord($ky{$i})&0x1F;
	}
	$j = 0;
	for($i = 0; $i < strlen($str); $i++) {
		$e = ord($str{$i});
		$str{$i} = $e&0xE0?chr($e^$k[$j]):chr($e);
		$j++;
		$j = ($j==32)?0:$j;
	}
	return $str;
} 
/*End Admin Page*/

/*Begin Insert and Update Hooks*/
add_action('user_register', 'reg_bridge_master_profile_update');
add_action('profile_update', 'reg_bridge_master_profile_update');
function reg_bridge_master_profile_update($user_id) {
	$userData = get_userdata($user_id);
	$userInfo = array(
		'user_login' => $userData->user_login,
		'user_nicename' => $userData->user_nicename,
		'user_email' => $userData->user_email,
		'user_url' => $userData->user_url,
		'display_name' => $userData->display_name,
		'role' => $userData->roles[0]
	);
	$userMeta = get_user_meta($userData->ID);
	unset($userMeta['wp_capabilities']);
	unset($userMeta['wp_user_level']);
	if(isset($_POST['pass1']) && isset($_POST['pass2']) && ($_POST['pass1'] == $_POST['pass2']) && $_POST['pass1'] != "") {
		$userInfo['user_pass'] = $_POST['pass1'];
	} elseif(isset($_POST['mngl_user_password']) && isset($_POST['mngl_user_password_confirm']) && ($_POST['mngl_user_password'] == $_POST['mngl_user_password_confirm']) && $_POST['mngl_user_password'] != "") {
		$userInfo['user_pass'] = $_POST['mngl_user_password'];
	}
	$authorizationKeys = get_option('reg_bridge_master_sites');
	foreach($authorizationKeys as $authorizationKey) {
		$key = explode('######', reg_bridge_master_crypt(urldecode($authorizationKey)));
		$postArgs = array(
			'method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => array(),
			'body' => array('handshake' => $key[0], 'userData' => urlencode(serialize($userInfo)), 'userMeta' => urlencode(serialize($userMeta))),
			'cookies' => array()
		);
		$response = wp_remote_post($key[1].'/wp-content/plugins/reg-bridge-slave/handler.php', $postArgs);
		if(!is_wp_error($response)) {
			$body = wp_remote_retrieve_body($response);
		}
	}
}
/*End Insert and Update Hooks*/

/*Begin Delete Hook*/
add_action('delete_user', 'reg_bridge_master_profile_delete');
add_action('wpmu_delete_user', 'reg_bridge_master_profile_delete');
function reg_bridge_master_profile_delete($user_id) {
	$userData = get_userdata($user_id);
	$userInfo = array(
		'user_login' => $userData->user_login
	);
	$authorizationKeys = get_option('reg_bridge_master_sites');
	foreach($authorizationKeys as $authorizationKey) {
		$key = explode('######', reg_bridge_master_crypt(urldecode($authorizationKey)));
		$postArgs = array(
			'method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => array(),
			'body' => array('handshake' => $key[0], 'userData' => urlencode(serialize($userInfo)), 'userMeta' => 'TRUE', 'delete' => 'TRUE'),
			'cookies' => array()
		);
		$response = wp_remote_post($key[1].'/wp-content/plugins/reg-bridge-slave/handler.php', $postArgs);
		if(!is_wp_error($response)) {
			$body = wp_remote_retrieve_body($response);
		}
	}
}
/*End Delete Hook*/
?>