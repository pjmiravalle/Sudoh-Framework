<?php 
/**
 * Cleanup Functions
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Removes default WP meta from header.
 *
 * @since    0.1
 * @return   void
 */
function su_wp_head_cleanup() {

	remove_action( 'wp_head', 'feed_links_extra', 3 );                     // Displays the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links', 2 );                           // Displays the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'rsd_link' );                                // Displays the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );                        // Displays the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );  // Displays relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'wp_generator' );                            // Displays the XHTML generator that is generated on the wp_head hook, WP version
	remove_action( 'wp_head', 'index_rel_link' );                          // Displays Index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );             // Displays Prev link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );              // Displays Start link

} add_action('init', 'su_wp_head_cleanup');


/**
 * Removes unnecessary menu items from the admin menu.
 * Can remove additional menu items by
 * using the filter hook provided.
 *
 * @since    0.1
 * @return   void
 */
function su_admin_menu_cleanup() {

    $menu_items = apply_filters('sudoh-dequeue-menu-items', array());

    if ( ! empty($menu_items) ) {

        foreach ( $menu_items as $item ) {

            if ( is_array($item) )
                remove_submenu_page( $item['parent'], $item['id'] );
            else
                remove_menu_page( $item );
        }

    }

} add_action( 'admin_menu', 'su_admin_menu_cleanup', 30 );


/**
 * Removes unnecessary metaboxes from posts / pages.
 * Can remove additional metaboxes by
 * using the filter hook provided.
 *
 * @since    0.1
 * @return   void
 */
function su_admin_metaboxes_cleanup() {

    $metaboxes = apply_filters('sudoh-dequeue-metaboxes', array());

    if ( ! empty($metaboxes) ) {

        foreach ( $metaboxes as $metabox )
            remove_meta_box( $metabox, 'page', 'normal' );

    }

} add_action( 'admin_menu', 'su_admin_metaboxes_cleanup', 30 );


/**
 * Removes unnecessary sidebar widgets from WP.
 * Can remove additional widgets by
 * using the filter hook provided.
 *
 * @since    0.1 
 * @return   void
 */
function su_admin_widgets_cleanup() {

    $widgets = apply_filters('sudoh-dequeue-widgets', array());

    if ( ! empty($widgets) ) {

        foreach ( $widgets as $widget )
            unregister_widget( $widget );

    }

} add_action( 'widgets_init', 'su_admin_widgets_cleanup', 30 );


/**
 * Removes unnecessary widgets from the WP Dashboard.
 * Can remove additional widgets by
 * using the filter hook provided.
 *
 * @since    0.1
 * @return   void
 */
function su_admin_dashboard_cleanup() {

    $metaboxes = apply_filters('sudoh-dequeue-db-widgets', array());

    if ( ! empty($metaboxes) ) {

        foreach ( $metaboxes as $metabox )
            remove_meta_box( $metabox['id'], 'dashboard', $metabox['context'] );

    }

} add_action( 'wp_dashboard_setup', 'su_admin_dashboard_cleanup', 30 );


/**
 * Adds the current page slug as a body class,
 * and also removes a few unnecessary
 * classes from the body.
 *
 * Taken from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @return   array
 */
function su_body_class( $classes ) {

    // Add post / page slug
    if ( is_single() || is_page() && ! is_front_page() )
        $classes[] = basename(get_permalink());

    // Remove unnecessary classes
    $home_id_class = 'page-id-' . get_option('page_on_front');
    $remove_classes = array(
        'page-template-default',
        $home_id_class
    );
    $classes = array_diff($classes, $remove_classes);

    return $classes; 

} add_filter('body_class', 'su_body_class');


/**
 * Strips the default <ul> wrapper from theme menus.
 *
 * @since    0.1
 * @param    array $args - the menu args
 * @return   array
 */
function su_clean_menus( $args ) {

    $args['container'] = false;

    return $args;

} add_filter( 'wp_nav_menu_args', 'su_clean_menus' );


# END cleanup.php
