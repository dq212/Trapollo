<?php
/**
 * The template used for displaying menu content in menu-page.php
 *
 * @package Appetite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="clearfix">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumb alignleft">
			<?php the_post_thumbnail(); ?>
		</div><!-- .entry-thumb -->
		<?php endif; ?>

		<div class="frame">
			<header class="entry-header clearfix">
				<span class="menu-price"><?php echo esc_html( get_post_meta( get_the_ID(), 'nova_price', true ) ); ?></span>
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
                <?php 
                the_content();

				$terms = get_the_terms( get_the_ID(), 'nova_menu_item_label' );
				if ( $terms && ! is_wp_error( $terms ) ) :
                ?>
				<div class="entry-meta">
                    <?php 
                    foreach ( $terms as $term ) :
                        printf(
                            '<span class="%1$s">%2$s</span>',
                            esc_attr( $term->slug ),
                            esc_html( $term->name )
                        );
                    endforeach;
                    ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</div><!-- .entry-content -->
		</div><!-- .frame -->
	</div><!-- .clearfix -->
</article><!-- #post-## -->