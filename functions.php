<?php
/**
 * Theme Functions
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

include_once('includes/_init.php');

/* ----------------------------------------------------------------------- *|
/* ------ Theme Setup ---------------------------------------------------- *|
/* ----------------------------------------------------------------------- */

if ( class_exists('Theme_Constructor') ) {

/**
 * The Sudoh Theme Constructor. 
 *
 * This handy little class has various methods that will
 * allow you to get a jumpstart on the setup of your site.
 *
 * @since   0.1
 */
class Sudoh_Theme extends Theme_Constructor {

	/* ----------------------------------------------------------------------- *|
	/* ------ Configuration -------------------------------------------------- *|
	/* ----------------------------------------------------------------------- */
	
	/**
	 * Sets up various configuration options for your site.
	 *
	 * 1. Google Analytics. Add your site's Analytics ID here to start
	 *    tracking your visitors. If you would like to disable
	 *    this feature, set the value to false.
	 *
	 * 2. Relative URLS. When enabled, will convert default WordPress
	 *    links on your site to a relative based URL.
	 *    EX: http://site.com/home to /home
	 *
	 * 3. URL Rewrites. When enabled, will rewrite various URL structures:
	 *    /wp-content/themes/themename/assets/css/    becomes /assets/css/
	 *    /wp-content/themes/themename/assets/js/     becomes /assets/js/
	 *    /wp-content/themes/themename/assets/images/ becomes /assets/images/
	 *    /wp-content/plugins/                        becomes /plugins/
	 *
	 * 4. jQuery CDN. When enabled, will request jQuery from Google's CDN network.
	 *    Also adds a local fallback in the case that we can't communicate with Google.
	 *
	 * @since    0.1
	 * @access   public
	 * @return   array
	 */
	public function config() {

		// Google Analytics
		$this->config['google_analytics'] = 'UA-XXXXX-Y';
		
		// URL Config
		$this->config['use_relative_urls'] = true;
		$this->config['enable_rewrites']   = true;

		// Scripts Config
		$this->config['use_jquery_cdn'] = true;

		return $this->config;

	}


	/**
	 * Sets up some default settings for your site when the theme is activated.
	 * Feel free to add or remove settings from this list as needed.
	 *
	 * @since    0.1
	 * @access   public
	 * @uses     update_option http://codex.wordpress.org/Function_Reference/update_option
	 * @return   array
	 */
	public function settings() {

		// General Settings
		$this->settings['blogdescription'] = 'Your Site Tagline';
		$this->settings['date_format']     = 'F j, Y';
		$this->settings['time_format']     = 'g:i a';
		$this->settings['gmt_offset']      = '-5';

		// Reading Settings
		$this->settings['show_on_front'] = 'page';
		$this->settings['page_on_front'] = su_get_post_id_by_title('Home');

		// Media Settings
		$this->settings['uploads_use_yearmonth_folders'] = false;

		// Permalink Settings
		$this->settings['permalink_structure'] = '/%postname%/';

		return $this->settings;
	
	}


	/**
	 * Creates default pages for your site when the theme is activated.
	 * Feel free to add or remove pages from this list as needed.
	 *
	 * @since    0.1
	 * @access   public
	 * @uses     wp_insert_post http://codex.wordpress.org/Function_Reference/wp_insert_post
	 * @return   array
	 */
	public function pages() {

		// Home Page
        $this->pages['home'] = array(
            'post_title'     => 'Home',
            'post_content'   => 'Thank you for choosing Sudoh Framework. Happy Coding!',
            'post_status'    => 'publish',
            'post_author'    => 1,
            'post_type'      => 'page',
            'comment_status' => 'closed'
        );

        // About Page
        $this->pages['about'] = array(
            'post_title'     => 'About',
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_author'    => 1,
            'post_type'      => 'page',
            'comment_status' => 'closed'
        );

        // Contact Page
        $this->pages['contact'] = array(
            'post_title'     => 'Contact',
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_author'    => 1,
            'post_type'      => 'page',
            'comment_status' => 'closed'
        );

        return $this->pages;

	}


	/**
	 * Sets up navigation menus for your theme.
	 * Feel free to add or remove menus from this list as needed.
	 *
	 * Call on these menus by using the following:
	 * wp_nav_menu( array('theme_location' => $key) );
	 *
	 * @since    0.1
	 * @access   public
	 * @uses     register_nav_menu http://codex.wordpress.org/Template_Tags/register_nav_menu
	 * @return   array
	 */
	public function menus() {

		$this->menus['main-menu']   = 'Main Menu';
		$this->menus['footer-menu'] = 'Footer Menu';

		return $this->menus;

	}


	/**
	 * Sets up widget sidebars for your theme.
	 * Feel free to add or remove sidebars from this list as needed.
	 *
	 * Call on these menus by using the following:
	 * dynamic_sidebar($key);
	 *
	 * @since    0.1
	 * @access   public
	 * @uses     register_sidebar http://codex.wordpress.org/Function_Reference/register_sidebar
	 * @return   array
	 */
	public function sidebars() {

		$this->sidebars['sidebar'] = array(
			'name'          => 'Sidebar',
			'description'   => 'This is the default sidebar for your site.'
		);

		$this->sidebars['footer'] = array(
			'name'          => 'Footer Widgets',
			'description'   => 'Widgets added to this section will be displayed in the footer.'
		);

		return $this->sidebars;

	}


	/* ----------------------------------------------------------------------- *|
	/* ------ Cleanup -------------------------------------------------------- *|
	/* ----------------------------------------------------------------------- */

	/**
	 * Removes menu items from the WordPress Admin menu.
	 *
	 * Some examples are provided below.
	 *
	 * @since    0.1
	 * @access   public
	 * @uses     remove_menu_page http://codex.wordpress.org/Function_Reference/remove_menu_page
	 * @uses     remove_submenu_page http://codex.wordpress.org/Function_Reference/remove_submenu_page
	 * @return   array
	 */
	public function dequeue_menu_items() {

		//$this->menu_items[] = 'links-manager.php';
		//$this->menu_items[] = array( 'parent' => 'w3tc_dashboard', 'id' => 'w3tc_cdn' );

		return $this->menu_items;

	}


	/**
	 * Removes meta boxes from edit post screens in the WordPress Admin.
	 * Feel free to add or remove meta boxes from this list as needed.
	 *
	 * @since    0.1
	 * @access   public
	 * @uses     remove_meta_box http://codex.wordpress.org/Function_Reference/remove_meta_box
	 * @return   array
	 */
	public function dequeue_metaboxes() {

		$this->metaboxes[] = 'authordiv';  // Author Metabox
		$this->metaboxes[] = 'slugdiv';    // Slug Metabox
		$this->metaboxes[] = 'postcustom'; // Custom Fields Metabox

		return $this->metaboxes;

	}


	/**
	 * Removes widgets from the WordPress Admin.
	 * Feel free to add or remove widgets from this list as needed.
	 *
	 * @since    0.1
	 * @access   public
	 * @uses     unregister_widget http://codex.wordpress.org/Function_Reference/unregister_widget
	 * @return   array
	 */
	public function dequeue_widgets() {

		$this->widgets[] = 'WP_Widget_Pages';
    	$this->widgets[] = 'WP_Widget_Calendar';
    	$this->widgets[] = 'WP_Widget_Archives';
    	$this->widgets[] = 'WP_Widget_Links';
    	$this->widgets[] = 'WP_Widget_Categories';
    	$this->widgets[] = 'WP_Widget_Recent_Posts';
    	$this->widgets[] = 'WP_Widget_Search';
    	$this->widgets[] = 'WP_Widget_Tag_Cloud';
    	$this->widgets[] = 'WP_Widget_Meta';
    	$this->widgets[] = 'WP_Widget_RSS';
    	$this->widgets[] = 'WP_Widget_Recent_Comments';

		return $this->widgets;

	}


	/**
	 * Removes widgets specifically from the WordPress Admin Dashboard.
	 * Feel free to add or remove widgets from this list as needed.
	 *
	 * @since    0.1
	 * @access   public
	 * @uses     remove_meta_box http://codex.wordpress.org/Function_Reference/remove_meta_box
	 * @return   array
	 */
	public function dequeue_db_widgets() {

		$this->db_widgets[] = array( 'id' => 'dashboard_incoming_links', 'context' => 'normal' );  // Incoming Links Widget
		$this->db_widgets[] = array( 'id' => 'dashboard_plugins',        'context' => 'normal' );  // Plugins Widget
		$this->db_widgets[] = array( 'id' => 'dashboard_primary',        'context' => 'side'   );  // WordPress Blog Widget
		$this->db_widgets[] = array( 'id' => 'dashboard_secondary',      'context' => 'side'   );  // WordPress News Widget
		$this->db_widgets[] = array( 'id' => 'dashboard_quick_press',    'context' => 'side'   );  // QuickPress Widget

		return $this->db_widgets;

	}


	/* ----------------------------------------------------------------------- *|
	/* ------ Assets --------------------------------------------------------- *|
	/* ----------------------------------------------------------------------- */

	/**
	 * Add in all of your theme's styles here.
	 *
	 * @since    0.1
	 * @access   public     
	 * @return   array
	 */
	public function styles() {

		wp_enqueue_style('normalize');
    	wp_enqueue_style('theme-styles');

	}


	/**
	 * Add in all of your theme's scripts here.
	 *
	 * @since    0.1
	 * @access   public     
	 * @return   array
	 */
	public function scripts() {

		wp_enqueue_script('foundation');
		wp_enqueue_script('foundation-topbar');
		wp_enqueue_script('theme-scripts');
		
	}
	
} new Sudoh_Theme; }

/* ----------------------------------------------------------------------- *|
/* ------ Theme specific functions go below this line -------------------- *|
/* ----------------------------------------------------------------------- */



# END functions.php
