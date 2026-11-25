<?php
/**
 * Title: Header
 * Slug: alex-rivera/header
 * Inserter: no
 * Description: Site name linked home, and the main navigation.
 *
 * The <nav> is a Custom HTML block rather than the Navigation block: it
 * guarantees aria-label="Main", needs no JavaScript, and the links use
 * home_url() so they work from any page, not only the front page.
 *
 * @package Alex_Rivera
 */

$alex_rivera       = alex_rivera_content();
$alex_rivera_links = array(
	'about'   => __( 'About', 'alex-rivera' ),
	'courses' => __( 'Courses', 'alex-rivera' ),
	'contact' => __( 'Contact', 'alex-rivera' ),
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"className":"site-name"} -->
<p class="site-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $alex_rivera['name'] ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<nav aria-label="<?php esc_attr_e( 'Main', 'alex-rivera' ); ?>">
	<ul class="main-nav">
<?php foreach ( $alex_rivera_links as $alex_rivera_anchor => $alex_rivera_label ) : ?>
		<li><a href="<?php echo esc_url( home_url( '/#' . $alex_rivera_anchor ) ); ?>"><?php echo esc_html( $alex_rivera_label ); ?></a></li>
<?php endforeach; ?>
	</ul>
</nav>
<!-- /wp:html --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
