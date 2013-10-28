<?php
/**
 * The template for displaying a 404 error in the case that the user hits a dead end.
 *
 * Modified from Roots.
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 * @author      Roots.
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit; ?>
<?php get_header(); ?>

<div class="row">
	
	<h3>404 - Page Not Found</h3>

	<hr />
	
	<div class="alert-box alert">
	  	<?php _e('Sorry, but the page you were trying to view does not exist.', 'sudoh'); ?>
	</div>

	<p><?php _e('It looks like this was the result of either:', 'sudoh'); ?></p>
	<ul class="side-nav">
		<li class="divider"></li>
	 	<li><?php _e('- a mistyped address', 'sudoh'); ?></li>
	  	<li><?php _e('- an out-of-date link', 'sudoh'); ?></li>
	</ul>

</div>

<?php get_footer(); ?>