<?php
/**
 * jeodotheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package jeodotheme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jeodotheme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on jeodotheme, use a find and replace
		* to change 'jeodotheme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'jeodotheme', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'jeodotheme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'jeodotheme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'jeodotheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jeodotheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jeodotheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'jeodotheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jeodotheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'jeodotheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'jeodotheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'jeodotheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jeodotheme_scripts() {
	wp_enqueue_style( 'jeodotheme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'jeodotheme-style', 'rtl', 'replace' );

	// Enqueue header styles
	wp_enqueue_style( 'header-style', get_template_directory_uri() . '/styles/header.css', array(), _S_VERSION );

	// Enqueue footer styles
	wp_enqueue_style( 'footer-style', get_template_directory_uri() . '/styles/footer.css', array(), _S_VERSION );
	
	// Enqueue news layout styles
	wp_enqueue_style( 'news-layout-style', get_template_directory_uri() . '/styles/news-layout.css', array(), _S_VERSION );

	wp_enqueue_script( 'jeodotheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	// Enqueue header script
	wp_enqueue_script( 'header-script', get_template_directory_uri() . '/js/header.js', array('jquery'), _S_VERSION, true );
	
	// Enqueue AJAX pagination script (only on home page)
	if ( is_home() || is_front_page() ) {
		wp_enqueue_script( 'ajax-pagination', get_template_directory_uri() . '/js/ajax-pagination.js', array('jquery'), _S_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jeodotheme_scripts' );

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

/**
 * Set posts per page for main blog page
 */
function jeodotheme_posts_per_page( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_home() ) {
        $query->set( 'posts_per_page', 2 );
    }
}
add_action( 'pre_get_posts', 'jeodotheme_posts_per_page' );

// Add this to functions.php
function jeodo_news_setup() {
    // Register the menu location
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary Menu', 'jeodo-news' ),
        )
    );
}
add_action( 'after_setup_theme', 'jeodo_news_setup' );

function jeodo_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1 (Contact/Social)', 'jeodotheme' ),
        'id'            => 'footer-col-1',
        'description'   => esc_html__( 'Add widgets here for the first column.', 'jeodotheme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    // You can register more sidebars for Column 2 and 3 if needed, but menus are better for links.
}
add_action( 'widgets_init', 'jeodo_widgets_init' );

function jeodo_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'jeodo_footer_copyright', array(
        'default'   => '© 사용 내역 및 실',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'jeodo_footer_copyright_control', array(
        'label'    => __( 'Footer Copyright Text', 'jeodotheme' ),
        'section'  => 'title_tagline', // Placing in Site Identity for simplicity
        'settings' => 'jeodo_footer_copyright',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'jeodo_customize_register' );