<?php
/**
 * This is an example Custom Post Type.
 *
 * Every post type that extends the SU_Post_Type class will automically be
 * added to your site, and you can immediately see this example by looking
 * at the main menu in your admin panel.
 *
 * The file name for your post type can be anything you would like, but we
 * recommend using the post-type-{name}.php structure for organization purposes.
 *
 * For more information on post types, @see http://codex.wordpress.org/Post_Types
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/*
 * Your class name can be anything you want, but be sure to extend the SU_Post_Type class.
 */
class Example_Post_Type extends SU_Post_Type {

	/**
	 * Set up the configuration for your post type here.
	 *
	 * 1. We set the ID. This will be used as a handle to reference your post type if needed.
	 * 
	 * 2. We set the single and plural names for the post type.
	 *
	 * 3. We pass over custom arguments for our post type that is passed over to register_post_type.
	 *    @see register_post_type http://codex.wordpress.org/Function_Reference/register_post_type
	 * 
	 * @return   void
	 */
	function __construct() {

		$this->ID = 'example';

		$this->singlename = 'Post Type';
		$this->pluralname = 'Post Types';

		$this->args = array(
			'taxonomies' => array('category')
		);

		parent::__construct();

	}


	/**
	 * Register your post type's meta boxes here. If your post type will
	 * not be using any custom meta boxes, simply remove this method.
	 *
	 * Arguments:
	 * 1. Title    - The title of your metabox
	 * 2. Context  - where the metabox will display on the post edit screen
	 * 3. Priority - The priority within the context where the boxes should show
	 * 4. Fields   - form field names which will be contained within the meta box.
	 *    These names will be used to save the post meta related to the meta box,
	 *    so be sure to use the same field names in your meta box output.
	 * 
	 * @return   void
	 */
	function register_metaboxes() {

		$this->metaboxes = array(
			'example-metabox' => array(
				'title' => 'Example Post Type Metabox',
				'context' => 'normal',
				'priority' => 'high',
				'fields' => array(
					'description',
					'date'
				)
			)
		);

		parent::register_metaboxes();

	}


	/**
	 * Add the output for each of your post type's meta boxes here. If your post
	 * type will not be using any custom meta boxes, simply remove this method.
	 *
	 * Add a case statement for each meta box, using the array key that you assigned.
	 * Within the statement, add your meta box content and use the $data variable
	 * to access values for your form fields.
	 * 
	 * @param    object $post - the current post ID
	 * @param    array $metabox - a list of the metaboxes registered for this post type
	 * @param    array $data - an array of key => value pairs for each meta box form field 
	 * @return   string
	 */
	function metaboxes_output( $post, $metabox, $data ) {

		switch ( $metabox ): case 'example-metabox': ?>
	
			<p>
	            <label for="description">Post Type Description:</label>
	            <input id="description" class="widefat" type="text" name="description" value="<?php echo esc_attr( $data['description'] ); ?>">
	        </p>

	        <p>
	            <label for="date">Post Type Date:</label>
	            <input id="date" class="widefat" type="date" name="date" value="<?php echo esc_attr( $data['date'] ); ?>">
	        </p>

		<?php break;

		endswitch;

	}


	/**
	 * Register a custom column layout for your post type here.
	 * These columns are displayed on the Post Type List screen.
	 * 
	 * @return   array
	 */
	function register_columns() {

		$this->columns = array(
	        'cb'             => '<input type="checkbox" />',
	        'title'          => __( 'Name', 'sudoh' ),
	        'example-column' => __( 'Example Column', 'sudoh' ),
	        'thumbnail'      => __( 'Thumbnail', 'sudoh' )
	    );

	    return $this->columns;

	}


	/**
	 * Add a custom column layout for your post type here.
	 *
	 * Add a case statement for each column, and insert
	 * the content for that column in the statement.
	 * 
	 * @param    array $column_name - a list of the columns
	 * @param    int $post_id - the current post's ID
	 * @return   string
	 */
	function columns_output( $column_name, $post_id ) {

		switch ( $column_name ) {

			case 'example-column':

				echo '<p>' . __('Display custom content here.', 'sudoh') . '</p>';
				break;

			case 'thumbnail':

				if ( has_post_thumbnail($post_id) )
					echo get_the_post_thumbnail($post_id, 'thumbnail');
				break;

		}

	}

}


# END post-type-example.php
