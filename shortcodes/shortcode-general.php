<?php
/**
 * General Shortcodes
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Outputs an H1 tag.
 *
 * @since    0.1
 * @param    array $atts - the shortcode attributes
 * @param    string $content - the shortcode content
 * @return   string
 */
function su_h1( $atts, $content = null ) {

	return '<h1>' . do_shortcode( $content ) . '</h1>';

} add_shortcode('h1', 'su_h1');


/**
 * Outputs an H2 tag.
 *
 * @since    0.1
 * @param    array $atts - the shortcode attributes
 * @param    string $content - the shortcode content
 * @return   string
 */
function su_h2( $atts, $content = null ) {

	return '<h2>' . do_shortcode( $content ) . '</h2>';

} add_shortcode('h2', 'su_h2');


/**
 * Outputs an H3 tag.
 *
 * @since    0.1
 * @param    array $atts - the shortcode attributes
 * @param    string $content - the shortcode content
 * @return   string
 */
function su_h3( $atts, $content = null ) {

	return '<h3>' . do_shortcode( $content ) . '</h3>';

} add_shortcode('h3', 'su_h3');


/**
 * Outputs an H4 tag.
 *
 * @since    0.1
 * @param    array $atts - the shortcode attributes
 * @param    string $content - the shortcode content
 * @return   string
 */
function su_h4( $atts, $content = null ) {

	return '<h4>' . do_shortcode( $content ) . '</h4>';

} add_shortcode('h4', 'su_h4');


/**
 * Outputs an H5 tag.
 *
 * @since    0.1
 * @param    array $atts - the shortcode attributes
 * @param    string $content - the shortcode content
 * @return   string
 */
function su_h5( $atts, $content = null ) {

	return '<h5>' . do_shortcode( $content ) . '</h5>';

} add_shortcode('h5', 'su_h5');


/**
 * Outputs an H6 tag.
 *
 * @since    0.1
 * @param    array $atts - the shortcode attributes
 * @param    string $content - the shortcode content
 * @return   string
 */
function su_h6( $atts, $content = null ) {

	return '<h6>' . do_shortcode( $content ) . '</h6>';

} add_shortcode('h6', 'su_h6');


# END shortcode-general.php
