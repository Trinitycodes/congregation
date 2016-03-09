<?php
/* 
 * Adds the required CSS to the front end.
 */

add_action( 'wp_enqueue_scripts', 'congregation_css' );
/**
* Checks the settings for the images and background colors for each image
* If any of these value are set the appropriate CSS is output
*
* @since 1.0
*/
function congregation_css() {

	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	$opts = apply_filters( 'congregation_images', array( '1', '3', '5', '7', '9', '10', '11' ) );

	$settings = array();

	foreach( $opts as $opt ){
		$settings[$opt]['image'] = preg_replace( '/^https?:/', '', get_option( $opt .'-congregation-image', sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $opt ) ) );
	}

	$css = '';

	foreach ( $settings as $section => $value ) {

			$background = $value['image'] ? sprintf( 'background-image: url(%s);', $value['image'] ) : '';
			$image = $value['image'] ? sprintf( '<img src="%s" alt="Congregation Side Image" />', $value['image'] ) : '';

		if( is_front_page() ) {

			if( $section != 3 && $section != 5 && $section != 7 ) {
				$css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.home-page-%s { %s }', $section, $background ) : '';
			}

			if( $section == 3 ) {
				$css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.home-page-%s::before { %s }', $section, $background ) : '';
				$css .= sprintf( '.widget-side-image { %s }', $background );
			}

			if( $section == 5 ) {
				$css .= sprintf( '.home-page-5 .tc-half.fill { %s }', $background );
			}

			if( $section == 7 ) {
				$css .= sprintf( '.home-page-7 .tc-half.fill { %s }', $background );
			}

			if( $section == 10 ) {
				$css .= sprintf( '.home-page-10 .tc-half.fill { %s }', $background );
			}
		}

		// for member bulletin page template
		if( is_page_template( 'members-template.php' ) ) {

			$css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.member-page-%s { %s }', $section, $background ) : '';

		}

	}

	if( $css ){
		wp_add_inline_style( $handle, $css );
	}

}
