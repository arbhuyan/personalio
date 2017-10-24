<?php
/**
 * personalio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package personalio
 */

if ( ! function_exists( 'personalio_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function personalio_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on personalio, use a find and replace
		 * to change 'personalio' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'personalio', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'personalio' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'personalio_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'personalio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function personalio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'personalio_content_width', 640 );
}
add_action( 'after_setup_theme', 'personalio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function personalio_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'personalio' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'personalio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'personalio' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add your copyright info here.', 'personalio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'personalio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function personalio_scripts() {

	// theme styles
	wp_enqueue_style( 'personalio-style', get_stylesheet_uri() );

	// font awesome
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css' );

	// google fonts
	wp_register_style('google-font', 'https://fonts.googleapis.com/css?family=Open+Sans|Philosopher', array(), null, 'all');
	wp_enqueue_style('google-font');

	// navigation
	wp_enqueue_script( 'personalio-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20170811', true );

	// skip link focus fix
	wp_enqueue_script( 'personalio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20170811', true );

	// enable comment reply without loading page
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'personalio_scripts' );

if(!function_exists('personalio_search_form')){
	/**
	 * Generate custom search form
	 *
	 * @param string $form Form HTML.
	 * @return string Modified form HTML.
	*/
	function personalio_search_form( $form ) {
	    $form = '
		    <form role="search" method="get" id="search-form" class="search-form" action="' . home_url( '/' ) . '" >
			    <div class="search-input">
				    <label class="screen-reader-text" for="s">' . __( 'Search for:', 'personalio' ) . '</label>
				    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder = "'.__( 'Search ...', 'personalio' ).'"/>
				    <button type="submit" id="search-submit" value="'. __('Search', 'personalio') .'">
				    	<i class="fa fa-search"></i>
				    </button>
			    </div>
		    </form>
		';
	 
	    return $form;
	}
	add_filter( 'get_search_form', 'personalio_search_form' );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
