<?php
/**
 * The template for displaying the Featured Content section.
 *
 * @package appetite
 */

$featured_posts = appetite_get_featured_posts();
?>

<div id="primary-header">
	<div id="featured-content-bg" class="featured-image"></div><!-- .featured-image -->

	<div id="featured-content" class="featured-content" <?php appetite_featured_content_data_tags(); ?>>
	<?php
	foreach ( (array) $featured_posts as $order => $post ) :
		setup_postdata( $post );
		get_template_part( 'parts/hero-slideshow' );
	endforeach;

	wp_reset_postdata();
	?>
	</div><!-- .featured-content -->
</div><!-- #primary-header -->
