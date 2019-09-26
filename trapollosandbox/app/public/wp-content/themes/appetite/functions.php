<?php
/**
 * Appetite functions and definitions.
 *
 * @package Appetite
 */

// Theme Constants.
define( 'APPETITE_DIR', get_template_directory() );
define( 'APPETITE_DIR_URI', get_template_directory_uri() );

if ( ! function_exists( 'appetite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function appetite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on appetite, use a find and replace
	 * to change 'appetite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'appetite', APPETITE_DIR . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Set the default Post Thumbnail size
	set_post_thumbnail_size( 250, 250, true );

    add_image_size( 'appetite-standard-image', 800, 480, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'appetite' ),
		'social' => esc_html__( 'Social Menu', 'appetite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'appetite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    /*
	 * This theme styles the visual editor to resemble the theme style.
	 */
	add_editor_style( array( 'css/editor-style.css', appetite_google_fonts() ) );

    /*
	 * Enable support for Automatic Updates.
	 */
    add_theme_support( 'themes-harbor-edd-license', array(
        'theme-slug' => 'appetite',
        'download-id' => '200',
    ) );

    /**
     * Load theme updater functions.
     */
    require( APPETITE_DIR . '/inc/updater/theme-updater.php' );

    /**
     * Setup Gutenberg.
     */
     // Add Gutenberg editor styles.
     add_theme_support( 'editor-styles' );

     // Disabling Gutengerg custom font sizes.
     add_theme_support( 'disable-custom-font-sizes' );

     // Add Gutengerg color palette.
     add_theme_support( 'editor-color-palette', array(
         array(
             'name' => esc_html__( 'Green', 'appetite' ),
             'slug' => 'green',
             'color' => '#048448',
         ),
         array(
             'name' => esc_html__( 'Red', 'appetite' ),
             'slug' => 'red',
             'color' => '#dc2d47',
         ),
         array(
             'name' => esc_html__( 'Blue', 'appetite' ),
             'slug' => 'blue',
             'color' => '#3c40c6',
         ),
         array(
             'name' => esc_html__( 'Black', 'appetite' ),
             'slug' => 'black',
             'color' => '#1e272e',
         ),
         array(
             'name' => esc_html__( 'White', 'appetite' ),
             'slug' => 'white',
             'color' => '#ffffff',
         ),
     ) );
}
endif; // appetite_setup
add_action( 'after_setup_theme', 'appetite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function appetite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'appetite_content_width', 750 );
}
add_action( 'after_setup_theme', 'appetite_content_width', 0 );

/**
 * Set the content width for the full width pages.
 */
function appetite_content_full_width() {
	global $content_width;

	if ( is_page_template( 'templates/full-width-page.php' )
		|| is_page_template( 'templates/grid-full-width-page.php' )
		|| is_page_template( 'templates/front-page.php' )
		|| ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1140;
	}
}
add_action( 'template_redirect', 'appetite_content_full_width' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function appetite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'appetite' ),
		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'appetite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title th-uppercase th-text-base th-mb-sm">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'appetite' ),
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'appetite' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s th-w-full th-px-base footer-widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title th-uppercase th-text-base th-mb-sm">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'appetite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function appetite_scripts() {
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'font-awesome', APPETITE_DIR_URI . "/assets/css/font-awesome{$suffix}.css", array(), '4.7.0' );
	wp_enqueue_style( 'appetite-style', APPETITE_DIR_URI . "/style{$suffix}.css", array(), '1.4.2' );
	wp_style_add_data( 'appetite-style', 'rtl', 'replace' );
    wp_style_add_data( 'appetite-style', 'suffix', $suffix );

	wp_enqueue_style( 'appetite-print-style', APPETITE_DIR_URI . "/assets/css/print-style{$suffix}.css", array(), '1.0.0', 'print' );

	if ( is_child_theme() ) {
		wp_enqueue_style( 'appetite-child-style', get_stylesheet_uri(), array( 'appetite-style' ) );
	}

	if ( is_singular() && ! is_page_template( 'templates/front-page.php' ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_page_template( 'templates/front-page.php' ) ) {
		wp_enqueue_script( 'bxslider', APPETITE_DIR_URI . "/assets/js/public/plugins/jquery.bxslider{$suffix}.js", array( 'jquery' ), '4.1.2', true );
		wp_enqueue_script( 'appetite-front-page-script', APPETITE_DIR_URI . "/assets/js/public/pages/front-page{$suffix}.js", array( 'bxslider' ), '1.0.1', true );
	}

	wp_enqueue_script( 'appetite-script', APPETITE_DIR_URI . "/assets/js/public/appetite{$suffix}.js", array( 'jquery' ), '1.3.3', true );
}
add_action( 'wp_enqueue_scripts', 'appetite_scripts' );

/**
 * Set a custom excerpt length.
 */
function appetite_get_excerpt_length() {
 	return 20;
}
add_filter( 'excerpt_length', 'appetite_get_excerpt_length', 999 );

/**
 *	Add div container to the post's "more" link.
 */
function appetite_more_link_container( $link ) {
	// Removes the anchor from the permalinks.
	$link = preg_replace( '/#more\-\d+/', '', $link );

	return sprintf( '<div class="more-link-container">%s</div>', $link );
}
add_filter( 'the_content_more_link', 'appetite_more_link_container' );

/**
 *	Customize excerpts more tag
 */
function appetite_excerpt_more( $more ) {
	if ( ! is_search() ) {
		$post_id = get_the_ID();

 		return sprintf( '&#x2026; <div class="more-link-container"><a href="%1$s" class="more-link">%2$s</a></div>',
 			  esc_url( get_permalink( $post_id ) ),
 			  sprintf( esc_html__( 'Read More %s', 'appetite' ), '<span class="screen-reader-text">' . get_the_title( $post_id ) . '</span>' )
 		);
	}
}
add_filter( 'excerpt_more', 'appetite_excerpt_more' );

/**
 *	Flush rewrite rules for CPTs on setup and switch
 */
function appetite_flush_rewrite_rules() {
	flush_rewrite_rules(); // WPCS: XSS OK.
}
add_action( 'after_switch_theme', 'appetite_flush_rewrite_rules' );

/**
 * Register the required plugins for this theme.
 */
function appetite_register_required_plugins() {
	$plugins = array(
		array(
			'name' => 'Jetpack by WordPress.com',
			'slug' => 'jetpack',
			'required' => false,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 */
	$config = array(
		'id'           => 'appetite',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'appetite_register_required_plugins' );

/**
 * Implement the Custom Header feature.
 */
require APPETITE_DIR . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require APPETITE_DIR . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require APPETITE_DIR . '/inc/extras.php';

/**
 * Customizer additions.
 */
require APPETITE_DIR . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require APPETITE_DIR . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require APPETITE_DIR . '/inc/woocommerce.php';
}

/**
 * Load WordPress.org compatibility file.
 */
require APPETITE_DIR . '/inc/org-features/wporg.php';

/**
 *  Load typography functionality.
 */
require APPETITE_DIR . '/inc/typography/typography.php';

/**
 *  Include the TGM_Plugin_Activation class.
 */
require APPETITE_DIR . '/inc/class-tgm-plugin-activation.php';