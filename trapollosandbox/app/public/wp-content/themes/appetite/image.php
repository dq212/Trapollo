<?php
/**
 * The Template for displaying a single attachment.
 *
 * @package Appetite
 */

get_header();

get_template_part( 'parts/single', 'attachment-header' );
?>

<div class="container">
    <div class="row">
        <div id="primary" class="content-area <?php echo esc_attr( appetite_get_blog_primary_class() ); ?>">
            <main id="main" class="site-main" role="main">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'content', 'attachment' );

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile;
				?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- .row -->
</div><!-- .container -->

<?php
get_footer();
