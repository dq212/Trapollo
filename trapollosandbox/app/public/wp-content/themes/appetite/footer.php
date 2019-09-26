<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Appetite
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer lg:th-pt-xl th-py-md" role="contentinfo">
		<div class="container th-stack--base">

			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
            <div class="footer-widget-area th-flex th-flex-wrap th-stack-full--base lg:th-p-base lg:th-pb-lg th-pb-base th-mb-lg">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div><!-- .footer-widget-area -->
            <?php
            endif;

			if ( has_nav_menu( 'social' ) ) :
				get_template_part( 'menu', 'social' );
			endif;
			?>

			<div class="site-copyright th-text-center">
				<?php
                printf( '%1$s %2$s', date('Y'), get_bloginfo('name') );
                appetite_custom_footer_text();
                ?>
			</div><!-- .site-copyright -->

			<div class="site-info th-text-center th-uppercase">
                <?php appetite_footer_output(); ?>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
