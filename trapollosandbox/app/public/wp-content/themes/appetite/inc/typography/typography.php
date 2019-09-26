<?php
/**
 * Typography related functions.
 *
 * @package Appetite
 */

/**
 * Return default fonts
 */
function appetite_get_default_fonts() {
	$fonts = array(
		'System Stack',
		'Arial, Helvetica, sans-serif',
		'Century Gothic, CenturyGothic, AppleGothic, sans-serif',
		'Comic Sans MS, cursive, sans-serif',
		'Helvetica Neue, Helvetica, sans-serif',
		'Impact, Charcoal, sans-serif',
		'Lucida Sans Unicode, Lucida Grande, sans-serif',
		'Segoe UI, Helvetica Neue, Helvetica, sans-serif',
		'Tahoma, Geneva, sans-serif',
		'Trebuchet MS, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif',
		'Georgia, Times New Roman, Times, serif',
		'Palatino Linotype, Book Antiqua, Palatino, serif',
		'Times New Roman, Times, serif',
		'Lucida Console, Monaco, monospace',
		'Courier New, Courier, monospace',
	);

	return apply_filters( 'appetite_typography_default_fonts', $fonts );
}

/**
 * Register Google Fonts.
 */
function appetite_google_fonts() {
	$fonts_url = '';
	$fonts = array();
	$subsets = 'latin,latin-ext,cyrillic,cyrillic-ext';

	$default_fonts = appetite_get_default_fonts();

	$body_font_family = get_theme_mod( 'appetite_typography_body_font_family', 'Lato' );
	$headings_font_family = get_theme_mod( 'appetite_typography_heading_font_family', 'Montserrat' );

	// Google font for body.
	if ( ! in_array( $body_font_family, $default_fonts ) ) {
		$fonts[] = $body_font_family . ':300,300i,400,400i,700,700i';
	}

	// Google font for headings.
	if ( ! in_array( $headings_font_family, $default_fonts ) ) {
		$fonts[] = $headings_font_family . ':300,300i,400,400i,700,700i';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( $subsets ),
            'display' => 'swap',
		), 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue Google Fonts or default fonts.
 */
function appetite_enqueue_theme_fonts() {
	$google_fonts = appetite_google_fonts();

	if ( '' !== $google_fonts ) {
		wp_enqueue_style( 'appetite-google-fonts', $google_fonts, array(), null );
	}

	$font_family_css = "";
	$body_font_family = get_theme_mod( 'appetite_typography_body_font_family', 'Lato' );
	$headings_font_family = get_theme_mod( 'appetite_typography_heading_font_family', 'Montserrat' );

	if ( 'System Stack' === $body_font_family ) {
		$body_font_family = appetite_get_system_font_stack();
	}

	if ( 'System Stack' === $headings_font_family ) {
		$headings_font_family = appetite_get_system_font_stack();
	}

	if ( 'Lato' !== $body_font_family ) {
		$font_family_css .= "body, button, input, select, textarea { font-family: " . $body_font_family . " }";
	}

	if ( 'Montserrat' !== $headings_font_family ) {
		$font_family_css .= "h1, h2, h3, h4, h5, h6, .primary-font { font-family: " . $headings_font_family . " }";
	}

	if ( '' !== $font_family_css ) {
		wp_add_inline_style( 'appetite-style', $font_family_css );
	}

}
add_action( 'wp_enqueue_scripts', 'appetite_enqueue_theme_fonts' );

/**
 * Return System Font Stack.
 */
function appetite_get_system_font_stack() {
	return '-apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"';
}

/**
 * Load typography options.
 */
require APPETITE_DIR . '/inc/typography/customizer.php';