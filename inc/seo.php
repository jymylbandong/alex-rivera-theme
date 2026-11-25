<?php
/**
 * Front-page SEO: meta description, canonical and JSON-LD.
 *
 * Every value comes from inc/content.php, so the structured data always
 * matches the visible text.
 *
 * @package Alex_Rivera
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Remove core's canonical on the front page so ours is the only one.
 * Core only prints one when the front page is a static page, but removing
 * it either way keeps the output the same whichever setting is used.
 * Runs on 'wp' because is_front_page() isn't known any earlier.
 */
function alex_rivera_remove_core_canonical() {
	if ( is_front_page() ) {
		remove_action( 'wp_head', 'rel_canonical' );
	}
}
add_action( 'wp', 'alex_rivera_remove_core_canonical' );

/**
 * Print the meta description, canonical and JSON-LD on the front page.
 */
function alex_rivera_seo_head() {
	if ( ! is_front_page() ) {
		return;
	}

	$content = alex_rivera_content();

	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $content['meta_description'] ) );
	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( home_url( '/' ) ) );

	/*
	 * JSON_HEX_TAG turns < and > into < and >, so no value can close
	 * the <script> element early. That makes it safe to keep slashes and
	 * non-ASCII characters readable.
	 */
	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode(
			alex_rivera_json_ld( $content ),
			JSON_HEX_TAG | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		)
	);
}
add_action( 'wp_head', 'alex_rivera_seo_head' );

/**
 * Build the JSON-LD graph: one Person and one Course per course.
 *
 * @param array $content Data from alex_rivera_content().
 * @return array
 */
function alex_rivera_json_ld( $content ) {
	$person_id = home_url( '/#person' );

	$graph = array(
		array(
			'@type'       => 'Person',
			'@id'         => $person_id,
			'name'        => $content['name'],
			'jobTitle'    => $content['title'],
			'description' => $content['bio'],
			'image'       => get_theme_file_uri( $content['image']['path'] ),
			'email'       => $content['email'],
			'url'         => home_url( '/' ),
			'address'     => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => $content['address']['locality'],
				'addressCountry'  => $content['address']['country'],
			),
			'knowsAbout'  => $content['knows_about'],
		),
	);

	foreach ( $content['courses'] as $course ) {
		$instance = array(
			'@type'      => 'CourseInstance',
			'courseMode' => $course['mode'],
			'instructor' => array( '@id' => $person_id ),
		);

		// Fixed-length courses have a total workload; recurring ones a schedule.
		if ( isset( $course['workload'] ) ) {
			$instance['courseWorkload'] = $course['workload'];
		}
		if ( isset( $course['schedule'] ) ) {
			$instance['courseSchedule'] = array(
				'@type'           => 'Schedule',
				'repeatFrequency' => $course['schedule']['repeatFrequency'],
				'duration'        => $course['schedule']['duration'],
			);
		}

		// No 'url' while course links are placeholders ('#').
		$graph[] = array(
			'@type'             => 'Course',
			'@id'               => home_url( '/#course-' . $course['slug'] ),
			'name'              => $course['name'],
			'description'       => $course['description'],
			'provider'          => array( '@id' => $person_id ),
			'hasCourseInstance' => $instance,
		);
	}

	return array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);
}
