<?php
/**
 * Title: Hero
 * Slug: alex-rivera/hero
 * Inserter: no
 * Description: Name (the page's only h1), title and photo.
 *
 * The photo is a Custom HTML block because core/image can't hold a srcset for
 * a theme asset (it only builds one for Media Library images). It's the
 * largest image above the fold, so it loads eagerly with high priority.
 *
 * @package Alex_Rivera
 */

$alex_rivera       = alex_rivera_content();
$alex_rivera_large = $alex_rivera['image'];
$alex_rivera_small = $alex_rivera['image_small'];
$alex_rivera_src   = get_theme_file_uri( $alex_rivera_large['path'] );
$alex_rivera_set   = sprintf(
	'%1$s %2$dw, %3$s %4$dw',
	esc_url( get_theme_file_uri( $alex_rivera_small['path'] ) ),
	$alex_rivera_small['width'],
	esc_url( $alex_rivera_src ),
	$alex_rivera_large['width']
);
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" id="top" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html( $alex_rivera['name'] ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size"><?php echo esc_html( $alex_rivera['title'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:html -->
<img class="hero-photo" src="<?php echo esc_url( $alex_rivera_src ); ?>" srcset="<?php echo esc_attr( $alex_rivera_set ); ?>" sizes="(max-width: 600px) 90vw, 400px" width="<?php echo esc_attr( $alex_rivera_large['width'] ); ?>" height="<?php echo esc_attr( $alex_rivera_large['height'] ); ?>" alt="<?php echo esc_attr( $alex_rivera['image_alt'] ); ?>" fetchpriority="high">
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
