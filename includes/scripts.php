<?php
/**
 * Script Functions
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Handles all scripts associated with our framework.
 *
 * Enqueues native comment reply script for single posts.
 * Enqueues jQuery. Also witches over to CDN served jQuery if applicable.
 *
 * Registers all Foundation related scripts.
 * Registers main theme scripts file.
 *
 * jQuery CDN portion credited to Roots.
 *
 * @since    0.1
 * @return   void
 */
function su_setup_scripts() {

  	// Comment Reply
  	if ( is_single() && comments_open() && get_option('thread_comments') )
    	wp_enqueue_script('comment-reply');

    // jQuery CDN
	if ( ! is_admin() && current_theme_supports('sudoh-jquery-cdn') ) {
	    wp_deregister_script('jquery');
	    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', $deps = array(), $ver = '1.10.2', $in_footer = false);
	    add_filter('script_loader_src', 'su_jquery_local_fallback', 10, 2);
  	}

  	wp_enqueue_script('jquery');

	// Foundation Scripts
	wp_register_script('foundation',             THEME_JS . 'plugins/foundation.min.js',             $deps = array('jquery'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-abide',       THEME_JS . 'plugins/foundation.abide.min.js',       $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-alerts',      THEME_JS . 'plugins/foundation.alerts.min.js',      $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-clearing',    THEME_JS . 'plugins/foundation.clearing.min.js',    $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-cookie',      THEME_JS . 'plugins/foundation.cookie.min.js',      $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-dropdown',    THEME_JS . 'plugins/foundation.dropdown.min.js',    $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-forms',       THEME_JS . 'plugins/foundation.forms.min.js',       $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-interchange', THEME_JS . 'plugins/foundation.interchange.min.js', $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-joyride',     THEME_JS . 'plugins/foundation.joyride.min.js',     $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-magellan',    THEME_JS . 'plugins/foundation.magellan.min.js',    $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-orbit',       THEME_JS . 'plugins/foundation.orbit.min.js',       $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-placeholder', THEME_JS . 'plugins/foundation.placeholder.min.js', $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-reveal',      THEME_JS . 'plugins/foundation.reveal.min.js',      $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-section',     THEME_JS . 'plugins/foundation.section.min.js',     $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-tooltips',    THEME_JS . 'plugins/foundation.tooltips.min.js',    $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	wp_register_script('foundation-topbar',      THEME_JS . 'plugins/foundation.topbar.min.js',      $deps = array('foundation'), $ver = '4.3.2', $in_footer = true );
	
	// Theme Scripts
	wp_register_script('theme-scripts', THEME_JS . 'theme-scripts.min.js', $deps = array('jquery'), $ver = SUDOH_VERSION, $in_footer = true );

} add_action('wp_enqueue_scripts', 'su_setup_scripts', 20 );


/**
 * Adds a local fallback script for jQuery in the cases jQuery could not be loaded from google.
 *
 * More info here: http://wordpress.stackexchange.com/a/12450
 *
 * Modified from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @param    string $src - the script's source url
 * @param    string $handle - the script's handle
 * @return   string
 */
function su_jquery_local_fallback( $src, $handle = null ) {

  	static $add_jquery_fallback = false;

  	if ( $add_jquery_fallback ) {
    	echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/plugins/jquery.min.js"><\/script>\')</script>' . "\n";
    	$add_jquery_fallback = false;
  	}

  	if ( $handle === 'jquery' ) {
    	$add_jquery_fallback = true;
  	}

  	return $src;

} add_action('wp_head', 'su_jquery_local_fallback');


/**
 * Determines whether or not Google Analytics should be outputted.
 * 
 * First we check to see if an analytics ID has been turned on in the theme functions file, under config.
 * Then we check to ensure that the user is not an admin.
 *
 * If everything checks out, we output the analytics code along with the site ID set in the theme's config.
 *
 * Modified from Roots.
 *
 * @since    0.1
 * @author   Roots
 * @return   string / void
 */
function su_google_analytics() {

	if ( current_theme_supports('sudoh-google-analytics') && ! current_user_can('manage_options') ) { ?>

	<script>
	  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
	  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	  e.src='//www.google-analytics.com/analytics.js';
	  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	  ga('create','<?php echo su_config_item("google_analytics"); ?>');ga('send','pageview');
	</script>

	<?php
	}

} add_action('wp_footer', 'su_google_analytics', 20);


# END scripts.php
