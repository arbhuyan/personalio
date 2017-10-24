<?php
/**
 * personalio Theme Customizer
 *
 * @package personalio
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function personalio_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'personalio_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'personalio_customize_partial_blogdescription',
		) );
	}

	/* Primary Navigation color */
	$wp_customize->add_setting( 'nav_text_color',
		array(
			'default' 			=> '#888',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'nav_text_color',
		array(
			'label'    => __( 'Primary Menu Color', 'personalio' ), 
			'section'  => 'colors',
			'settings' => 'nav_text_color',
			'priority' => 10,
		) 
	));

	/* Primary Navigation hover background color */
	$wp_customize->add_setting( 'nav_hover_bg_color',
		array(
			'default' 			=> '#111111',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'nav_hover_bg_color',
		array(
			'label'    => __( 'Primary Menu Hover Background', 'personalio' ), 
			'section'  => 'colors',
			'settings' => 'nav_hover_bg_color',
			'priority' => 10,
		) 
	));

	/* Primary Navigation hover color */
	$wp_customize->add_setting( 'nav_hover_color',
		array(
			'default' 			=> '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'nav_hover_color',
		array(
			'label'    => __( 'Primary Menu Hover Color', 'personalio' ), 
			'section'  => 'colors',
			'settings' => 'nav_hover_color',
			'priority' => 10,
		) 
	));

	/* Site text color */
	$wp_customize->add_setting( 'site_text_color',
		array(
			'default' 			=> '#444',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'site_text_color',
		array(
			'label'    => __( 'Site text color', 'personalio' ), 
			'section'  => 'colors',
			'settings' => 'site_text_color',
			'priority' => 10,
		) 
	));

	/* Site link color */
	$wp_customize->add_setting( 'site_link_color',
		array(
			'default' 			=> '#9a9c9e',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'site_link_color',
		array(
			'label'    => __( 'Site link color', 'personalio' ), 
			'section'  => 'colors',
			'settings' => 'site_link_color',
			'priority' => 10,
		) 
	));
}
add_action( 'customize_register', 'personalio_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function personalio_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function personalio_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function personalio_customize_preview_js() {
	wp_enqueue_script( 'personalio-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'personalio_customize_preview_js' );

/*
*	Save customizer settings
*/
function personalio_dynamic_css() {
	?>
	<style type='text/css'>
		.site-header, .site-footer, .main-navigation ul ul {
			background: linear-gradient(to right top, rgba(8, 8, 8, 0.75), rgba(8, 8, 8, 0.75)), #444 url('<?php echo get_header_image();?>') no-repeat fixed top center / cover;
		}
		
		.main-navigation a {
			<?php $navbg = (get_theme_mod('nav_text_color')) ? esc_attr(get_theme_mod('nav_text_color')) : '#999'; ?>
			color: <?php echo $navbg; ?> ;
			border-color: <?php echo $navbg; ?> ;
		}

		.main-navigation a:hover {
			<?php $hoverbg = (get_theme_mod('nav_hover_color')) ? esc_attr(get_theme_mod('nav_hover_color')) : '#ddd'; ?>
			color: <?php echo $hoverbg; ?>;
		}

		.main-navigation ul ul ul,
		.main-navigation li:hover > a,
		.main-navigation li.focus > a,
		.main-navigation ul ul :hover > a,
		.main-navigation ul ul .focus > a,
		.main-navigation ul ul a:hover,
		.main-navigation ul ul a.focus {
			<?php $navbg = (get_theme_mod('nav_hover_bg_color')) ? esc_attr(get_theme_mod('nav_hover_bg_color')) : '#111'; ?>
			background: <?php echo $navbg;?>;
		}

		.site-content {
			<?php $content_text = (get_theme_mod('site_text_color')) ? esc_attr(get_theme_mod('site_text_color')) : '#444'; ?>
			color: <?php echo $content_text; ?> ;
		}

		.site-content a,
		.entry-title a,
		.comment .edit-link a,
		.widget li a,
		.widget-area .widget-title::first-letter,
		.development-info a {
			<?php $content_link = (get_theme_mod('site_link_color')) ? esc_attr(get_theme_mod('site_link_color')) : '#2a88d8'; ?>
			color: <?php echo $content_link; ?> ;
		}

		.read-more,
		.page-links a > span,
		.search-input {
			background: <?php echo $content_link; ?>;
		}

		.page-links a > span {
			background: <?php echo $content_link; ?> !important;
		}
	</style>
	<?php
}
add_action( 'wp_head' , 'personalio_dynamic_css' );