<?php
/**
 * Title: About
 * Slug: alex-rivera/about
 * Inserter: no
 * Description: About heading and the bio from inc/content.php.
 *
 * The inner group uses the default (flow) layout. A constrained layout centres
 * each child with auto margins, which would centre the narrower bio; inside a
 * flow group the bio keeps the section's left edge.
 *
 * @package Alex_Rivera
 */

$alex_rivera = alex_rivera_content();
?>
<!-- wp:group {"tagName":"section","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group has-surface-background-color has-background" id="about" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'About', 'alex-rivera' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"bio"} -->
<p class="bio"><?php echo esc_html( $alex_rivera['bio'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
