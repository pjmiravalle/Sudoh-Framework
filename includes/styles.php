<?php
/**
 * Styling Functions
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Handles all stylesheets associated with our framework.
 *
 * Registers main theme styles file.
 *
 * @since    0.1
 * @return   void
 */
function su_setup_styles() {

	wp_register_style('theme-styles', THEME_CSS . 'main.min.css', $deps = array(), $ver = SUDOH_VERSION );
	
} add_action('wp_enqueue_scripts', 'su_setup_styles', 10 );

# END styles.php
