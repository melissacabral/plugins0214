<?php 
/*
Plugin Name: Corner Ribbon
Description: Adds a 'sale' ribbon to the top corner of the page
Author: Melissa Cabral
Plugin URI: http://path-to-plugin-support.com
Author URI: http://wordpress.melissacabral.com
Version: 0.1
License: GPLv3
*/

/**
 * HTML output for the ribbon
 */
add_action( 'wp_footer', 'rad_ribbon_html' );
function rad_ribbon_html(){
	//only show it on the home page
	if( is_front_page() ):
	?>
	<!-- Corner Ribbon Plugin by Melissa Cabral -->
	<a href="#" id="rad-corner-ribbon">
		<img src="<?php echo plugins_url('images/corner-ribbon.png', __FILE__ ); ?>" alt="View the sale items in the shop">
	</a>
	<?php
	endif;
}

/**
 * Attach CSS file
 */
add_action( 'wp_enqueue_scripts', 'rad_corner_style' );
function rad_corner_style(){
	if( is_front_page() ):
	//get the filepath of the css file
		$css_file = plugins_url( 'css/rad-corner-style.css', __FILE__ );
		//tell WP that the stylesheet exists
		wp_register_style( 'rad-corner-style', $css_file );
		//put it on the page
		wp_enqueue_style( 'rad-corner-style' );
	endif;
}

//no close PHP