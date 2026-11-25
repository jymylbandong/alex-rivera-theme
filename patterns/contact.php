<?php
/**
 * Title: Contact
 * Slug: alex-rivera/contact
 * Inserter: no
 * Description: Contact heading and a mailto link whose text is the email address.
 *
 * @package Alex_Rivera
 */

$alex_rivera = alex_rivera_content();
?>
<!-- wp:group {"tagName":"section","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group has-surface-background-color has-background" id="contact" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Contact', 'alex-rivera' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( 'mailto:' . $alex_rivera['email'] ); ?>"><?php echo esc_html( $alex_rivera['email'] ); ?></a></p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
