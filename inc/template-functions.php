<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Personalio
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function Personalio_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'Personalio_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function Personalio_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'Personalio_pingback_header' );

if(!function_exists('call_theme_footer')){
	function call_theme_footer() {
		echo'<div class="copyright-info">';
			
			printf( esc_html__( '&copy; %2$s All Rights Reserved by %1$s', 'personalio' ), '<a href="'.esc_url( home_url() ).'">'.get_bloginfo( 'name' ).'</a>', date('Y') );
			
		echo'</div>';

		wp_credits();
	}
}

/**
 * Add credits to WordPress
 */
if(!function_exists('wp_credits')){
	function wp_credits() { ?>
		<div class="development-info">
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( '%1$s Theme by %2$s, ', 'personalio' ), 'Personalio', '<a href="'.esc_url('http://anisbd.com').'">MD. Anisur Rahman Bhuyan</a>' ); ?>

			<a class="wp-credit" href="<?php echo esc_url( __( 'https://wordpress.org/', 'personalio' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'personalio' ), 'WordPress' );
			?></a>
		</div>
<?php
	}
}