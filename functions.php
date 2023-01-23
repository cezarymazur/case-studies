<?php 

/** Content width */

function hmmh_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hmmh_content_width', 750 );
}
add_action( 'after_setup_theme', 'hmmh_content_width', 0 );

/** Theme setup */

function hmmh_setup() {
    /**
     * Add post-formats support.
     */
    add_theme_support(
        'post-formats',
        array(
            'link',
            'aside',
            'gallery',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat',
        )
    );
    /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1568, 9999 );

    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary menu', 'hmmh' ),
            'footer'  => esc_html__( 'Secondary menu', 'hmmh' ),
        )
    );
    /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);
        // Add custom editor font sizes.
}
add_action( 'after_setup_theme', 'hmmh_setup' );

/** Enqueue styles and scripts. */

function hmmh_scripts() {
    wp_enqueue_style( 'main', get_template_directory_uri() . '/dist/css/main.min.css' );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/dist/js/main.min.js' );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'hmmh_scripts' );


// Register new ACF block type

add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'case-study',
            'title'             => __('Case Study'),
            'description'       => __('A custom Case Study block.'),
            'render_template'   => 'template-parts/blocks/case-studys/case-study.php',
            'category'          => 'formatting',
        ));
    }
}

// Acf Fields to Case Study block saved in custom folder

add_filter('acf/settings/load_json', 'custom_acf_json_load_point');
function custom_acf_json_load_point( $paths ) {

    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';

    // return
    return $paths;
}

?>