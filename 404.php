<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package personalio
 */

get_header(); ?>

	<div id="primary" class="content-area full-width-content">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<div class="article-data">
					<header class="page-header">
						<h1 class="page-title text-center"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'personalio' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p class="text-center"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'personalio' ); ?></p>

						<?php
							get_search_form();

							the_widget( 'WP_Widget_Recent_Posts' );
						?>

					</div><!-- .page-content -->
				</div> <!-- .article-data -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
