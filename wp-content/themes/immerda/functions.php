<?php
/***************************************
 *     CREATE GLOBAL VARIABLES
 ***************************************/
define( 'HOME_URI', home_url() );
define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/dist-assets/images' );
define( 'DEV_CSS', THEME_URI . '/dev-assets/css' );
define( 'DEV_JS', THEME_URI . '/dev-assets/js' );
define( 'DIST_CSS', THEME_URI . '/dist-assets/css' );
define( 'DIST_JS', THEME_URI . '/dist-assets/js' );


/***************************************
 * Include helpers (post types, taxonomies, metaboxes etc.)
 ***************************************/


/***************************************
 *  WordPress Theme Support
 ***************************************/
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
add_filter('show_admin_bar', '__return_false');

/***************************************
 * Enqueue scripts and styles.
 ***************************************/
function immerda_scripts() {
	$js_depend = array(
		'jquery'
	);
	wp_enqueue_style( 'immerda-google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap', array() );
	if ( WP_DEBUG ) {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/css/theme.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/js/theme.js' ) );
		wp_enqueue_style( 'immerda-style', DEV_CSS . '/theme.css', array( 'immerda-google-fonts' ), $modificated_css );
		wp_register_script( 'immerda-script', DEV_JS . '/theme.js', $js_depend, $modificated_js, true );
	} else {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/css/theme.min.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/js/theme.min.js' ) );
		wp_enqueue_style( 'immerda-style', DIST_CSS . '/theme.min.css', array( 'immerda-google-fonts' ), $modificated_css );
		wp_register_script( 'immerda-script', DIST_JS . '/theme.min.js', $js_depend, $modificated_js, true );
	}
	$bingo_vars = array(
		'home_url' => HOME_URI,
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'ajax_security' => wp_create_nonce( 'id-security-nonce' )
	);
	wp_localize_script( 'immerda-script', 'id_vars', $bingo_vars );
	wp_enqueue_script( 'immerda-script' );
}
add_action("wp_enqueue_scripts", "immerda_scripts");


/***************************************
 * Add WP-Menu support and register location
 ***************************************/
if ( function_exists('register_nav_menus') ) {
	register_nav_menus(
		array(
			'main' => 'Haupt Navigation',
			'footer' => 'Footer Navigation',
			'social' => 'Social Navigation'
		)
	);
}

/***************************************
 * Remove default Taxonomies
 ***************************************/
function bb_unregister_taxonomy() {
	register_taxonomy('post_tag', array());
	register_taxonomy('category', array());
}
add_action('init', 'bb_unregister_taxonomy');

/***************************************
 * Remove backend Menu Items
 ***************************************/
function bb_remove_menu_items() {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'bb_remove_menu_items', 999 );

/***************************************
 * Gutenberg add Custom Block Categories
 ***************************************/
function id_mario_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'immerda_blocks',
				'title' => __( 'immerda Blocks', 'immerda_blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'id_mario_block_category', 10, 2);

/***************************************
 * Theme Farben in den Gutenberg Editor einfplegen
 ***************************************/
function id_gutenberg_colors_support() {
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => esc_html__( 'Schwarz', 'id_theme' ),
			'slug'  => 'black',
			'color' => '#000000'
		),
		array(
			'name'  => esc_html__( 'Rot', 'id_theme' ),
			'slug'	=> 'red',
			'color' => '#8b0500'
		),
		array(
			'name'  => esc_html__( 'Grau', 'id_theme' ),
			'slug'  => 'gray',
			'color' => '#757575'
		)
	) );
}
add_action( 'after_setup_theme', 'id_gutenberg_colors_support' );

/***************************************
 * Benutzerdefinierter Sprachumschalter
 ***************************************/
function id_custom_lng_switch() {
	$languages = apply_filters( 'wpml_active_languages', array( 'skip_missing' => 0 ) );
	if( !empty( $languages ) ) {
		echo '<div id="lng_switcher_container" class="d-none d-lg-flex"><ul class="list-unstyled mb-0">';
		foreach( $languages as $language ) {
			$add_active = '';
			if( $language['active'] ) {
				$add_active = ' class="active" ';
			}
			echo '<li><a ' . $add_active . 'href="' . esc_url( $language['url'] ) . '" target="_self">' . strtoupper( esc_attr( $language['language_code'] ) ) . '</a></li>';
		}
		echo '</ul></div>';
	}
}