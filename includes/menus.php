<?php
/**
 * Menus
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
*/

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Registers the theme menus, which would be set in the theme functions file.
 *
 * @since    0.1 
 * @return   void
 */
function su_register_menus() {

	$menus = apply_filters('sudoh-menus', array());

	if ( ! empty($menus) ) {

		foreach ( $menus as $handle => $name )
			register_nav_menu( $handle, $name );

	}

} add_action('init', 'su_register_menus');


/**
 * During theme activation, will create a menu and assign the
 * currently published pages for each menu registered by the user.
 *
 * @since    0.1 
 * @return   void
 */
function su_create_menus() {

	$menus = get_registered_nav_menus();

	if ( ! empty($menus) ) {

		$locations = array(); 
		$pages = get_pages( array('sort_column' => 'ID') );
	
		foreach ( $menus as $handle => $name ) {

			$menu_exists = wp_get_nav_menu_object($handle);

			if ( ! $menu_exists ) {

				// Create the menu
				$menu_id = wp_create_nav_menu( $name );

				// Set menu location
				$locations[$handle] = $menu_id;

				if ( ! empty($pages) ) {

					// Add pages to menu
					foreach ( $pages as $key => $page ) {

			        	$item = array(
			          		'menu-item-object-id' => $page->ID,
			          		'menu-item-object'    => 'page',
			          		'menu-item-type'      => 'post_type',
			          		'menu-item-status'    => 'publish',
			          		'menu-item-position'  => $key
			        	);

			        	wp_update_nav_menu_item($menu_id, 0, $item);

			      	}

				}

			}

		}

		// Assign locations for each menu
		set_theme_mod('nav_menu_locations', $locations );

	}

} add_action('after_switch_theme', 'su_create_menus');


/**
 * Alters the output of nav menus.
 *
 * Remove the id="" on nav menu items.
 * Return 'menu-item-$slug' for nav menu classes
 *
 * Modified from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @param    string $classes - the menu item's CSS classes
 * @param    object $item - the menu item
 * @return   array
 */
function su_nav_menu_css_class( $classes, $item ) {

  	$slug = sanitize_title($item->title);
  	$classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  	$classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

  	$classes[] = 'menu-item-' . $slug;

  	$classes = array_unique($classes);

 	return array_filter($classes, 'is_element_empty');

}

add_filter('nav_menu_css_class', 'su_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');


/**
 * Cleans up the default nav menu args.
 *
 * Removes the nav container.
 * Removes the items wrap ( default is <ul> )
 * Adds in an additional arg for outputting dividers between each list item.
 * Uses our custom Walker for outputting menu items.
 *
 * Modified from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @param    array $args - the current menu args
 * @return   array
 */
function su_nav_menu_args( $args = '' ) {

  	$args['container']  = false;

  	if ( ! $args['items_wrap'] )
  		$args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';

  	if ( ! isset($args['show_dividers']) )
  		$args['show_dividers'] = false;

  	if ( ! $args['walker'] )
    	$args['walker'] = new SU_Nav_Walker();

  	return $args;

} add_filter('wp_nav_menu_args', 'su_nav_menu_args');

/* ----------------------------------------------------------------------- *|
/* ------ Nav Menu Walker ------------------------------------------------ *|
/* ----------------------------------------------------------------------- */

class SU_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Determines whether or not the current item is current.
	 *
	 * Modified from Roots.
	 *
	 * @since    0.1
	 * @author   Roots
	 */
  	public function check_current( $classes ) {

    	return preg_match('/(current[-_])|active|dropdown/', $classes);

 	}


 	/**
	 * Outputs the beginning of a dropdown.
	 *
	 * Modified from Roots.
	 *
	 * @since    0.1
	 * @author   Roots
	 */
  	public function start_lvl( &$output, $depth = 0, $args = array() ) {

    	$output .= "\n<ul class=\"dropdown\">\n";

  	}


  	/**
	 * Outputs the beginning of a menu item.
	 *
	 * Modified from Roots.
	 *
	 * @since    0.1
	 * @author   Roots
	 */
  	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0) {

  		$item_html = '';

  		if ( $args->show_dividers == true )
			$item_html .= '<li class="divider"></li>';

    	parent::start_el( $item_html, $item, $depth, $args );

   		$item_html = apply_filters('sudoh-menu-item', $item_html);
   		$output .= $item_html;

  	}


  	/**
	 * Displays the element.
	 *
	 * Modified from Roots.
	 *
	 * @since    0.1
	 * @author   Roots
	 */
  	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

    	$element->is_dropdown = ( ( ! empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

    	if ( $element->is_dropdown )
     		$element->classes[] = 'has-dropdown';

    	parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

  	}

}


# END menus.php
