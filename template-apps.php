<?php
/**
 * Template Name: Apps Home Page
 * The template for displaying apps.
 *
 * @package LDS Mormon Apps
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>
			
			<?php
			$apps = get_field('apps');
			$apps_count = 0;
			if ( $apps ){ 
				?>
				<h2>Mormon Apps</h2>
				<div class="apps row">
				<?php 
				foreach ( $apps as $post ) {
					setup_postdata( $post );
					$apps_count++;
					
					if ($apps_count%2 == 1 &&
						$apps_count > 2 ) {
						//odd and greater than 2
						?>
							</div>
							<div class="apps row">
						<?php
					}
					?>
					
					<article class="app app_<?php echo $apps_count; ?> medium-6 large-6 columns">
						<header>
							<?php if (get_field('hero_image') ){ ?>
							<a class="app-img" href="<?php the_permalink(); ?>">
								<img class="app-hero" alt="<?php the_title(); ?>" src="<?php the_field('hero_image'); ?>" />
							</a>
							<?php }//endif ?>
						</header>
						<a class="app-link row" href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) { ?>
                			<div class="app-icon small-3 medium-3 large-3 columns">
                				<div class="app-thumbnail-mask"></div>
                					<img class="app-thumbnail" alt="<?php the_title(); ?>" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" />
                			</div>
                			<?php } ?>
							<div class="app-description small-9 medium-9 large-9 columns">
								<h1><?php the_title(); ?></h1>
								<?php the_field('short_description'); ?>
							</div>
						</a>
						<footer class="row">
							<div class="app-links small-9 small-offset-3 medium-9 medium-offset-3 large-12 large-offset-0 columns">
								<div class="row">
								<?php if ( get_field('google_play_link') ) { ?>
									<div class="small-12 medium-12 large-4 columns">
										<a href="<?php the_field('google_play_link'); ?>" class="applink android" target="_blank"><?php the_title(); ?> Get Android app on Google Play</a>
									</div>
								<?php } ?>
								<?php if ( get_field('itunes_store_link') ) { ?>
									<div class="small-12 medium-12 large-4 columns">
										<a href="<?php the_field('itunes_store_link'); ?>?mt=8&at=1001lJ5" class="applink ios" target="_blank"><?php the_title(); ?> Available on the iTunes App Store</a>
									</div>
								<?php } ?>
								<?php if ( get_field('amazon_store_link') ) { ?>
									<div class="small-12 medium-12 large-4 columns">
										<a href="<?php the_field('amazon_store_link'); ?>?tag=circubstu-20" class="applink amazon" target="_blank"><?php the_title(); ?> Available in the Amazon Apps Store</a>
									</div>
								<?php } ?>
								</div>
							</div>
						</footer>
					</article>	
					<?php 
				}
				wp_reset_postdata(); 
				?>
				</div>
				<?php 
			} ?>
			
			
			<?php
			$apps = get_field('apps_other');
			if ( $apps ){ 
				?>
				<h2>More Apps</h2>
				<div class="apps row apps-more">
				<?php 
				foreach ( $apps as $post ) {
					setup_postdata( $post );
					?>
					
					<article class="app medium-6 large-6 columns">
						<header>
							<?php if (get_field('hero_image') ){ ?>
							<div class="app-img">
								<img class="app-hero" alt="<?php the_title(); ?>" src="<?php the_field('hero_image'); ?>" />
							</div>
							<?php }//endif ?>
						</header>
						<a class="app-link row" href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) { ?>
                			<div class="app-icon small-3 medium-3 large-3 columns">
                				<div class="app-thumbnail-mask"></div>
                					<img class="app-thumbnail" alt="<?php the_title(); ?>" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" />
                			</div>
                			<?php } ?>
							<div class="app-description small-9 medium-9 large-9 columns">
								<h1><?php the_title(); ?></h1>
								<?php the_field('short_description'); ?>
							</div>
						</a>
						<footer class="row">
							<div class="app-links small-9 small-offset-3 medium-9 medium-offset-3 large-12 large-offset-0 columns">
								<div class="row">
								<?php if ( get_field('google_play_link') ) { ?>
									<div class="small-12 medium-12 large-4 columns">
										<a href="<?php the_field('google_play_link'); ?>" class="applink android" target="_blank"><?php the_title(); ?> Get Android app on Google Play</a>
									</div>
								<?php } ?>
								<?php if ( get_field('itunes_store_link') ) { ?>
									<div class="small-12 medium-12 large-4 columns">
										<a href="<?php the_field('itunes_store_link'); ?>?mt=8&at=1001lJ5" class="applink ios" target="_blank"><?php the_title(); ?> Available on the iTunes App Store</a>
									</div>
								<?php } ?>
								<?php if ( get_field('amazon_store_link') ) { ?>
									<div class="small-12 medium-12 large-4 columns">
										<a href="<?php the_field('amazon_store_link'); ?>?tag=circubstu-20" class="applink amazon" target="_blank"><?php the_title(); ?> Available in the Amazon Apps Store</a>
									</div>
								<?php } ?>
								</div>
							</div>
						</footer>
					</article>	
					<?php 
				}
				wp_reset_postdata(); 
				?>
				</div>
				<?php 
			} ?>
			
			
			<?php //the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'home-aside' ); ?>
	</div><!-- #secondary -->

<?php get_footer(); ?>
