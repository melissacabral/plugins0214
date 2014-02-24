<?php 
/*
Plugin Name: Company Info Options
Description:  Adds a section to the admin panel Settings
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

/**
 * Add admin panel page under "settings"
 */
add_action( 'admin_menu', 'rad_settings_page' );
function rad_settings_page(){
	//(title tag, menu label, capability, slug, callback for page content)
	add_options_page( 'Company Information Settings', 'Company Info', 'manage_options', 
		'rad-company-info', 'rad_options_form');
}
/**
 * Callback for page content
 */
function rad_options_form(){
	//security check - if the logged in user does NOT have the right credentials, kill the script. otherwise, include the content file.
	if( ! current_user_can('manage_options') ):
		wp_die('Access Denied');
	else:
		require( plugin_dir_path(__FILE__) . 'rad-options-form.php' );
	endif;
}

/**
 * Whitelist our group of options for DB storage
 */
add_action( 'admin_init', 'rad_register_settings' );
function rad_register_settings(){
	//group name, row name, sanitizing callback function
	register_setting( 'rad_options_group', 'rad_options', 'rad_options_sanitize' );
}

/**
 * Sanitizing Callback
 */
function rad_options_sanitize( $input ){
	//strip all tags and crud from fields
	$input['phone'] = wp_filter_nohtml_kses( $input['phone'] );
	$input['email'] = wp_filter_nohtml_kses( $input['email'] );

	//allow break tags in the address
	$allowed_tags = array(
		'br' => array(),
		'p' => array(),
	);
	$input['address'] = wp_kses( $input['address'], $allowed_tags );

	//all clean!  pass the data back to WP for DB storage
	return $input;
}