<?php
/**
 * Helper Functions
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Acts as a debug helper, which outputs the data
 * wrapped in <pre> tags for better readability.
 *
 * Also added in a WP_DEBUG check to ensure that we don't
 * output any data in non-development environments.
 *
 * @since    0.1
 * @param    mixed $data - the data you would like to look at.
 * @return   bool / string
 */
function debug( $data ) {

	if ( ! WP_DEBUG )
		return false;

	echo '<pre>';
		print_r($data);
	echo '</pre>';

	die();

}


/**
 * Attaches a function to multiple filter hooks.
 *
 * Taken from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @param    array $handles - a list of filter handles to hook to
 * @param    string $function - the function to run for each of the handles 
 * @return   void
 */
function add_filters( $handles, $function ) {

	foreach( $handles as $handle )
    	add_filter($handle, $function);

}


/**
 * Determines whether or not an element is empty.
 *
 * Taken from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @param    string $element - the element to check
 * @return   bool
 */
function is_element_empty( $element ) {

  	$element = trim($element);
  	return empty($element) ? false : true;

}


/**
 * Includes all files from the directory or directories provided (so long as they exist).
 *
 * @since    0.1
 * @param    array $directories
 * @return   void
 */
function su_include_files( $directories ) {

	foreach ( $directories as $directory ) {

		if ( ! file_exists($directory) )
			continue;

		foreach ( glob( trailingslashit($directory) . '*.php') as $file )
			include_once( $file );
	}

}


/**
 * Returns all class names that are children of the parent provided.
 *
 * @since    0.1
 * @param    $parent - the parent class to be used for the query
 * @return   void
 */
function su_get_classes( $parent ) {

	$children = array();
	$classes  = get_declared_classes();

	// Reverse for performance
	foreach ( array_reverse($classes) as $class ) {

		if ( is_subclass_of($class, $parent) )
			$children[] = $class;
	}

	return $children;

}



# END functions.php
