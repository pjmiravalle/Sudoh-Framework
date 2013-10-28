<?php
/**
 * This is an example shortcode.
 *
 * All php files under this directory are automatically
 * included, so there is no need to include them yourself.
 *
 * The file name for your shortcode can be anything you would like, but we
 * recommend using the shortcode-{name}.php structure for organization purposes.
 *
 * For more information on shortcodes, @see http://codex.wordpress.org/Shortcode_API
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Simple shortcode example.
 *
 * @since    0.1
 * @param    array $atts - the shortcode attributes
 * @param    string $content - the shortcode content
 * @return   string
 */
function example_shortcode( $atts, $content = null ) {

	// Will output the shortcode's content
	echo '<p>' . $content . '</p>';

} add_shortcode('example', 'example_shortcode');


# END shortcode-example.php
