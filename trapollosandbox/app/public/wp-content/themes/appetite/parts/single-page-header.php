<?php
/**
 * The part displays a single page header.
 *
 * @package Appetite
 */

// Get a current id of the page outside of the main loop.
$current_id = get_queried_object_id();
?>

<div <?php appetite_primary_header_attrs(); ?>>
	<?php appetite_primary_header_image(); ?>

	<div class="container">
		<?php
		printf( '<h1 class="entry-title">%s</h1>', get_the_title( $current_id ) );

		edit_post_link( 
			esc_html__( 'Edit', 'appetite' ), 
			'<div class="entry-meta"><span class="edit-link">', 
			'</span></div>',
			$current_id 
		);
		?>
	</div><!-- .container -->
</div><!-- #primary-header -->
