<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Appetite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'appetite' ); ?></a>

	<div id="toggle-sidebar" class="toggle-sidebar th-hidden" aria-hidden="true">
		<div class="inner-panel th-stack--base th-p-base">
			<button id="close-toggle-sidebar" class="toggle-sidebar-close primary-font has-icon clean-button th-block th-text-center th-w-full" type="button">
				<?php esc_html_e( 'Close', 'appetite' ); ?>
			</button><!-- .toggle-sidebar-close -->

			<?php echo get_search_form(); ?>

			<nav id="mobile-navigation" class="site-menu mobile-navigation lg:th-hidden th-block" role="navigation"></nav>

            <?php
            if ( has_nav_menu( 'social' ) ) :
			    get_template_part( 'menu', 'social' );
            endif;
            ?>
		</div><!-- .inner-panel -->
	</div><!-- #toggle-sidebar -->

	<header id="masthead" class="site-header primary-font th-flex sm:th-flex-no-wrap th-flex-wrap th-justify-center th-items-start th-p-base" role="banner">
		<div class="site-branding th-stack--sm sm:th-text-align-unset th-text-center sm:th-mb-0 th-mb-base th-w-full">
			<?php
            appetite_the_custom_logo();

			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title th-uppercase th-font-normal th-text-xl th-mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title th-uppercase th-text-xl th-mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description th-text-base th-font-normal th-hidden th-mb-0"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif;
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="site-menu main-navigation th-uppercase lg:th-block th-hidden th-w-full" role="navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class' => 'menu th-flex th-flex-wrap th-justify-end'
				)
			);
			?>
		</nav><!-- #site-navigation -->

		<?php
		if ( function_exists( 'appetite_woocommerce_cart_link' ) ) :
			appetite_woocommerce_cart_link();
		endif;
		?>

		<button id="sidebar-button" class="toggle-sidebar-button has-icon clean-button th-uppercase th-flex lg:th-ml-sm" type="button" aria-expanded="false">
			<span class="screen-reader-text header-search"><?php esc_html_e( 'Search', 'appetite' ); ?></span>
            <span class="header-menu lg:th-hidden th-block"><?php esc_html_e( 'Menu', 'appetite' ); ?></span>
		</button><!-- .toggle-sidebar-button -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
