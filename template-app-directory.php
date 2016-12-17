<?php
/**
 * Template Name: App Directory
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
			// WP_Query arguments
			$directory_args = array (
				'post_type'             => 'app',
				'post_status'           => 'publish',
				'posts_per_page'        => '-1',
				'orderby'               => array('meta_value' => 'DESC', 'title' => 'ASC' ),
				'meta_key'				=> 'screenshots'
			);

			// The Query
			$directory_query = new WP_Query( $directory_args );
			
			
			$apps_count = 0;
			
			// The Loop
			if ( $directory_query->have_posts() ) {
				?>
				<div class="directory-filters">					
					
					<?php 
						$terms = get_terms('markets', array(
						    'orderby'           => 'count', 
						    'order'             => 'DESC',
						    'hide_empty'        => true
						));
					?>
						<div>Markets:
							<ul class="button-group round even-<?php echo count($terms); ?> stack-for-small filter-group filter-markets">
					<?php	
						foreach ( $terms as $term ) { ?>
							<li><a class="filter button" data-filter=".<?php echo 'market_' . $term->slug; ?>" title="Show only <?php echo $term->name; ?> Apps (<?php echo $term->count; ?>)"><?php echo $term->name; ?></a></li>
						<?php }
					?>
							</ul>
						</div>
						
						
					<?php 
						$terms = get_terms('price', array(
						    'orderby'           => 'name', 
						    'order'             => 'ASC',
						    'hide_empty'        => true,
						    'parent'			=> 0
						));
					?>	
						<div>Price:
							<ul class="button-group round even-<?php echo count($terms); ?> stack-for-small filter-group filter-price">
					<?php
						foreach ( $terms as $term ) { ?>
							<li><a class="filter button" data-filter=".<?php echo 'price_' . $term->slug; ?>" title="Show only <?php echo $term->name; ?> Apps (<?php echo $term->count; ?>)"><?php echo $term->name; ?></a>
								<?php 
									$sub_terms = get_terms('price', array(
										'orderby'           => 'name', 
										'order'             => 'ASC',
										'hide_empty'        => true,
										'parent'			=> $term->term_id
									));
									if ( count($sub_terms) > 0) {
										echo '<ul class="button-group secondary round even-' . count($sub_terms) . ' stack-for-small">';
										foreach ($sub_terms as $term ){ ?>
											<li><a class="filter button" data-filter=".<?php echo 'price_' . $term->slug; ?>"><?php echo $term->name; ?></a></li>
										<?php }
										echo '</ul>';
									}
								?>
							</li>
						<?php }
					?>
							</ul>
						</div>
						
						
					<?php 
						$terms = get_terms('developers', array(
						    'orderby'           => 'name', 
						    'order'             => 'ASC',
						    'hide_empty'        => true
						));
					?>
					<div>Developer:
						<select class="filter-group filter-developers" data-selected="all">
							<option class="filter" value=".app">Filter by Developer</option>
					<?php
						foreach ( $terms as $term ) { ?>
							<option class="filter" value=".<?php echo 'developer_' . $term->slug; ?>"><?php echo $term->name; ?> (<?php echo $term->count; ?>)</option>
						<?php }
					?>
							</select>
						</div>
					
					<div>View 
						<select id="option_view" data-selected="normal">
							<option value="expanded">Expanded</option>
							<option value="normal" selected>Normal</option>
							<option value="condensed">Condensed</option>
						</select>
					</div>
				</div>
				<div class="apps-directory">
					<div class="grid-sizer"></div>
					<div class="gutter-sizer"></div>
				<?php 
				while ( $directory_query->have_posts() ) {
					$directory_query->the_post();
					$apps_count++;
					
					$classes = 'app app_' . $apps_count;
					if ( $apps_count % 3 == 0 ) {
						$classes .= ' third';
					}
					if ( $apps_count % 2 == 0 ) {
						$classes .= ' second';
					}
					
					$prices_terms = get_the_terms( $post->ID, 'price' );
					$price_slugs = array();
					foreach ( $prices_terms as $term ) {
						$price_slugs[] = $term->slug;
					}
					$classes .= ' price_' . join( " price_", $price_slugs );
					
					$developers_terms = get_the_terms( $post->ID, 'developers' );
					$developer_slugs = array();
					foreach ( $developers_terms as $term ) {
						$developer_slugs[] = $term->slug;
					}
					$classes .= ' developer_' . join( " developer_", $developer_slugs );
					
					$markets_terms = get_the_terms( $post->ID, 'markets' );
					$market_slugs = array();
					foreach ( $markets_terms as $term ) {
						$market_slugs[] = $term->slug;
					}
					$classes .= ' market_' . join( " market_", $market_slugs );
					
					?>
					<article class="<?php echo $classes; ?> ">
						<?php //if( has_term('evan-mullins', 'developers') ) { ?>
						<a class="app-link row" href="<?php the_permalink(); ?>">
						<?php /*} else { ?>
						<div class="app-link row">
						<?php } */ ?>
							<div class="small-12 columns app-icon-column">
								<div class="app-icon">
									<div class="app-thumbnail-mask"></div>
									<?php if ( has_post_thumbnail() ) { ?>
										<img class="app-thumbnail" alt="<?php the_title(); ?>" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" />
									<?php } ?>
								</div>
							</div>
							<div class="app-description small-12 columns">
								<h1><?php the_title(); ?></h1>
								<?php the_field('short_description'); ?>
							</div>
						<?php //if( has_term('evan-mullins', 'developers') ) { ?>
						</a>
						<?php /*} else { ?>
						</div>
						<?php } */ ?>
						<footer class="row">
							<div class="app-links small-10 small-centered medium-12 columns">
								<div class="row">
								<?php if ( get_field('google_play_link') ) { ?>
									<div class="small-12 medium-4 columns">
										<a href="<?php the_field('google_play_link'); ?>" class="applink android" 
										onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('google_play_link'); ?>', '<?php the_title(); ?>');" 
										target="_blank"><?php the_title(); ?> Get Android app on Google Play</a>
									</div>
								<?php } ?>
								<?php if ( get_field('itunes_store_link') ) { ?>
									<div class="small-12 medium-4 columns end">
										<a href="<?php the_field('itunes_store_link'); ?>?mt=8&at=1001lJ5" class="applink ios" 
										onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('itunes_store_link'); ?>', '<?php the_title(); ?>');" 
										target="_blank"><?php the_title(); ?> Available on the iTunes App Store</a>
									</div>
								<?php } ?>
								<?php if ( get_field('amazon_store_link') ) { ?>
									<div class="small-12 medium-4 columns end">
										<a href="<?php the_field('amazon_store_link'); ?>?tag=circubstu-20" class="applink amazon" 
										onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('amazon_store_link'); ?>', '<?php the_title(); ?>');" 
										target="_blank"><?php the_title(); ?> Available in the Amazon Apps Store</a>
									</div>
								<?php } ?>
								<?php if ( get_field('windows_store_link') ) { ?>
									<div class="small-12 medium-4 columns end">
										<a href="<?php the_field('windows_store_link'); ?>" class="applink windows" 
										onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('windows_store_link'); ?>', '<?php the_title(); ?>');" 
										target="_blank"><?php the_title(); ?> Available in the Windows Store</a>
									</div>
								<?php } ?>
								</div>
							</div>
						</footer>
					</article>
					<?php 
				}
				?>
				</div>
				<?php 
			}
			else {
				//no posts found
				echo 'no apps found';
			} 
			
			wp_reset_postdata(); 
			
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'home-aside' ); ?>
	</div><!-- #secondary -->

<?php get_footer(); ?>
