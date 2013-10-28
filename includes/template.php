<?php
/**
 * Template
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Prevents default wordpress filtering from
 * occuring within any [raw] shortcode tags.
 *
 * @since    0.1 
 * @return   void
 */
function su_raw_formatter( $content ) {

	$new_content      = '';
	$pattern_full     = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ( $pieces as $piece ) {
		if ( preg_match($pattern_contents, $piece, $matches) ) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;

}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'su_raw_formatter', 99);
add_filter('widget_text', 'su_raw_formatter', 99);


/**
 * Adds featured image support for the theme
 *
 * @since    0.1 
 * @return   void
 */
function su_thumbnail_support() {

	add_theme_support('post-thumbnails');

} add_action('init', 'su_thumbnail_support');


/**
 * Adds the ability to use shortcodes in widgets.
 *
 * @since    0.1 
 * @return   void
 */
function su_widget_shortcode_support() {

	add_filter('widget_text', 'do_shortcode');

} add_action('init', 'su_widget_shortcode_support');


# END template.php
