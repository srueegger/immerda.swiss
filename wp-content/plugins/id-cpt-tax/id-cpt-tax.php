<?php
/*
Plugin Name: Custom Post Types
Plugin URI: https://rueegger.me
Description: Dieses Plugin verwaltet die Custom Post Types für immerda.swiss
Version: 1.0.0
Author: Samuel Rüegger
Author URI: https://rueegger.me
Text Domain: id_theme
*/

function cptui_register_my_cpts() {

	/**
	 * Post Type: Erlebnisse.
	 */

	$labels = [
		"name" => __( "Erlebnisse", "id_theme" ),
		"singular_name" => __( "Erlebnis", "id_theme" ),
	];

	$args = [
		"label" => __( "Erlebnisse", "id_theme" ),
		"labels" => $labels,
		"description" => "Verwaltet die Erlebnisberichte.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "erlebnisse", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-groups",
		"supports" => [ "title", "custom-fields", "revisions", "author" ],
		"show_in_graphql" => false,
	];

	register_post_type( "id_people", $args );

		/**
	 * Post Type: Team.
	 */

	$labels = [
		"name" => __( "Team", "id_theme" ),
		"singular_name" => __( "Team", "id_theme" ),
	];

	$args = [
		"label" => __( "Team", "id_theme" ),
		"labels" => $labels,
		"description" => "Verwaltet die Teammitglieder.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => false,
		"query_var" => true,
		"menu_icon" => "dashicons-admin-users",
		"supports" => [ "title", "custom-fields", "revisions", "author" ],
		"show_in_graphql" => false,
	];

	register_post_type( "id_team", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Kategorien.
	 */

	$labels = [
		"name" => __( "Kategorien", "id_theme" ),
		"singular_name" => __( "Kategorie", "id_theme" ),
	];

	
	$args = [
		"label" => __( "Kategorien", "id_theme" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"query_var" => true,
		"rewrite" => false,
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "id_people_cats",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "id_people_cats", [ "id_people" ], $args );

	/**
	 * Taxonomy: Team Kategorien.
	 */

	$labels = [
		"name" => __( "Kategorien", "id_theme" ),
		"singular_name" => __( "Kategorie", "id_theme" ),
	];

	
	$args = [
		"label" => __( "Kategorien", "id_theme" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"query_var" => true,
		"rewrite" => false,
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "id_team_cats",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "id_team_cats", [ "id_team" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
