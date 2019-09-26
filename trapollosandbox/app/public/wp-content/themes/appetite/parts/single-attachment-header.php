<?php
/**
 * The part displays single attachment header.
 *
 * @package Appetite
 */

// Get a current id of the page outside of the main loop.
$current_id = get_queried_object_id();
// Get a current attachment.
$attachment = wp_get_attachment_url( $current_id );
?>

<?php if( $attachment ): ?>
<div id="primary-header" class="has-background">
	<div class="featured-image" style="background-image: url( <?php echo esc_url( $attachment ); ?> );"></div><!-- .featured-image -->
<?php else: ?>
<div id="primary-header">
<?php endif; ?>
	<div class="container">
		<?php printf( '<h1 class="entry-title">%s</h1>', get_the_title( $current_id ) ); ?>

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
	</div><!-- .container -->
</div><!-- #primary-header -->
