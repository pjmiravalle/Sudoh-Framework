<?php
/**
 * The default template for displaying a single post, or custom post type.
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit; ?>
<?php get_header(); ?>

<div class="main row">

	<!--[if lt IE 9]><div class="alert-box secondary">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</div><![endif]-->
		
	<div class="content large-9 columns">

		<?php while ( have_posts() ): the_post(); ?>
			<h3 class="page-title"><?php the_title(); ?></h3>
		  	<div class="page-content"><?php the_content(); ?></div>
		<?php endwhile; ?>

	</div>

	<div class="sidebar large-3 columns">
		
		<?php
			if ( is_active_sidebar('sidebar') )
				dynamic_sidebar('sidebar');
		?>

	</div>

</div>

<?php get_footer(); ?>