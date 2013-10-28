<?php
/**
 * Displays the theme header.
 *
 * Just a little bit of an explanation on a few of the things that we're doing in this file.
 *
 * 1. We are including an empty conditional block right
 *    after the DOCTYPE as a hack to increase page load time.
 *    READ MORE: http://www.phpied.com/conditional-comments-block-downloads/
 *
 * 2. We are using the X-UA-Compatible meta tag to ensure that IE
 *    uses the best rendering engine that it has readibly available.
 *
 * @package     Sudoh Framework
 * @copyright   Copyright (c) 2013, Patrick Miravalle
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit; ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
 	<meta charset="utf-8">
 	<title><?php wp_title('|', true, 'right'); ?></title>
 	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">

 	<link rel="shortcut icon" href="">
	<link rel="apple-touch-icon" href="">

  	<?php wp_head(); ?>

  	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php bloginfo('url'); ?>/feed/">
</head>
<body <?php body_class(); ?>>
	
<header>

	<nav class="top-bar">
	    <ul class="title-area">
	      	<li class="name">
	        	<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
	      	</li>
	        <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
	    </ul>
	 
	    <section class="top-bar-section">
        	<?php
		        if ( has_nav_menu('main-menu') )
		          	wp_nav_menu( array('theme_location' => 'main-menu', 'menu_class' => 'right', 'show_dividers' => true ) );
		    ?>
	    </section>
  	</nav>
	
</header>
