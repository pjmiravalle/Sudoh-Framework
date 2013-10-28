<?php
/*
Plugin Name: Sudoh Framework
Description: Sudoh is a lightweight theming framework that ties all the goodness of Foundation 4 and HTML5 Boilerplate with WordPress.
Version: 0.1
Author: Patrick Miravalle
Author URI: https://twitter.com/sudohweb
*/

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/* ----------------------------------------------------------------------- *|
/* ------ Theme Constants ------------------------------------------------ *|
/* ----------------------------------------------------------------------- */

// Theme Name
if ( ! defined('THEME_NAME') )
	define( 'THEME_NAME', get_option('template') );

// Theme Base Path
if ( ! defined('THEME_BASE') )
	define( 'THEME_BASE', get_template_directory() );

// Theme URL
if ( ! defined('THEME_URL') )
	define( 'THEME_URL', get_template_directory_uri() );

// Theme Includes Path
if ( ! defined('THEME_INCLUDES') )
	define( 'THEME_INCLUDES', THEME_BASE . '/includes/' );

// Theme Post Types Path
if ( ! defined('THEME_POST_TYPES') )
	define( 'THEME_POST_TYPES', THEME_BASE . '/post-types/' );

// Theme Metaboxes Path
if ( ! defined('THEME_METABOXES') )
	define( 'THEME_METABOXES', THEME_BASE . '/metaboxes/' );

// Theme Shortcodes Path
if ( ! defined('THEME_SHORTCODES') )
	define( 'THEME_SHORTCODES', THEME_BASE . '/shortcodes/' );

// Theme Widgets Path
if ( ! defined('THEME_WIDGETS') )
	define( 'THEME_WIDGETS', THEME_BASE . '/widgets/' );

// CSS Directory
if ( ! defined('THEME_CSS') )
	define( 'THEME_CSS', THEME_URL . '/assets/css/' );

// Images Directory
if ( ! defined('THEME_IMAGES') )
	define( 'THEME_IMAGES', THEME_URL . '/assets/images/' );

// JS Directory
if ( ! defined('THEME_JS') )
	define( 'THEME_JS', THEME_URL . '/assets/js/' );

/* ----------------------------------------------------------------------- *|
/* ------ Initiate ------------------------------------------------------- *|
/* ----------------------------------------------------------------------- */

define('SUDOH_VERSION', '0.1');

/**
 * Sudoh Framework Class
 *
 * @package    Sudoh Framework
 * @author     Patrick Miravalle
 * @version    0.1
 */
class Sudoh_Framework {

	/* ---------------------
	 * Methods
	--------------------- */

	public function __construct() {

		$this->includes();

		do_action('sudoh_loaded');

	}
	

	/**
	 * Includes all required files.
	 *
	 * @access private
	 * @return void
	 */
	private function includes() {
		
		include_once( THEME_INCLUDES . 'helpers.php'   );
		include_once( THEME_INCLUDES . 'settings.php'  );
		include_once( THEME_INCLUDES . 'security.php'  );
		include_once( THEME_INCLUDES . 'cleanup.php'   );
		include_once( THEME_INCLUDES . 'post-type.php' );
		include_once( THEME_INCLUDES . 'widget.php'    );
		include_once( THEME_INCLUDES . 'metabox.php'   );
		include_once( THEME_INCLUDES . 'pages.php'     );
		include_once( THEME_INCLUDES . 'menus.php'     );
		include_once( THEME_INCLUDES . 'template.php'  );
		include_once( THEME_INCLUDES . 'urls.php'      );
		include_once( THEME_INCLUDES . 'styles.php'    );
		include_once( THEME_INCLUDES . 'scripts.php'   );
		include_once( THEME_INCLUDES . 'config.php'    );

		// Include Post Types, Metaboxes, Shortcodes, and Widgets
		su_include_files(
			array(
				THEME_POST_TYPES,
				THEME_METABOXES,
				THEME_SHORTCODES,
				THEME_WIDGETS
			)
		);

	}

}

// Start up the Framework //
$GLOBALS['sudoh'] = new Sudoh_Framework();
