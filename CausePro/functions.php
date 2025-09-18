<?php
/**
 * CausePro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CausePro
 */

if ( ! defined( 'CAUSEPRO_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'CAUSEPRO_VERSION', '1.0.0' );
}

if ( ! function_exists( 'causepro_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function causepro_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CausePro, use a find and replace
		 * to change 'causepro' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'causepro', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'causepro' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'causepro_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'causepro_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function causepro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'causepro_content_width', 640 );
}
add_action( 'after_setup_theme', 'causepro_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function causepro_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'causepro' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'causepro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
    register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'causepro' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'causepro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
    register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'causepro' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'causepro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'causepro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function causepro_scripts() {
	// Main theme stylesheet
	wp_enqueue_style( 'causepro-style', get_stylesheet_uri(), array(), CAUSEPRO_VERSION );

	// Custom theme styles
	wp_enqueue_style( 'causepro-main-style', get_template_directory_uri() . '/assets/css/main.css', array('causepro-style'), CAUSEPRO_VERSION );

	// Dashicons for icons
	wp_enqueue_style( 'dashicons' );

	// Main theme script
	wp_enqueue_script( 'causepro-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), CAUSEPRO_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'causepro_scripts' );

// Requiring the customizer, post types, etc. will go here.

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
