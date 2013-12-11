<?php
/**
 * Widget
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Registers theme sidebars.
 *
 * @since    0.1 
 * @return   void
 */
function su_register_sidebars() {

	$pieces = array(
		'before_widget' => '<section class="widget %2$s">',
		'before_title'  => '<div class="widget-heading"><h6>',
		'after_title'   => '</h6></div><div class="widget-content">',
		'after_widget'  => '</div></section>'
	);

	/*
	 * Developer Hook - Can be used to add or remove sidebars
	*/
	$sidebars = apply_filters( 'sudoh-sidebars', array(), $pieces );

	if ( ! empty($sidebars) ) {

		foreach ( $sidebars as $key => $sidebar ) {
			if ( ! isset($sidebar['id']) )
				$sidebar['id'] = $key;

			register_sidebar( apply_filters('sudoh-sidebar', array_merge($sidebar, $pieces) ) );
		}
	}

} add_action('widgets_init', 'su_register_sidebars', 5 );


/**
 * Registers all widgets.
 *
 * @since    0.1 
 * @return   void
 */
function su_register_widgets() {

	$widgets = apply_filters('sudoh-widgets', su_get_classes('SU_Widget') );

	if ( ! empty($widgets) ) {

		foreach ( $widgets as $widget )
			register_widget( $widget );
	}

} add_action('widgets_init', 'su_register_widgets', 5 );

/* ----------------------------------------------------------------------- *|
/* ------ Widget Class --------------------------------------------------- *|
/* ----------------------------------------------------------------------- */

class SU_Widget extends WP_Widget {

	var $ID;
	var $options  = array();
	var $defaults = array();

	public function __construct() {

		if ( is_null($this->ID) )
			wp_die('<p>Widget must have an ID set.</p>');

		$this->options  = wp_parse_args( $this->options, array(
			'name'         => '', // The name of the widget that appears on the widgets page in WP backend
			'description'  => '', // The description of the widget that appears on the widgets page in WP backend
			'classname'    => ''  // CSS Class
		));

		$this->defaults = wp_parse_args( $this->defaults, array(
			'widget_title' => ''  // The default title for the widget
		));

		parent::__construct( $this->ID, $this->options['name'], $this->options );

	}


	/**
	 * Functions as a wrapper for the widget form in the backend.
	 *
	 * @access   public
	 * @param    array $instance - the saved widget options.
	 * @return   string
	 */
	public function form( $instance ) {

		?>

		<?php // Widget Title ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input
				id="<?php echo $this->get_field_id('title'); ?>"
				name="<?php echo $this->get_field_name('title'); ?>"
				value="<?php echo ( isset($instance['title']) && !empty($instance['title']) ) ? esc_attr($instance['title']) : $this->defaults['widget_title']; ?>"
				class="widefat"
				type="text"
			/>
		</p>

		<?php

		$this->fields( $instance );

	}


	/**
	 * Will be extended upon by the child class to
	 * output the widget form fields in the backend.
	 *
	 * @access   public
	 * @param    array $instance - the saved widget options.
	 * @return   string
	 */
	public function fields( $instance ) {}


	/**
	 * Functions as a wrapper for the widget content.
	 *
	 * @access   public
	 * @param    array $args - the saved widget arguments.
	 * @param    array $instance - the saved widget options.
	 * @return   string
	 */
	public function widget( $args, $instance ) {

		extract($args);

		$title = ( ! empty($instance['title']) ) ? apply_filters('widget_title', $instance['title'], $this->ID) : $this->defaults['widget_title'];

		echo $before_widget;

			echo $before_title;
				echo $instance['title'];
			echo $after_title;

			$this->content( $args, $instance );
		
		echo $after_widget;

	}


	/**
	 * Will be extended upon by the child class to output the widget content.
	 *
	 * @access   public
	 * @param    array $args - the saved widget arguments.
	 * @param    array $instance - the saved widget options.
	 * @return   string
	 */
	public function content( $args, $instance ) {}

}


# END widget.php
