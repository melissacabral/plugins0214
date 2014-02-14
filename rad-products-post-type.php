<?php 
/*
Plugin Name: Products Post type
Description: Adds products CPT for our shop pages
Author: Melissa Cabral
Author URI: http://melissacabral.com
Plugin URI: http://path-to-docs.com
Version: 0.1
License: GPLv3
*/

/**
 * Add the post type
 */
add_action( 'init', 'rad_register_cpt' );
function rad_register_cpt(){
	register_post_type( 'product', array(
		'public' => true,
		'labels' => array(
			'name' => 'Products',
			'singular_name' => 'Product',
			'not_found' => 'No Products Found.',
			'add_new_item' => 'Add New Product',
		),
		'supports' => array(
			'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions',
		),
		'has_archive' => true,
	) );
}

/**
 * Change "enter title here" on our products only
 */
add_filter('gettext','custom_enter_title');

function custom_enter_title( $input ) {
    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'product' == $post_type )
        return 'Product Title';

    return $input;
}


/**
 * Fix 404 errors (flush rewrite rules) when this plugin is activated
 */
function rad_rewrite_flush(){
	rad_register_cpt(); //the function where your CPT is registered
	flush_rewrite_rules(); //rebuilds .htaccess with the new CPT
}
register_activation_hook( __FILE__, 'rad_rewrite_flush' );


//no close php