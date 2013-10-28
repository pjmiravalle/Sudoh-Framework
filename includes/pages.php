<?php 
/**
 * Pages
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Sets up the default theme pages during theme activation.
 *
 * @since    0.1 
 * @return   null
 */
function su_create_default_pages() {
      
    $pages = apply_filters('sudoh-default-pages', array());

    if ( ! empty($pages) ) {

        foreach ( $pages as $key => $page ) {

            if ( ! su_post_exists($page['post_title']) )
                wp_insert_post($page); 
        }

    }

} add_action('after_switch_theme', 'su_create_default_pages');


/**
 * Checks to see if a post / page exists by title.
 *
 * @since    0.1
 * @param    string $title - the post's title
 * @return   boolean
 */
function su_post_exists( $title ) {

    global $wpdb;
    return $wpdb->get_row("SELECT * FROM {$wpdb->prefix}posts WHERE post_title = '$title' AND post_status = 'publish'", 'OBJECT');

}


/**
 * Attempts to retrieve a Post's ID by title.
 *
 * @since    0.1
 * @param    string $title - the post's title
 * @return   int / void
 */
function su_get_post_id_by_title( $title ) {

	$post = su_post_exists($title);

	return ( $post ) ? (int) $post->ID : null;

}


# END pages.php
