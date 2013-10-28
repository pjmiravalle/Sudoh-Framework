<?php
/**
 * Displays the theme footer.
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit; ?>

<!-- Footer -->
<footer class="row">
	<div class="large-12 columns">
	  	<hr />
	  	<div class="row">
	    	<div class="large-6 columns">
	      		<p>&copy; Copyright <?php bloginfo('name'); ?></p>
	    	</div>
	    	<div class="large-6 columns">
		        <?php
			        if ( has_nav_menu('footer-menu') )
			          	wp_nav_menu( array('theme_location' => 'footer-menu', 'menu_class' => 'inline-list right') );
			    ?>
	    	</div>
	  	</div>
	</div>
</footer>
<!-- End Footer -->

<?php wp_footer(); ?>

<script>
	
	$(document).foundation();

</script>

</body>
</html>