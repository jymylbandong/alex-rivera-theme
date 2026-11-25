<?php
/**
 * Theme setup for Alex Rivera.
 *
 * @package Alex_Rivera
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_theme_file_path( 'inc/content.php' );
require_once get_theme_file_path( 'inc/seo.php' );

/**
 * Enqueue style.css. Block themes don't load it automatically.
 * The theme version busts the browser cache when the file changes.
 */
function alex_rivera_enqueue_styles() {
	wp_enqueue_style(
		'alex-rivera-style',
		get_theme_file_uri( 'style.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'alex_rivera_enqueue_styles' );

/**
 * Load style.css in the block editor and Site Editor too, so they match the
 * front end. Block themes already have 'editor-styles' support. WordPress
 * scopes these rules to the editor canvas, so they don't affect the admin UI.
 */
function alex_rivera_editor_styles() {
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'alex_rivera_editor_styles' );
