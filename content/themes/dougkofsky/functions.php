<?php
/**
 * dougkofsky functions and definitions
 *
 * @package dougkofsky
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 1140; /* pixels */

if ( ! function_exists( 'dougkofsky_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function dougkofsky_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on dougkofsky, use a find and replace
	 * to change 'dougkofsky' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'dougkofsky', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'dougkofsky' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'dougkofsky_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // dougkofsky_setup
add_action( 'after_setup_theme', 'dougkofsky_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function dougkofsky_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'dougkofsky' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'dougkofsky_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function dougkofsky_scripts() {
	wp_enqueue_style( 'dougkofsky-style', get_stylesheet_uri() );
	
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null);
	wp_enqueue_script('jquery');
	
	// Set up Modernizr
	wp_enqueue_script( 'dougkofsky-modernizr', get_template_directory_uri() . '/js/vendor/custom.modernizr.js', array(), '20131023' );

	// Set up the foundation JS
	wp_enqueue_script( 'dougkofsky-foundation', get_template_directory_uri() . '/js/foundation/foundation.js', array('jquery'), '20131023', true );
	wp_enqueue_script( 'dougkofsky-foundation-alerts', get_template_directory_uri() . '/js/foundation/foundation.alerts.js', array('jquery'), '20131023', true );
	wp_enqueue_script( 'dougkofsky-foundation-reveal', get_template_directory_uri() . '/js/foundation/foundation.reveal.js', array('jquery'), '20131023', true );	
	wp_enqueue_script( 'dougkofsky-chosen', get_template_directory_uri() . '/js/chosen.jquery.min.js', array('jquery'), '20131023', true );
	wp_enqueue_script( 'dougkofsky-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	if ( is_page_template('page-home.php') ) {
		wp_enqueue_script( 'dougkofsky-panorama', get_template_directory_uri() . '/js/jquery.panorama.min.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'dougkofsky_scripts' );




/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * WooCommerce Compatibility Fix
 */

	// Remove default woocommerce content wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	// Add in wrapper based on theme templates
	add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

	function my_theme_wrapper_start() {
		if (is_single()){
			echo '<div id="primary" class="content-area">';
		    echo '<main id="main" class="site-main" role="main">';
		}
		else {
			echo '<div id="primary" class="content-area row">';
			echo '<main id="main" class="site-main large-12 columns" role="main">';
		}
	  
	}

	function my_theme_wrapper_end() {
	  echo '</div>';
	  echo '</main>';
	}
	
	// Declare theme support for Woo Commerce
	add_theme_support( 'woocommerce' );


/**
 * WooCommerce Hooks
 */
	// Remove Breadcrumb Nav
	remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
	// Remove Read More / Add to Cart Buttons
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	// Remove ordering dropdown
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	// Remove result count
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	// Remove all tabs
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	// Remove Sale Banner
	remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
	// Remove First Price
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	// Remove First Price
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
	
	// Set Max Qty to 3
		// Simple products
		add_filter( 'woocommerce_quantity_input_args', 'jk_woocommerce_quantity_input_args', 10, 2 );
		function jk_woocommerce_quantity_input_args( $args, $product ) {
	    	$args['max_value'] 		= 3; 	// Maximum value
	    	return $args;
		}

		// Variations
		add_filter( 'woocommerce_available_variation', 'jk_woocommerce_available_variation' );
		function jk_woocommerce_available_variation( $args ) {
			$args['max_qty'] = 3; 		// Maximum value (variations)
	    	return $args;
		}

/**
 * Add Prices Next to Variations
 */

add_filter( 'woocommerce_variation_option_name', 'display_price_in_variation_option_name' );

function display_price_in_variation_option_name( $term ) {
global $wpdb, $product;

$result = $wpdb->get_col( "SELECT slug FROM {$wpdb->prefix}terms WHERE name = '$term'" );

$term_slug = ( !empty( $result ) ) ? $result[0] : $term;

$query = "SELECT postmeta.post_id AS product_id
FROM {$wpdb->prefix}postmeta AS postmeta
LEFT JOIN {$wpdb->prefix}posts AS products ON ( products.ID = postmeta.post_id )
WHERE postmeta.meta_key LIKE 'attribute_%'
AND postmeta.meta_value = '$term_slug'
AND products.post_parent = $product->id";

$variation_id = $wpdb->get_col( $query );

$parent = wp_get_post_parent_id( $variation_id[0] );

if ( $parent > 0 ) {
$_product = new WC_Product_Variation( $variation_id[0] );

//this is where you can actually customize how the price is displayed
return $term . ' (' . woocommerce_price( $_product->get_price() ) . ')';
}
return $term;

} 
	