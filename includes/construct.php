<?php 
/**
 * Theme Constructor
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
*/

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

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

			$html = '<div class="error">';
	        	$html .= '<p>';
	          		$html .= __('Option Tree must be activated in order for your theme to function properly. Click <a href="http://wordpress.org/plugins/option-tree/" target="_blank">here</a> to install now.', 'sudoh');
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


# END construct.php
