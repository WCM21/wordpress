<?php

if ( ! function_exists( 'wcm_theme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return void
	 * @since Twenty Twenty-One 1.0
	 *
	 */
	function wcm_theme_setup() {
		// Registrerar platser för våra fasta menyer. Visas i temat med wp_nav_menu()
		register_nav_menus(
			[
				'primary' => esc_html__( 'Main navigation', 'wcmtheme' ),
				'footer'  => esc_html__( 'Footer navigation', 'wcmtheme' ),
			]
		);

		/**
		 * Add post-formats support.
		 */
		add_theme_support( 'post-formats', [
			'gallery',
			'image',
			'quote',
			'video',
		] );
		// Add theme support for Automatic Feed Links
		add_theme_support( 'automatic-feed-links' );

		// Add theme support for Featured Images
		add_theme_support( 'post-thumbnails' );

		// Add theme support for Custom Background
		$background_args = [
			'default-color'          => 'FFFFFF',
			'default-image'          => '',
			'default-repeat'         => '',
			'default-position-x'     => '',
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		];
		//add_theme_support( 'custom-background', $background_args );

		// Add theme support for Custom Header
		$header_args = [
			'default-image'      => '',
			'width'              => 0,
			'height'             => 0,
			'flex-width'         => true,
			'flex-height'        => true,
			'uploads'            => true,
			'random-default'     => false,
			'header-text'        => true,
			'default-text-color' => 'Detta är mitt tema',
			'video'              => true,
		];
		add_theme_support( 'custom-header', $header_args );

		// Add theme support for HTML5 Semantic Markup
		add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );

		// Add theme support for document Title tag
		add_theme_support( 'title-tag' );

		// Add theme support for Translation
		//load_theme_textdomain( 'wcmtheme', get_template_directory() . '/language' );

		add_image_size( 'wcm-gallery', '500', '300', true );
	}
}
add_action( 'after_setup_theme', 'wcm_theme_setup' );

/**
 * Här laddar vi in alla våra styles och scripts.
 *
 * @return void
 */
function add_theme_scripts() {
	wp_enqueue_style( 'style', get_theme_file_uri( 'dist/index.css' ), );
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

function social_link_classes( $classes, $item, $args ) {
	if ( 'footer' === $args->theme_location ) {
		$classes[] = "social-link";
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'social_link_classes', 10, 4 );

/**
 * Registrera en Custom Post Type
 * https://developer.wordpress.org/plugins/post-types/
 *
 * Läs mer om funktionen register_post_type och dess argument nedan.
 * https://developer.wordpress.org/reference/functions/register_post_type/
 *
 */
function my_custom_post_type() {
	register_post_type( '', [
		'labels'      => [
			'name'          => __( '' ),
			'singular_name' => __( '' ),
		],
		'public'      => true,
		'has_archive' => true,
		'rewrite'     => [],
		'menu_icon'   => '',
		'supports'    => [],
	] );
}

add_action( 'init', 'my_custom_post_type', );

/**
 * Registrera Custom Taxonomies
 * https://developer.wordpress.org/plugins/taxonomies/
 *
 * Mer information kring funktionen register_taxonomy
 * https://developer.wordpress.org/reference/functions/register_taxonomy/
 */

// Bättre namn på funktionen....
function my_custom_tax() {
	$labels = [
		'name'              => _x( '', 'taxonomy general name' ),
		'singular_name'     => _x( '', 'taxonomy singular name' ),
		// Läs på om och lägg till fler vi behov!
	];
	$args   = [];
	register_taxonomy( '' , [], $args );
}
add_action( 'init', 'my_custom_tax' );

/**
 * Custom Meta Boxes
 *
 * För att jobba med custom innehåll, "formulär fält", på olika post types.
 *
 * Läs och förstår hur de fungerar. Testa gärna att lägga till något manuellt.
 * https://developer.wordpress.org/plugins/metadata/
 *
 * Advanced Custom Fields är ett plugin som vanligen användas för att skapa sådana här meta-fält.
 * https://www.advancedcustomfields.com/
 */
