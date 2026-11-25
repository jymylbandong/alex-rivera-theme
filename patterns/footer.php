<?php
/**
 * Title: Footer
 * Slug: alex-rivera/footer
 * Inserter: no
 * Description: Copyright line with the current year and the name from inc/content.php.
 *
 * @package Alex_Rivera
 */

$alex_rivera = alex_rivera_content();
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph -->
<p>© <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( $alex_rivera['name'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
