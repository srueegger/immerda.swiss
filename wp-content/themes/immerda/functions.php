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
require_once 'inc/custom-blocks.php';
require_once 'inc/custom-shortcodes.php';
require_once 'inc/ajax-calls.php';
require_once 'inc/gravityforms.php';

/***************************************
 * Bildgrössen definieren
 ***************************************/
add_image_size( 'slider-lg', 1296, 650, array( 'left', 'top' ) );
add_image_size( 'slider-lg-2x', 2592, 1300, array( 'left', 'top' ) );
add_image_size( 'slide_mobile', 450 );
add_image_size( 'slide_mobile-2x', 900 );


/***************************************
 *  WordPress Theme Support
 ***************************************/
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
add_theme_support( 'responsive-embeds' );
add_filter('show_admin_bar', '__return_false');

/***************************************
 * Enqueue scripts and styles.
 ***************************************/
function immerda_scripts() {
	$js_depend = array(
		'jquery'
	);
	if ( WP_DEBUG ) {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/css/theme.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/js/theme.js' ) );
		wp_enqueue_style( 'immerda-style', DEV_CSS . '/theme.css', array(), $modificated_css );
		wp_register_script( 'immerda-script', DEV_JS . '/theme.js', $js_depend, $modificated_js, true );
	} else {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/css/theme.min.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/js/theme.min.js' ) );
		wp_enqueue_style( 'immerda-style', DIST_CSS . '/theme.min.css', array(), $modificated_css );
		wp_register_script( 'immerda-script', DIST_JS . '/theme.min.js', $js_depend, $modificated_js, true );
	}
	$immerda_vars = array(
		'home_url' => HOME_URI,
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'chatbot' => array(
			'name' => get_field( 'chatbot_sender', 'option' ),
			'name_user' => get_field( 'chatbot_sender_user', 'option' ),
			'msg_before' => '<div class="bot_message"><div class="bot_message--inner"><p>',
			'msg_before_user' => '<div class="bot_message"><div class="bot_message--inner user"><p>',
			'msg_after' => '</p></div><div class="bot_message--meta">',
			'welcome' => get_field( 'chatbot_welcome_messages', 'option' ),
			'conclusions' => get_field( 'chatbot_conclusions', 'option' )
		)
	);
	wp_localize_script( 'immerda-script', 'id_vars', $immerda_vars );
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
		),
		array(
			'name'  => esc_html__( 'Weiss', 'id_theme' ),
			'slug'  => 'white',
			'color' => '#ffffff'
		),
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

/***************************************
 * Benutzerdefinierte Gutenberg Filters - JavaScript
 ***************************************/
function id_enqueue_block_editor_assets() {
	wp_enqueue_script( 'block-filters', DIST_JS . '/block-filters.js', array( 'wp-hooks' ), '1.0.0', true );
}
add_action( 'enqueue_block_editor_assets', 'id_enqueue_block_editor_assets' );


/***************************************
 * Wartungsmodus
 ***************************************/
function id_maintenance_mode() {
	if( !is_user_logged_in() && get_field( 'sys_maintenance', 'option' ) ) {
		wp_die('<h1>Under Maintenance</h1><br />Seite wird gerade bearbeitet!');
	}
}
add_action('get_header', 'id_maintenance_mode');