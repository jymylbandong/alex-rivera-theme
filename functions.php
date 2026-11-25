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
