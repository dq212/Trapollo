<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Appetite
 */
function appetite_jetpack_setup() {
	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	 add_theme_support( 'infinite-scroll', array(
 		'container' => 'main',
 		'render' => 'appetite_infinite_scroll_render',
 		'footer' => 'page',
 		'footer_widgets' => 'footer-1',
 	) );

	/**
	 * Add support for content options.
	 */
	add_theme_support( 'jetpack-content-options', array(
	    'blog-display' => 'content',
	    'post-details' => array(
	        'stylesheet' => 'appetite-style',
	        'date' => '.posted-on',
	        'categories' => '.cat-links',
	        'tags' => '.tags-links',
	        'author' => '.byline',
	        'comment' => '.comments-link',
	    ),
	) );

	/**
	 * Add site logo support.
	 */
	add_theme_support( 'site-logo', array( 'size' => 'large' ) );

	/**
 	 * Add support for Testimonial Post Type.
     */
    add_theme_support( 'jetpack-testimonial' );

    /**
 	 * Add responsive videos support.
     */
	add_theme_support( 'jetpack-responsive-videos' );

	/**
	 * Add support for the Nova CPT (menu items).
	 */
	if ( apply_filters( 'appetite_is_jetpack_nova_cpt', true ) ) {
		add_theme_support( 'nova_menu_item' );
	}

	/**
	 * Add support for featured content.
	 */
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'appetite_featured_posts',
		'max_posts' => 8,
		'post_types' => array( 'post', 'page' )
	) );
}
add_action( 'after_setup_theme', 'appetite_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function appetite_infinite_scroll_render() {
	if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', 'testimonial' );
		}
	} else {
		if ( is_search() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', 'search' );
			}
		} else {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}
		}
	}
} // end function appetite_infinite_scroll_render

/**
 * Exclude specific images from lazy loading.
 */
function appetite_jetpack_exclude_class_from_lazy_load( $classes ) {
	$classes[] = 'site-logo';

    return $classes;
}
add_filter( 'jetpack_lazy_images_blacklisted_classes', 'appetite_jetpack_exclude_class_from_lazy_load', 999, 1 );

/**
 * Getter function for Featured Content section.
 */
function appetite_get_featured_posts() {
	return apply_filters( 'appetite_featured_posts', array() );
}

/**
 * A helper conditional function that checks if there are featured posts.
 */
function appetite_has_featured_posts( $minimum = 1 ) {
    if ( is_paged() ) {
		return false;
	}

    $minimum = absint( $minimum );
	$featured_posts = apply_filters( 'appetite_featured_posts', array() );

    if ( ! is_array( $featured_posts ) ) {
		return false;
	}

    if ( $minimum > count( $featured_posts ) ) {
		return false;
	}

    return true;
}

/**
 * Print Featured Content HTML data tags.
 */
function appetite_featured_content_data_tags() {
	$data = array();
	$attr = array(
		'data-transition-speed' => get_theme_mod( 'appetite_featured_content_transition_speed', '300' ),
		'data-autoplay' => get_theme_mod( 'appetite_is_autoplay_featured_content', '' ),
	);

	$minimum_posts = 2;

	if ( appetite_has_featured_posts( $minimum_posts ) ) {
		$attr['data-is-slideshow'] = true;
	}

	$attr = array_map( 'esc_attr', $attr );

	foreach( $attr as $key => $value ) {
		if ( $value ) {
			$data[] = $key . '=' . $value;
		}
	}

	printf( '%s', join( ' ', $data ) ); // WPCS: XSS OK.
}
