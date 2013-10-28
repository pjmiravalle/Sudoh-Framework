<?php
/**
 * Post Type
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1 
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Registers all custom post types.
 *
 * @since    0.1
 * @return   void
 */
function su_register_post_types() {

	$post_types = apply_filters('sudoh-post-types', su_get_classes('SU_Post_Type') );

	foreach ( $post_types as $post_type )
		new $post_type;

} add_action('init', 'su_register_post_types');

/* ----------------------------------------------------------------------- *|
/* ------ Post Type Class ------------------------------------------------ *|
/* ----------------------------------------------------------------------- */

class SU_Post_Type {

	var $ID;
	var $singlename;
	var $pluralname;
	var $hastaxonomy = true;
	var $args      = array();
	var $metaboxes = array();
	var $columns   = array();

	public function __construct() {

		if ( is_null($this->ID) )
            wp_die('<p>Post Type must have an ID set.</p>');

		$this->register_post_type();
		$this->register_metaboxes();
		$this->register_columns();
		
		add_filter( "manage_edit-{$this->ID}_columns", array($this, 'create_columns') );
		add_action( 'manage_posts_custom_column', array($this, 'edit_columns'), 10, 2 );
		add_action( 'do_meta_boxes', array($this, 'customize_default_metaboxes')      );

	}


	/**
	 * Registers the Custom Post Type.
	 *
	 * @access   public
	 * @return   void
	 */
	public function register_post_type() {

		// Set up some defaults
		$defaults = array(
			'labels' => array(
				'menu_name'          => $this->pluralname,
				'name'               => $this->pluralname,
				'single_name'        => $this->singlename,
				'add_new'            => 'Add New',
				'all_items'          => sprintf('All %s', $this->pluralname ),
				'add_new_item'       => sprintf('Add New %s', $this->singlename ),
				'edit_item'          => sprintf('Edit %s', $this->singlename ),
				'new_item'           => sprintf('Add New %s', $this->singlename ),
				'view_item'          => sprintf('View %s', $this->singlename ),
				'search_items'       => sprintf('Search %s', $this->pluralname ),
				'not_found'          => sprintf('No %s Found', $this->pluralname ),
				'not_found_in_trash' => sprintf('No %s Found in Trash', $this->pluralname )
			),
			'query_var' => strtolower($this->singlename),
			'rewrite'   => array(
				'slug' => strtolower($this->pluralname)
			),
			'public' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail'
			)
		);

		// Compare Args
		$this->args = wp_parse_args( $this->args, $defaults );

		// Allow Args to be modified
		$this->args = apply_filters( "{$this->ID}-args", $this->args );

		register_post_type( $this->ID, $this->args );

	}


	/**
	 * Registers the CPT meta boxes.
	 *
	 * @access   public
	 * @return   void
	 */
	public function register_metaboxes() {

		if ( empty($this->metaboxes) )
			return;

		add_action('add_meta_boxes', array(&$this, 'add_metaboxes') );
		add_action('save_post', array(&$this, 'save_metaboxes') );

	}


	/**
	 * Adds the CPT Meta boxes.
	 *
	 * @access   public
	 * @return   void
	 */
	public function add_metaboxes() {

		foreach ( $this->metaboxes as $key => $metabox ) {

			$mb = $metabox;

			$mb['id']       = $key;
			$mb['page']     = $this->ID;
			$mb['callback'] = array($this, 'prepare_metaboxes');

			add_meta_box( $mb['id'], $mb['title'], $mb['callback'], $mb['page'], $mb['context'], $mb['priority'], $mb['fields'] );

		}

	}


	/**
	 * Saves the CPT Metaboxes.
	 * 
	 * @access   public
	 * @param    int $id - the metabox's ID
	 * @return   void
	 */
	public function save_metaboxes( $id ) {

		global $post;

		if ( ! isset($post->post_type) || $post->post_type != $this->ID )
			return;

		foreach ( $this->metaboxes as $metabox ) {

			foreach ( $metabox['fields'] as $field ) {

				if ( isset($_POST[ $field ]) ) {

					update_post_meta(
						$post->ID,
						$field,
						$_POST[ $field ]
					);

				}

			}

		}

	}


	/**
	 * Prepares the CPT meta boxes by retrieving values for each field.
	 *
	 * @access   public
	 * @param    object $post - the current post object
	 * @param    array $args  - the metabox arguments
	 * @return   void
	 */
	public function prepare_metaboxes( $post, $args ) {

		$data = array();

		foreach ( $args['args'] as $value )
			$data[ $value ] = get_post_meta( $post->ID, $value, true );

		$metabox = $args['id'];

		$this->metaboxes_output( $post, $metabox, $data );

	}


	/**
	 * Will be extended upon by the child class to output the post type's metabox content.
	 *
	 * @access   public
	 * @param    object $post - the current post object
	 * @param    int $metabox - the current metabox ID
	 * @param    array $data - the metabox data
	 * @return   string - the content
	 */
	public function metaboxes_output( $post, $metabox, $data ) {}


	/**
	 * Customizes the titles for default post metaboxes.
	 *
	 * @access   public 
	 * @return   void
	 */
	public function customize_default_metaboxes() {

		global $post;

		if ( ! isset($post->post_type) || $post->post_type != $this->ID )
			return false;

	    remove_meta_box( 'postimagediv', $this->ID, 'side' );
	    remove_meta_box( 'postexcerpt', $this->ID, 'normal' );

	    add_meta_box( 'postimagediv', __( "Thumbnail" ), 'post_thumbnail_meta_box', $this->ID, 'side', 'low' );
	    add_meta_box( 'postexcerpt', __( "Summary" ), 'post_excerpt_meta_box', $this->ID, 'normal', 'high' );

	}


	/**
	 * Will be extended upon by the child class to
	 * register custom columns for the post type.
	 *
	 * @access   public
	 * @return   array
	 */
	public function register_columns() {}


	/**
	 * Defines the custom columns and their order.
	 *
	 * @access   public
	 * @param    array $columns - the custom post type columns
	 * @return   array
	 */
	public function create_columns( $columns ) {

		if ( empty($this->columns) )
			return $columns;

	    return $this->columns;

	}


	/**
	 * Renders the custom columns content.
	 *
	 * @access   public
	 * @param    string $column_name - the column name
	 * @param    int $post_id - the current post ID
	 * @return   string
	 */
	public function edit_columns( $column_name, $post_id ) {

	    if ( get_post_type( $post_id ) == $this->ID )
        	$this->columns_output( $column_name, $post_id );

	}


	/**
	 * Will be extended upon by the child class to output
	 * the custom columns content for the post type.
	 *
	 * @access   public
	 * @param    string $column_name - the column name
	 * @param    int $post_id - the current post ID
	 * @return   string
	 */
	public function columns_output( $column_name, $post_id ) {}

}


# END post-type.php
