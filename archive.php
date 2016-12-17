<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package LDS Mormon Apps
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				
				<?php if ( is_tax('developers') ) { 
					
					$queried_object = get_queried_object(); 
					$taxonomy = $queried_object->taxonomy;
					$term_id = $queried_object->term_id; 
					$website = get_field('website', $taxonomy . '_' . $term_id);
				?>
					<div class="dev-meta">
						<?php if ( get_field('website', $taxonomy . '_' . $term_id) ) { ?>
							<a href="<?php echo $website; ?>" target="_blank">Website <?php echo $website; ?></a>
						<?php } ?>
					</div>
				<?php } ?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					if ( 'post' == get_post_type() ) {
						get_template_part( 'content', get_post_format() );
					} else {
						get_template_part( 'content', get_post_type() );
					}
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
