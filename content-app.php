<?php
/**
 * @package LDS Mormon Apps
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<a class="app-link row" href="<?php echo get_the_permalink($app->ID); ?>">
			<div class="row">
				<div class="app-title small-12 columns">
					<div class="app-icon">
						<div class="app-thumbnail-mask"></div>
						<?php if ( has_post_thumbnail() ) { ?>
							<img class="app-thumbnail" alt="<?php the_title(); ?>" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" />
						<?php } ?>
					</div>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
			</div>
			<div class="row">
				<h2 class="app-short-description small-12 columns"><?php the_field('short_description'); ?></h2>
			</div>
		</a>
		
		<div class="entry-meta">
			<?php //ldsmormonapps_posted_on(); 
				echo get_the_term_list( $post->ID, 'markets', '<strong>Market:</strong> ', ', ', '. ' );
				echo get_the_term_list( $post->ID, 'price', '<strong>Price:</strong> ', ', ', '. ' );
				echo get_the_term_list( $post->ID, 'developers', '<strong>Developer:</strong> ', ', ', '. ' );
			?>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->

	<div class="entry-content ">
				
			<?php //screenshot gallery
			$images = get_field('screenshots');
			if( $images ) { ?>
			    <div class="screenshots row large-collapse medium-collapse flickity-gallery">
			        <?php foreach( $images as $image ) { ?>
			            <!-- <div class="small-12 medium-4 large-2 columns"> -->
			                <img class="flickity-img flickity-item" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
			            <!-- </div> -->
			        <?php } //endforeach; ?>
			    </div>
			<?php } //endif; ?>
			
			<div class="row">
				<div class="app-links small-8 small-centered medium-12 large-12 columns">
					<div class="row">
					<?php if ( get_field('google_play_link') ) { ?>
						<div class="small-12 medium-4 large-4 columns">
							<a href="<?php the_field('google_play_link'); ?>" class="applink android" 
							onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('google_play_link'); ?>', '<?php the_title(); ?>');" 
							target="_blank"><?php the_title(); ?> Get Android app on Google Play</a>
						</div>
					<?php } ?>
					<?php if ( get_field('itunes_store_link') ) { ?>
						<div class="small-12 medium-4 large-4 columns">
							<a href="<?php the_field('itunes_store_link'); ?>?mt=8&at=1001lJ5" class="applink ios" 
							onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('itunes_store_link'); ?>', '<?php the_title(); ?>');" 
							target="_blank"><?php the_title(); ?> Available on the iTunes App Store</a>
						</div>
					<?php } ?>
					<?php if ( get_field('amazon_store_link') ) { ?>
						<div class="small-12 medium-4 large-4 columns">
							<a href="<?php the_field('amazon_store_link'); ?>?tag=circubstu-20" class="applink amazon" 
							onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('amazon_store_link'); ?>', '<?php the_title(); ?>');" 
							target="_blank"><?php the_title(); ?> Available in the Amazon Apps Store</a>
						</div>
					<?php } ?>
					<?php if ( get_field('windows_store_link') ) { ?>
						<div class="small-12 medium-4 large-4 columns">
							<a href="<?php the_field('windows_store_link'); ?>" class="applink windows" 
							onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('windows_store_link'); ?>', '<?php the_title(); ?>');" 
							target="_blank"><?php the_title(); ?> Available in the Windows Store</a>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
	</div><!-- .entry-content -->
	
	
	<footer class="entry-footer row">
		<?php ldsmormonapps_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->