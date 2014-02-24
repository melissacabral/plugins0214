<?php 
/*
Plugin Name: Admin Panel Customizations
Description: Just some simple changes to the admin and login screens
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

/**
 * Embedded CSS for simple login screen
 */
add_action( 'login_head', 'rad_embed_style' );
function rad_embed_style(){ ?>
	<style type="text/css">
		body.login{
			background-color:#696763;
		}
		.login h1 a{
			background-image: url( <?php echo plugins_url('images/logo.png', __FILE__); ?>);
			background-size:auto auto;
			width:auto;
		}
	</style>
<?php
 }
/**
 * Fix the old wordpress logo link so it goes to our home page
 */
add_filter( 'login_headerurl', 'rad_login_link' );
function rad_login_link(){
	return home_url('/');
}
add_filter( 'login_headertitle', 'rad_login_title' );
function rad_login_title(){
	return 'Visit Awesome Co Home Page';
}
/**
 * Replace the WP logo on the admin bar
 * icons can be found at
 * http://melchoyce.github.io/dashicons/
 */

add_action( 'wp_head', 'rad_ab_icon' );
add_action( 'admin_head', 'rad_ab_icon' );

function rad_ab_icon(){
	?>
	<style type="text/css">
		#wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before{
			content: "\f155"; /*Star*/
		}
	</style>
	<?php
}

/**
 * Remove unwanted dashboard widgets and add some of my own
 */
add_action( 'wp_dashboard_setup', 'rad_remove_dash_widgets' );
function rad_remove_dash_widgets(){
	//remove the developer blog widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );

	//add our own widget (id, title, callback widget)
	wp_add_dashboard_widget( 'dashboard_rad_feed', 'Melissa\'s Wordpress Site', 
		'rad_rss_widget'  );
}

//custom callback for the Feed widget content
function rad_rss_widget(){
	echo '<div class="rss-widget">';
	wp_widget_rss_output( array(
		'url' => 'http://wordpress.melissacabral.com/feed',
		'show_summary' => 1,
		'items' => 5,
		'show_date' => 1,
		'show_author' => 0,
	) );
	echo '</div>';
}
