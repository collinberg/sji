<?php
//SJI Theme Functions

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.2.72' );
}

if ( ! function_exists( 'sji_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sji_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on SJI Theme, use a find and replace
		 * to change 'sji_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sji_theme', get_template_directory() . '/languages' );

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
endif;

add_action( 'after_setup_theme', 'sji_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sji_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sji_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'sji_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sji_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sji_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sji_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'sji_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sji_theme_scripts() {
	wp_enqueue_style( 'wp-default-style', get_template_directory_uri() . '/style.css', array(), _S_VERSION );
	wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), _S_VERSION );
    wp_enqueue_style( 'makeway-custom-style', get_template_directory_uri() . '/assets/sass/main.min.css', array(), _S_VERSION );

	//scripts
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.3.slim.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap-min-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'fontawesome-js', 'https://kit.fontawesome.com/5508cb0209.js', array(), '1', true );
    wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'fitvid',  get_template_directory_uri() . '/assets/js/fitvid.js', array('jquery'), _S_VERSION, true );

	//should be last to make sure all libraries are loaded
	wp_enqueue_script( 'cookie-js', get_template_directory_uri() . '/assets/js/js.cookie.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'makeway-custom-scripts-js', get_template_directory_uri() . '/assets/js/scripts.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'filtering-js', get_template_directory_uri() . '/assets/js/filtering.js', array(), _S_VERSION, true );
	if(is_front_page() ):
		wp_enqueue_script( 'home-js', get_template_directory_uri() . '/assets/js/home.js', array('jquery','fitvid'), _S_VERSION, true );
	endif;
}
add_action( 'wp_enqueue_scripts', 'sji_theme_scripts' );

/*
 * 
 * Admin Area Styles
 * 
 */
function sji_admin_style() {
	add_editor_style('/assets/style/admin.css');
}
add_action( 'admin_init', 'sji_admin_style' );



/**
 * Custom Title Function for More Detailed Titles
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sji_title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if(is_tax('tribe_events_cat') ){
          return single_term_title();
        }

        if (is_archive() AND !is_category() AND !is_month() ) {
            return post_type_archive_title();
        }
        if(is_category() or is_month() ){
          return get_the_archive_title();
        }

        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }

        return get_the_title();
    }





//Register Options Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

//Register Nav Menus
if ( ! function_exists( 'sji_theme_register_nav_menu' ) ) {
    function sji_theme_register_nav_menu(){
        register_nav_menus( array(
            'main_menu'  => __( 'Main Menu', 'text_domain' ),
            'popout_menu'  => __( 'Popout Menu', 'text_domain' ),
            'footer_menu'  => __( 'Footer Menu', 'text_domain' ),
        ) );
    }
    add_action( 'after_setup_theme', 'sji_theme_register_nav_menu', 0 );
}

//TinyMCE button format
function add_style_select_button($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'add_style_select_button');

// add custom styles to the WordPress editor
function my_mce_before_init_insert_formats( $init_array ) {
    $style_formats = array(
    // These are the custom styles
    array(
    'title' => 'Asterisk Button',
    'block' => 'span',
    'classes' => 'btn btn--asterisk',
    'wrapper' => true,
    ),
    array(
        'title' => 'Border Button',
        'block' => 'span',
        'classes' => 'btn btn--swipe',
        'wrapper' => true,
        ),
    array(
        'title' => 'Orange Font',
        'block' => 'span',
        'classes' => 'orange--font',
        'wrapper' => true,
    ),
    array(
        'title' => 'Big Heading',
        'block' => 'span',
        'classes' => 'special--big',
        'wrapper' => true,
    ),
	array(
        'title' => 'Larger Body Copy',
        'block' => 'span',
        'classes' => 'body-copy-large',
        'wrapper' => true,
    ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );
    return $init_array;
    }
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );


	
function sji_password_post_filter( $where = '' ) {
    if (!is_single() && !is_admin()) {
        $where .= " AND post_password = ''";
    }
    return $where;
}
add_filter( 'posts_where', 'sji_password_post_filter' );