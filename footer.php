<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package LDS Mormon Apps
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer row" role="contentinfo">
		<div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'footer-aside' ); ?>
		</div><!-- #secondary -->
		<div class="site-info small-12 columns">
			&copy; <?php echo date('Y'); ?> LDS Mormon Apps
			<?php //printf( __( 'Theme: %1$s by %2$s.', 'ldsmormonapps' ), 'LDS Mormon Apps', '<a href="http://circlecube.com" rel="designer">Evan Mullins</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
