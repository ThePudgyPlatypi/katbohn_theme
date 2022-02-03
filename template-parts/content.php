<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- style front page only -->
	<?php if( is_front_page() ) { ?>
		<div class="image-header">
			<figure class="full-width-mobile">
				<?php the_post_thumbnail(); ?>
			</figure>
			<header>
			<?php
				the_title( '<h3 class="entry-title">', '</h1>' );
			?>
			</header>
		</div>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	<?php } else { ?> 
		<header>
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
			<?php foundationpress_entry_meta(); ?>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		<footer>
			<?php
				wp_link_pages(
					array(
						'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ),
						'after'  => '</p></nav>',
					)
				);
			?>
			<?php $tag = get_the_tags(); if ( $tag ) { ?><p><?php the_tags(); ?></p><?php } ?>
		</footer>
	<?php }; ?>
</article>
