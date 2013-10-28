<?php
/**
 * Metabox Page Tagline
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1  
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Creates a metabox that allows us to set a tagline for the current page.
 *
 * @since    0.1
 */
class SU_Page_Tagline_Metabox extends SU_Metabox {

	public function __construct() {

		$this->ID = 'sudoh-page-tagline';

		$this->args = array(
			'title'     => 'Page Tagline',
			'post_type' => 'page',
			'context'   => 'side',
			'priority'  => 'default'
		);

		$this->fields = array(
			'sudoh-page-tagline'
		);

		parent::__construct();

	}

	public function output( $post ) {

		$value = get_post_meta($post->ID, 'sudoh-page-tagline', true);

		printf('<textarea class="widefat" name="%s" rows="5">%s</textarea>', 'sudoh-page-tagline', $value );

	}

}


# END metabox-page-tagline.php
