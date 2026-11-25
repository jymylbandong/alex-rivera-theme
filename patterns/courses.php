<?php
/**
 * Title: Courses
 * Slug: alex-rivera/courses
 * Inserter: no
 * Description: One article per course in inc/content.php: name, description, length and link.
 *
 * Length is a <dl> in a Custom HTML block (no core block outputs <dl>), so the
 * length and format are visible text, not only in the JSON-LD.
 *
 * @package Alex_Rivera
 */

$alex_rivera = alex_rivera_content();
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" id="courses" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Courses', 'alex-rivera' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"16rem"}} -->
<div class="wp-block-group alignwide">
<?php
foreach ( $alex_rivera['courses'] as $alex_rivera_course ) :
	// Descriptive, unique link text: the course name, never a bare "Learn more".
	$alex_rivera_course['link_text'] = sprintf(
		/* translators: %s: course name. */
		__( 'More about %s', 'alex-rivera' ),
		$alex_rivera_course['name']
	);
	?>
<!-- wp:group {"tagName":"article","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
<article class="wp-block-group has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $alex_rivera_course['name'] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $alex_rivera_course['description'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<dl class="course-meta">
	<dt><?php esc_html_e( 'Length', 'alex-rivera' ); ?></dt>
	<dd><?php echo esc_html( $alex_rivera_course['length'] ); ?></dd>
</dl>
<!-- /wp:html -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( $alex_rivera_course['url'] ); ?>"><?php echo esc_html( $alex_rivera_course['link_text'] ); ?></a></p>
<!-- /wp:paragraph --></article>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group --></section>
<!-- /wp:group -->
