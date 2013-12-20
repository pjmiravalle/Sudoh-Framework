<?php 
/**
 * Configuration Functions
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
*/

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Sets up the theme's configuration.
 *
 * @since    0.1 
 * @return   null
 */
function su_configuration() {

    if ( strlen(su_config_item('google_analytics')) > 1 )
    	add_theme_support('sudoh-google-analytics');

    if ( su_config_item('use_relative_urls') == true )
    	add_theme_support('sudoh-relative-urls');

    if ( su_config_item('enable_rewrites') == true )
    	add_theme_support('sudoh-url-rewrites');

    if ( su_config_item('use_jquery_cdn') == true )
        add_theme_support('sudoh-jquery-cdn');

} add_action('init', 'su_configuration', 5 );


/**
 * Retrieves a config item from the theme's configuration.
 *
 * @since    0.1
 * @param    string $key - the item's ID
 * @return   mixed / bool
 */
function su_config_item( $key ) {

	$config = apply_filters('sudoh-config', array());

	if ( array_key_exists($key, $config) )
		return $config[ $key ];
	else
		return false;

}


/* ----------------------------------------------------------------------- *|
/* ------ Theme Constructor Class ---------------------------------------- *|
/* ----------------------------------------------------------------------- */

class Theme_Constructor {

    /* ---------------------
     * Attributes
    --------------------- */

    var $pages      = array();
    var $menus      = array();
    var $settings   = array();

    var $menu_items = array();
    var $metaboxes  = array();
    var $widgets    = array();
    var $db_widgets = array();

    /* ---------------------
     * Methods
    --------------------- */

    public function __construct() {
        
        add_filter('sudoh-config', array($this, 'config') );

        add_filter('sudoh-default-pages',    array($this, 'pages')    );
        add_filter('sudoh-default-settings', array($this, 'settings') );
        add_filter('sudoh-menus',            array($this, 'menus')    );
        add_filter('sudoh-sidebars',         array($this, 'sidebars') );

        add_filter('sudoh-dequeue-menu-items', array($this, 'dequeue_menu_items') );
        add_filter('sudoh-dequeue-db-widgets', array($this, 'dequeue_db_widgets') );
        add_filter('sudoh-dequeue-widgets',    array($this, 'dequeue_widgets')    );
        add_filter('sudoh-dequeue-metaboxes',  array($this, 'dequeue_metaboxes')  );

        add_action('wp_enqueue_scripts', array($this, 'styles'),  30 );
        add_action('wp_enqueue_scripts', array($this, 'scripts'), 30 );

        add_action('admin_footer', array($this, 'check_dependencies') );

    }


    public function check_dependencies() {

        if ( ! class_exists('OT_Loader') ) {

            $link = '<a href="/wp-admin/update.php?action=install-plugin&plugin=option-tree&_wpnonce=df9e3f2748">' . __('here', 'sudoh') . '</a>';

            $html = '<div class="error">';
                $html .= '<p>';
                    $html .= __('Option Tree must be activated in order for your theme to function properly. Please click ', 'sudoh') . $link . __(' to install now.', 'sudoh');
                $html .= '</p>';
            $html .= '</div>';

            echo $html;

        }

    }
    

    public function config() {}


    public function settings() {}


    public function pages() {}


    public function menus() {}


    public function sidebars() {}


    public function dequeue_menu_items() {}


    public function dequeue_metaboxes() {}


    public function dequeue_widgets() {}


    public function dequeue_db_widgets() {}


    public function styles() {}


    public function scripts() {}


}

# END config.php
