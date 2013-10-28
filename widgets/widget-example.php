<?php
/**
 * This is an example widget.
 *
 * Every widget that extends the SU_Widget class will automically be
 * added to your site, and you can immediately see this example in action
 * by going to the widgets section of your admin panel ( appearance -> widgets ).
 *
 * The file name for your widget can be anything you would like, but we
 * recommend using the widget-{name}.php structure for organization purposes.
 *
 * For more information on widgets, @see http://codex.wordpress.org/Widgets_API
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/*
 * Your class name can be anything you want, but be sure to extend the SU_Widget class.
 */
class Example_Widget extends SU_Widget {

	/**
	 * Set up the configuration for your widget here.
	 *
	 * 1. We set the ID. This will be used as a handle to reference your widget if needed.
	 * 
	 * 2. We set the parameters for our widget.
	 *
	 * 3. We set up default values for our widget's fields. In the case
	 *    that a user doesn't set a value for a form field, its value
	 *    would be set to one of these defaults.
	 * 
	 * @return   void
	 */
	function __construct() {

		// Widget Handle
		$this->ID = 'example-widget';

		// Widget Config
		$this->options = array(
			'name'        => 'Example Widget',       // Widget name
			'description' => 'Widget description.',  // Widget description
			'class'       => 'projects-cycle-widget' // CSS class
		);

		// Default values for widget fields
		$this->defaults = array(
			'widget_title' => 'My Example Widget',
			'sample_field' => 'Some value'
		);

		parent::__construct();

	}


	/**
	 * Create your widget's form fields here.
	 * 
	 * @return   string
	 */
	function fields( $instance ) {

		extract($instance);

		// Sample Field ?>

		<p>
			<label for="<?php echo $this->get_field_id('sample_field'); ?>" style="display: block;">Sample Field</label>
			<input
				id="<?php echo $this->get_field_id('sample_field'); ?>"
				name="<?php echo $this->get_field_name('sample_field'); ?>"
				value="<?php echo ( isset($sample_field) && ! empty($sample_field) ) ? $sample_field : $this->defaults['sample_field']; ?>"
				class="widefat"
				type="text"
			/>
		</p>

		<?php

	}


	/**
	 * Add your widget's content here.
	 *
	 * This will be displayed to users on the front end of your site.
	 * 
	 * @return   string
	 */
	function content( $args, $instance ) {

		extract($instance); ?>
	
			<p><?php echo $sample_field; ?></p>

		<?php

	}

}


# END widget-example.php
