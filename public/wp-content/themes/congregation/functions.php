<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Add Image upload to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Congregation' );
define( 'CHILD_THEME_URL', 'http://trinitycodes.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'congregation_enqueue_scripts_styles' );
function congregation_enqueue_scripts_styles() {

	wp_enqueue_script( 'congregation-global', get_bloginfo( 'stylesheet_directory' ) . '/js/global.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'congregation-google-fonts', '//fonts.googleapis.com/css?family=Advent+Pro:100,200,300|Roboto:200,300,800', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add support for footer menu
add_theme_support ( 'genesis-menus' , array ( 'primary' => 'Primary Navigation Menu', 'secondary' => 'Secondary Navigation Menu', 'footer' => 'Footer Navigation Menu' ) );

//* Load main style sheet after WooCommerce */
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 30 ); //change load priority
add_action( 'wp_enqueue_scripts', 'congregation_css', 30 );

//* Hook menu in footer
add_action( 'genesis_footer', 'rainmaker_footer_menu', 7 );
function rainmaker_footer_menu() {
	printf( '<nav %s>', genesis_attr( 'nav-footer' ) );
	wp_nav_menu( array(
		'theme_location' => 'footer',
		'container'      => false,
		'depth'          => 1,
		'fallback_cb'    => false,
		'menu_class'     => 'genesis-nav-menu',	
	) );
	
	echo '</nav>';
}

//* Unregister the header right widget area
unregister_sidebar( 'header-right' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'flex-height'     => true,
	'width'           => 1200,
	'height'          => 100,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

//* redirect directly to the checkout page in woocommerce
add_filter ('woocommerce_add_to_cart_redirect', 'woo_redirect_to_checkout');
function woo_redirect_to_checkout() {
	$checkout_url = WC()->cart->get_checkout_url();
	return $checkout_url;
}

add_theme_support( 'genesis-connect-woocommerce' );

/** * Set cart item quantity action *
 * Only works for simple products (with integer IDs, no colors etc) *
 * @access public
 * @return void */
function woocommerce_set_cart_qty_action() { 
  global $woocommerce;
  foreach ($_REQUEST as $key => $quantity) {
    // only allow integer quantities
    if (! is_numeric($quantity)) continue;

    // attempt to extract product ID from query string key
    $update_directive_bits = preg_split('/^set-cart-qty_/', $key);
    if (count($update_directive_bits) >= 2 and is_numeric($update_directive_bits[1])) {
      $product_id = (int) $update_directive_bits[1]; 
      $cart_id = $woocommerce->cart->generate_cart_id($product_id);
      // See if this product and its options is already in the cart
      $cart_item_key = $woocommerce->cart->find_product_in_cart( $cart_id ); 
      // If cart_item_key is set, the item is already in the cart
      if ( $cart_item_key ) {
        $woocommerce->cart->set_quantity($cart_item_key, $quantity);
      } else {
        // Add the product to the cart 
        $woocommerce->cart->add_to_cart($product_id, $quantity);
      }
    }
  }
}

add_action( 'init', 'woocommerce_set_cart_qty_action' );

//* Setup widget counts
function congregation_count_widgets( $id ) {
	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

function congregation_widget_area_class( $id ) {
	$count = congregation_count_widgets( $id );

	$class = '';
	
	if( $count == 1 ) {
		$class .= ' widget-full';
	} elseif( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif( $count % 2 == 0 ) {
		$class .= ' widget-half';
	} else {	
		$class .= ' widget-halves';
	}
	return $class;
	
}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-page-1',
	'name'        => __( 'Home Page 1', 'congregation' ),
	'description' => __( 'This is the home page 1 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-2',
	'name'        => __( 'Home Page 2', 'congregation' ),
	'description' => __( 'This is the home page 2 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-3',
	'name'        => __( 'Home Page 3', 'congregation' ),
	'description' => __( 'This is the home page 3 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-4',
	'name'        => __( 'Home Page 4', 'congregation' ),
	'description' => __( 'This is the home page 4 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-5',
	'name'        => __( 'Home Page 5', 'congregation' ),
	'description' => __( 'This is the home page 5 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-6',
	'name'        => __( 'Home Page 6', 'congregation' ),
	'description' => __( 'This is the home page 6 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-7',
	'name'        => __( 'Home Page 7', 'congregation' ),
	'description' => __( 'This is the home page 7 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-8',
	'name'        => __( 'Home Page 8', 'congregation' ),
	'description' => __( 'This is the home page 8 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-9',
	'name'        => __( 'Home Page 9', 'congregation' ),
	'description' => __( 'This is the home page 9 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-10',
	'name'        => __( 'Home Page 10', 'congregation' ),
	'description' => __( 'This is the home page 10 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-11',
	'name'        => __( 'Home Page 11', 'congregation' ),
	'description' => __( 'This is the home page 11 section.', 'congregation' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-page-12',
	'name'        => __( 'Home Page 12', 'congregation' ),
	'description' => __( 'This is the home page 12 section.', 'congregation' ),
) );

// Register members sidebar
genesis_register_sidebar( array(
	'id' => 'members-sidebar',
	'name' => 'Members Sidebar',
	'description' => 'This is the sidebar for members pages.',
) );