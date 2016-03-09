<?php
/**
 * This file adds the Home Page to the Trailhead Theme.
 *
 * @author Trinity Codes
 * @package Congregation
 * @subpackage Customizations
 */

//* Remove the site title
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

add_action( 'genesis_meta', 'congregation_home_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function congregation_home_page_genesis_meta() {

	if ( is_active_sidebar( 'home-page-1' ) || is_active_sidebar( 'home-page-2' ) || is_active_sidebar( 'home-page-3' ) || is_active_sidebar( 'home-page-4' ) || is_active_sidebar( 'home-page-5' ) || is_active_sidebar( 'home-page-6' ) || is_active_sidebar( 'home-page-7' ) || is_active_sidebar( 'home-page-8' ) || is_active_sidebar( 'home-page-9' ) || is_active_sidebar( 'home-page-10' ) || is_active_sidebar( 'home-page-11' ) || is_active_sidebar( 'home-page-12' ) ) {

		//* Enqueue scripts
		add_action( 'wp_enqueue_scripts', 'congregation_enqueue_congregation_script' );
		function congregation_enqueue_congregation_script() {

			wp_enqueue_script( 'congregation-script', get_bloginfo( 'stylesheet_directory' ) . '/js/home.js', array( 'jquery' ), '1.0.0' );
			wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
			wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );

		}

		//* Add home-page body class
		add_filter( 'body_class', 'congregation_body_class' );
		function congregation_body_class( $classes ) {

   			$classes[] = 'home-page';
  			return $classes;

		}

		//* Force full width content layout
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add homepage widgets
		add_action( 'genesis_loop', 'congregation_home_page_widgets' );

		//* Add featured-section body class
		if ( is_active_sidebar( 'home-page-1' ) ) {

			//* Add image-section-start body class
			add_filter( 'body_class', 'congregation_featured_body_class' );
			function congregation_featured_body_class( $classes ) {

				$classes[] = 'featured-section';				
				return $classes;

			}

		}

	}

}

//* Add markup for home page widgets
function congregation_home_page_widgets() {

	genesis_widget_area( 'home-page-1', array(
		'before' => '<div id="home-page-1" class="home-page-1"><div class="image-section"><div class="flexible-widgets widget-area' . congregation_widget_area_class( 'home-page-1' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-2', array(
		'before' => '<div id="home-page-2" class="home-page-2"><div class="solid-section"><div class="flexible-widgets widget-area' . congregation_widget_area_class( 'home-page-2' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-3', array(
		'before' => '<div id="home-page-3" class="home-page-3"><div class="image-section"><div class="flexible-widgets widget-area' . congregation_widget_area_class( 'home-page-3' ) . '"><div class="wrap"><div class="special-part-one-half first tc-image-content-section">&nbsp;<div class="widget-side-image"></div></div><div class="special-large-one-half">',
		'after'  => '</div></div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-4', array(
		'before' => '<div id="home-page-4" class="home-page-4"><div class="solid-section"><div class="flexible-widgets widget-area' . congregation_widget_area_class( 'home-page-4' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-5', array(
		'before' => '<div id="home-page-5" class="home-page-5"><div class="image-section-5"><div class="wrap"><div class="tc-half table-bottom">',
		'after'  => '</div><div class="tc-half fill table-top"><div class="fill-cover"></div></div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-6', array(
		'before' => '<div id="home-page-6" class="home-page-6"><div class="solid-section"><div class="flexible-widgets widget-area' . congregation_widget_area_class( 'home-page-6' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-7', array(
		'before' => '<div id="home-page-7" class="home-page-7"><div class="image-section-7"><div class="wrap"><div class="tc-half fill table-top"><div class="fill-cover"></div></div><div class="tc-half table-bottom">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-8', array(
		'before' => '<div id="home-page-8" class="home-page-8"><div class="solid-section"><div class="flexible-widgets widget-area' . congregation_widget_area_class( 'home-page-8' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-9', array(
		'before' => '<div id="home-page-9" class="home-page-9"><div class="image-section"><div class="flexible-widgets widget-area' . congregation_widget_area_class( 'home-page-9' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-10', array(
		'before' => '<div id="home-page-10" class="home-page-10"><div class="image-section-10"><div class="wrap"><div class="tc-half table-bottom">',
		'after'  => '</div><div class="tc-half fill table-top"><div class="fill-cover"></div></div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-11', array(
		'before' => '<div id="home-page-11" class="home-page-11"><div class="image-section"><div class="flexible-widgets widget-area' . congregation_widget_area_class( 'home-page-11' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'home-page-12', array(
		'before' => '<div id="home-page-12" class="home-page-12"><div class="solid-section"><div class="flexible-widgets widget-area' . congregation_widget_area_class( 'home-page-12' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

}

genesis();
