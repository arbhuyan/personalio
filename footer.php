<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package personalio
 */

?>
		</div> <!-- .site-wrapper -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php
			if ( is_active_sidebar( 'sidebar-2' ) ) {
				echo'<section class="site-footer-top">
					<div class="site-wrapper">';
				
					dynamic_sidebar( 'sidebar-2' );

				echo'</div> <!-- .site-wrapper -->
				</section> <!-- .footer-top -->
				';
			}
		?>

		<div class="site-footer-info">
			<div class="site-wrapper">
				<?php personalio_call_theme_footer(); ?>
			</div> <!-- .site-wrapper -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
