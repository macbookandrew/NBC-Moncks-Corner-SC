<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/church-photo.png" alt="Photo of Northside Baptist Church" title="Northside Baptist Church | Moncks Corner, SC" width="100%" />
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info">
				<?php do_action( 'twentythirteen_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentythirteen' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentythirteen' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentythirteen' ), 'WordPress' ); ?></a> | &copy;2012&ndash;<?php echo date('Y'); ?> | Designed by <a href="http://andrewrminion.com/" title="AndrewRMinion Design">AndrewRMinion Design</a> | Maintained by Northside Baptist Church
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>
