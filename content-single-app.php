<?php
/**
 * @package LDS Mormon Apps
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
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
			    	<?php if (get_field('video') ) { ?>
				    	<!-- <div class="small-12 medium-4 large-2 columns"> -->
				    	<div class="flickity-vid flickity-item">
					    	<div class="embed-container">
					    		<?php 
					    		// get iframe HTML
					    		$iframe = get_field('video');

					    		// use preg_match to find iframe src
					    		preg_match('/src="(.+?)"/', $iframe, $matches);
					    		$src = $matches[1];

					    		// add extra params to iframe src
					    		$params = array(
					    		    'controls'  => 1,
					    		    'hd'        => 1,
					    		    'autohide'  => 1,
					    		    'rel'    	=> 0
					    		);

					    		$new_src = add_query_arg($params, $src);
					    		$iframe = str_replace($src, $new_src, $iframe);
					    		$iframe = str_replace('576', '169', $iframe);
					    		$iframe = str_replace('432', '300', $iframe);

					    		// add extra attributes to iframe html
					    		$attributes = 'frameborder="0"';
					    		$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

					    		// echo $iframe
					    		echo $iframe;
					    		?>
					    	</div>
				    	</div>
				    	<!-- </div> -->
			    	<?php } //end video if ?>
			    	
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
			
			<div class="content-body">
				<?php the_content(); ?>
			</div>
		
			<?php if( have_rows('reviews') ) { ?>
				<h2>Reviews</h2>
				<dl class="reviews row">
				<?php while ( have_rows('reviews') ) {
			    	the_row();
			    	?>
			    	<div class="small-12 medium-6 large-4 columns">
				    	<dt><?php the_sub_field('name'); ?> - <?php the_sub_field('rating'); ?></dt>
				    	<dd><?php the_sub_field('review_text'); ?></dd>
			    	</div>
			    <?php } ?>
			    </dl>
			<?php }	?>
			
			<div class="app-long-description row">
				<div class="small-12 columns">
					<?php if (get_field('hero_image') ){ ?>
						<img class="app-hero-inline alignleft" alt="<?php the_title(); ?>" src="<?php the_field('hero_image'); ?>" />
					<?php }//endif ?>
					<?php the_field('long_description'); ?>
				</div>
			</div>
			
			<?php if( have_rows('version_history') ) { ?>
				<h2>Version History</h2>
				<dl class="version_history">
			 	<?php while ( have_rows('version_history') ) {
			    	the_row();
			    	?>
					<dt><?php the_sub_field('version'); ?> - <?php if ( get_sub_field('date') ) { the_sub_field('date'); } else { echo 'Coming soon!'; } ?></dt>
					<dd><?php the_sub_field('notes'); ?></dd>
					<?php
			    } ?>
			    </dl>
			<?php }	?>

	</div><!-- .entry-content -->

	<footer class="entry-footer row">
	
		<?php //only show footer links if there is other content after the last row of store buttons
		if ( 
			 have_rows('reviews') ||
			 have_rows('version_history') || 
			 get_field('hero_image') ||
			 get_field('long_description') != '' ) { ?>		
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
		</div>
		<?php } ?>
		<?php ldsmormonapps_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->