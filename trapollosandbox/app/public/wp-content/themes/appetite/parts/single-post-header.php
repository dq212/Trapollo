<?php
/**
 * The part displays a single post header.
 *
 * @package Appetite
 */

// Get a current id of the page outside of the main loop.
$current_id = get_queried_object_id();
// Get a current post type.
$current_post_type = get_post_type( $current_id );
?>

<div <?php appetite_primary_header_attrs(); ?>>
	<?php appetite_primary_header_image(); ?>

	<div class="container">
		<?php
		if ( 'post' === $current_post_type ) {
			printf( '<div class="entry-cats cat-links has-icon">%s</div>', get_the_category_list( '<span class="sep">/</span>', '', $current_id ) );
		}
		
		printf( '<h1 class="entry-title">%s</h1>', get_the_title( $current_id ) );
		
		if ( 'post' === $current_post_type ) :
		?>
		<div class="entry-meta">
			<?php
			appetite_posted_on( $current_id );

			if ( ! post_password_required( $current_id ) && ( comments_open( $current_id ) || get_comments_number( $current_id ) ) ) {
				echo '<span class="comments-link has-icon">';
				comments_popup_link( esc_html__( 'Leave a comment', 'appetite' ), esc_html__( '1 Comment', 'appetite' ), esc_html__( '% Comments', 'appetite' ) );
				echo '</span>';
			}

			edit_post_link( 
				esc_html__( 'Edit', 'appetite' ),
				'<span class="edit-link">',
				'</span>',
				$current_id
			);
			?>
		</div><!-- .entry-meta -->
		<?php
		else :

			edit_post_link( 
				esc_html__( 'Edit', 'appetite' ), 
				'<div class="entry-meta"><span class="edit-link">',
				'</span></div>',
				$current_id
			);

		endif;
		?>
	</div><!-- .container -->
</div><!-- #primary-header -->
