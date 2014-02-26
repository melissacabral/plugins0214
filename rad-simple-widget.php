<?php 
/*
Plugin Name: Simple Widget
Description: A starter file for building widgets
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

/**
 * Register the widget so WP knows it exists
 */
add_action( 'widgets_init', 'rad_register_simple_widget' );
function rad_register_simple_widget(){
	register_widget( 'Rad_Simple_Widget' );
}

/**
 * Widget Class definition
 */
class Rad_Simple_Widget extends WP_Widget{
	//widget options. Required.
	function Rad_Simple_Widget(){
		$widget_settings = array(
			'classname' => 'simple-widget',
			'description' => 'A basic widget with just a title.',
		);
		$control_settings = array(
			'id-base' => 'simple-widget',
			//'width' => 600, //width of admin panel form
		);
		//apply the settings to our widget
		//WP_Widget(id-base, Title, widget settings, control settings)
		$this->WP_Widget('simple-widget', 'Rad Simple Widget', $widget_settings, 
			$control_settings);
	}

	//Widget Display. Required.
	//$args = Array. settings from register_sidebar
	//$instance = Array. settings for one instance of the widget
	function widget( $args, $instance ){
		extract($args);
		//get field values so we can use them
		$title = $instance['title'];
		$content = $instance['content'];
		//more fields here

		//make the title work with filter hook
		$title = apply_filters( 'widget_title', $title );

		//begin output
		echo $before_widget;
		echo $before_title . $title . $after_title;
		?>
		<p><?php echo $content; ?></p>
		<?php
		echo $after_widget;
	}

	//Save & Sanitize the settings. Required.
	//$new_instance = Array. Dirty data that needs to be sanitized
	//$old_instance = Array. Existing values for one instance of the widget
	function update( $new_instance, $old_instance ){
		$instance = array();

		//go through each field and sanitize
		$instance['title'] = wp_filter_nohtml_kses( $new_instance['title'] );
		$instance['content'] = wp_filter_nohtml_kses( $new_instance['content'] );

		//more fields go here

		//return the clean data to WP for storage in DB
		return $instance;
	}

	//Admin panel form fields. Optional.
	//$instance = Array. Existing values for one instance of the widget
	function form( $instance ){
		$defaults = array(
			'title' => 'Simplest Widget Default Title!',
			'content' => '',
			//put more field defaults here
		);
		//apply the defaults
		$instance = wp_parse_args( (array) $instance, $defaults );

		//HTML for the form
		?>
		<p>
			<label>Title:</label>
			<input type="text" class="widefat"
				name="<?php echo $this->get_field_name('title'); ?>" 
				id="<?php echo $this->get_field_id('title'); ?>" 
				value="<?php echo $instance['title'] ?>">
		</p>
		<p>
			<label>Content:</label>
			<input type="text" class="widefat"
				name="<?php echo $this->get_field_name('content'); ?>" 
				id="<?php echo $this->get_field_id('content'); ?>" 
				value="<?php echo $instance['content'] ?>">
		</p>
		<?php
	}

}