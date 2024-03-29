<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Appetite
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses appetite_header_style()
 * @uses appetite_admin_header_style()
 * @uses appetite_admin_header_image()
 */
function appetite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'appetite_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'header-text'            => true,
		'width'                  => 1280,
		'height'                 => 853,
		'flex-height'            => true,
		'wp-head-callback'       => 'appetite_header_style',
		'admin-head-callback'    => 'appetite_admin_header_style',
		'admin-preview-callback' => 'appetite_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'appetite_custom_header_setup' );

if ( ! function_exists( 'appetite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see appetite_custom_header_setup().
 */
function appetite_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( get_theme_support( 'custom-header', 'default-text-color' ) == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // appetite_header_style

if ( ! function_exists( 'appetite_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see appetite_custom_header_setup().
 */
function appetite_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
	</style>
<?php
}
endif; // appetite_admin_header_style

if ( ! function_exists( 'appetite_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see appetite_custom_header_setup().
 */
function appetite_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // appetite_admin_header_image
