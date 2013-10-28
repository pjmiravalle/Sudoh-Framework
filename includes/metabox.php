<?php
/**
 * Metabox
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Registers all metaboxes.
 *
 * @since    0.1 
 * @return   void
 */
function su_register_metaboxes() {

    $metaboxes = apply_filters('sudoh-metaboxes', su_get_classes('SU_Metabox') );

    foreach ( $metaboxes as $metabox )
        new $metabox;

}

add_action('admin_menu', 'su_register_metaboxes', 5 );

/* ----------------------------------------------------------------------- *|
/* ------ Metabox Class -------------------------------------------------- *|
/* ----------------------------------------------------------------------- */

class SU_Metabox {

    var $ID;
    var $args   = array();
    var $fields = array();
    
    public function __construct() {

        if ( is_null($this->ID) )
            wp_die('<p>Metabox must have an ID set.</p>');

        add_action( 'add_meta_boxes',  array($this, 'add')         );
        add_action( 'pre_post_update', array($this, 'save'), 10, 2 );

    }


    /**
     * Adds the metabox to the post type provided.
     *
     * @access   public
     * @return   string
     */
    public function add() {

        add_meta_box( $this->ID, $this->args['title'], array($this, 'callback'), $this->args['post_type'], $this->args['context'], $this->args['priority'] );

    }


    /**
     * Saves the metabox options.
     *
     * @access   public
     * @param    int $post_id - the current post's ID.
     * @return   bool / void
     */
    public function save( $post_id ) {

        $post      = get_post( $post_id );
        $post_type = get_post_type_object( $post->post_type );

        if ( ! current_user_can($post_type->cap->edit_post, $post_id) )
            return false;

        if ( ! isset($_POST[ $this->ID . '-nonce' ]) || ! wp_verify_nonce($_POST[ $this->ID . '-nonce' ], basename(__FILE__)) )
            return false;

        foreach ( $this->fields as $field ) {

            $new = ( isset($_POST[ $field ]) ) ? $_POST[ $field ] : '';
            $old = get_post_meta( $post_id, $field, true );

            // Add
            if ( $new && ! $old )
                add_post_meta( $post_id, $field, $new, true );

            // Update
            elseif ( $new && $new != $old )
                update_post_meta( $post_id, $field, $new );

            // Delete
            elseif ( $old && $new == '' )
                delete_post_meta( $post_id, $field, $old );

        }

    }


    /**
     * Adds in a security nonce before outputting
     * the content for the metabox.
     *
     * @access   public
     * @param    object $post - the current post object.
     * @return   string
     */
    public function callback( $post ) {

        wp_nonce_field( basename(__FILE__), $this->ID . '-nonce' );

        $this->output( $post );
        
    }


    /**
     * Will be extended upon by the child class to output the metabox content.
     *
     * @access   public
     * @param    object $post - the current post object. 
     * @return   string
     */
    public function output( $post ) {}

}


# END metabox.php
