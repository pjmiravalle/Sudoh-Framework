<?php
/**
 * URL Functions
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * First checks to see if the URL provided is an absolute path.
 * If it is indeed an absolute path, we make it relative, and then return the value.
 * If the URL is already relative, then we simply return it.
 *
 * Taken from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @param    string $url - the url to potentially convert
 * @return   string
 */
function su_relative_url( $url ) {

	preg_match('|https?://([^/]+)(/.*)|i', $url, $matches );

    if ( isset($matches[1]) && isset($matches[2]) && $matches[1] === $_SERVER['SERVER_NAME'] ) {
    	return wp_make_link_relative($url);
    } else {
    	return $url;
    }

}


/**
 * Determines whether or not relative URLs should be enabled.
 * 
 * First we check to see if relative URLs have been turned on in the theme functions file, under config.
 * Then we check to ensure that we are not on any admin related page.
 *
 * If everything checks out, we hook our relative url converter function to every default WordPress link.
 *
 * Modified from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @return   bool / void
 */
function su_enable_relative_urls() {

	if ( ! current_theme_supports('sudoh-relative-urls') )
		return false;

	if ( is_admin() || in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php') ) )
		return false;

    $relative_filters = array(
	    'bloginfo_url',
	    'the_permalink',
	    'page_link',
	    'post_link',
	    'post_type_link',
	    'wp_list_pages',
	    'wp_list_categories',
	    'sudoh-menu-item',
	    'the_content_more_link',
	    'the_tags',
	    'get_pagenum_link',
	    'get_comment_link',
	    'month_link',
	    'day_link',
	    'year_link',
	    'tag_link',
	    'the_author_posts_link',
	    'script_loader_src',
	    'style_loader_src'
    );

    add_filters( $relative_filters, 'su_relative_url' );

} add_action('init', 'su_enable_relative_urls');


/**
 * Adds our custom rewrite rules to the WordPress rewrite
 * class, which then outputs in the site's htaccess.
 *
 * Our custom rewrite rules will do the following:
 *  /wp-content/themes/themename/assets/css/    to /assets/css/
 *  /wp-content/themes/themename/assets/js/     to /assets/js/
 *  /wp-content/themes/themename/assets/images/ to /assets/images/
 *  /wp-content/plugins/                        to /plugins/
 *
 * Taken from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @return   void
 */
function su_add_rewrites() {

  	global $wp_rewrite;

  	$additional_rules = array(
    	'assets/(.*)'  => 'wp-content/themes/' . THEME_NAME . '/assets/$1',
    	'plugins/(.*)' => 'wp-content/plugins/$1'
  	);

  	$wp_rewrite->non_wp_rules = array_merge($wp_rewrite->non_wp_rules, $additional_rules);

}


/**
 * Modifies the URL provided to match our custom rewrite rules.
 *
 * Taken from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @param    string $url - the URL to modify
 * @return   string
 */
function su_clean_url( $url ) {

  	if ( strpos($url, 'wp-content/plugins') > 0 ) {
    	return str_replace('/wp-content/plugins', '/plugins', $url);
  	} else {
    	return str_replace('/wp-content/themes/' . THEME_NAME, '', $url);
  	}

}


/**
 * Determines whether or not our custom URL rewrites should be enabled.
 * 
 * First we check to see if URL rewrites have been turned on in the theme functions file, under config.
 * Then we check to ensure that the site is not a multisite or child theme.
 * Then we check to ensure that we are not on any admin related page.
 *
 * If everything checks out, we add our rewrite rules to the site's
 * htaccess, and we modify various URLs to match our new rewrite rules.
 *
 * Taken from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @return   bool / void
 */
function su_enable_url_rewrites() {

	if ( ! current_theme_supports('sudoh-url-rewrites') )
		return false;

	if ( ! is_multisite() && ! is_child_theme() ) {

  		if ( ! is_admin() ) {

  			$filters = array(
		      	'plugins_url',
		      	'bloginfo',
		      	'stylesheet_directory_uri',
		      	'template_directory_uri',
		      	'script_loader_src',
		      	'style_loader_src'
		    );

	    	add_filters($filters, 'su_clean_url');

  		}

    	add_action('generate_rewrite_rules', 'su_add_rewrites');

	}

} add_action('init', 'su_enable_url_rewrites');


# END urls.php
