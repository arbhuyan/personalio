<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package personalio
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( '' !== get_the_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'full' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="article-data">
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php personalio_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				if(is_single()){
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading <span class="screen-reader-text"> "%s"</span>', 'personalio' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links"><span class="page-navigation">' . esc_html__( 'Pages:', 'personalio' ).'</span>',
						'after'  => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>'
					) );
				} else {
					the_excerpt();
				}
				
			?>
		</div><!-- .entry-content -->

		<?php if(!is_singular()): ?>

		<footer class="entry-footer">
			<?php
				printf(
					"%s",
					"<a href='".get_the_permalink()."' class='read-more'>".esc_html__('Read More', 'personalio')." <i class='fa fa-angle-right'></i></a>"
				);
			?>
		</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div> <!-- .article-data -->
</article><!-- #post-<?php the_ID(); ?> -->
