<?php
/*
Template Name: Front
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="intro" role="main">
	<div class="fp-intro">

		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
			<div class="entry-content">
				<h2>
					<?php the_title(); ?>
				</h2>
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
				<p><?php the_tags(); ?></p>
			</footer>
		</div>			
	</div>
</section>
<?php endwhile; ?>
<?php do_action( 'foundationpress_after_content' ); ?>

<div class="section-divider">
	<hr />
</div>


<section class="benefits">
	<?php 
	$front_posts = new WP_Query( array( 'posts_per_page' => 2,
										'category_name' => 'front page') );
	if ( $front_posts->have_posts() ) : while ( $front_posts->have_posts() ) : $front_posts->the_post();
		// Loop output goes here
			get_template_part( 'template-parts/content', '' );
		endwhile; 
	endif; ?>
</section>

<?php get_footer();
