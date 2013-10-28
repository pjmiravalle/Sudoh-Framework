<?php
/**
 * This is an example meta box.
 *
 * Every meta box that extends the SU_Metabox class will automically be
 * added to your site, and you can immediately see this example in action
 * by going to any one of your pages in your admin panel.
 *
 * The file name for your metabox can be anything you would like, but we
 * recommend using the metabox-{name}.php structure for organization purposes.
 *
 * For more information on meta boxes, @see http://wp.tutsplus.com/tag/wordpress-meta-box-tutorial/
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/*
 * Your class name can be anything you want, but be sure to extend the SU_Metabox class.
 */
class Example_Metabox extends SU_Metabox {

	/**
	 * Set up the configuration for your meta box here.
	 *
	 * 1. We set the ID. This will be used as a handle to reference your meta box if needed.
	 *
	 * 2. We set the args, which are then passed to add_meta_box.
	 *    @see add_meta_box http://codex.wordpress.org/Function_Reference/add_meta_box
	 *    Title     - The title of your metabox
	 *    Post Type - the post type this metabox will be assigned to
	 *    Context   - where the metabox will display on the post edit screen
	 *    Priority  - The priority within the context where the boxes should show
     *
	 * 3. We list the form field names which will be contained within the meta box.
	 *    These names will be used to save the post meta related to the meta box,
	 *    so be sure to use the same field names in your meta box output.
	 * 
	 * @return   void
	 */
	public function __construct() {

		$this->ID = 'example';

		$this->args = array(
			'title'     => 'Example Metabox',
			'post_type' => 'page',   // post, page, dashboard, or custom post type
			'context'   => 'normal', // normal, side, advanced
			'priority'  => 'default' // high, core, default, or low
		);

		$this->fields = array(
			'sample-field'
		);

		parent::__construct();

	}


	/**
	 * Add the content for your meta box here.
	 *
	 * When assigning form field names, be sure to use the same names that
	 * you set in the $fields array above, as this is what 
	 * 
	 * @param    object $post - the current post ID
	 * @return   string
	 */
	public function output( $post ) {

		$value = get_post_meta($post->ID, 'sample-field', true);

		printf('<textarea class="widefat" name="%s" rows="5">%s</textarea>', 'sample-field', $value );

	}

}


# END metabox-example.php
