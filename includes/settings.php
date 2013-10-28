<?php
/**
 * Settings
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Echos the option provided if it was set in the backend.
 *
 * @since    0.1
 * @param    string $key - the option key, or ID
 * @return   mixed / boolean
 */
function su_option( $key ) {

	echo su_get_option($key);

}


/**
 * Returns the option provided if it was set in the backend.
 *
 * @since    0.1
 * @param    string $key - the option key, or ID
 * @return   mixed / boolean
 */
function su_get_option( $key ) {

	$options = get_option('option_tree');

	$key = str_replace('-', '_', $key );

	if ( ! array_key_exists( $key, $options ) ) 
		return false;

	return $options[ $key ];

}


/**
 * Sets up the default framework options during theme activation.
 *
 * @since    0.1
 * @return   null
 */
function su_default_settings() {

	$settings = apply_filters('sudoh-default-settings', array());

	if ( ! empty($settings) ) {

		foreach ( $settings as $key => $value )
			update_option( $key, $value );

	}

	// Update the permalinks
	flush_rewrite_rules();

} add_action('after_switch_theme', 'su_default_settings', 15 );


# END settings.php
