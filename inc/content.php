<?php
/**
 * Site content. Single source of truth for the page and the JSON-LD.
 *
 * Client copy (final, word for word): name, title, bio, email, and each
 * course's name, description, length and url.
 * Developer keys: meta_description, image*, address, knows_about,
 * and each course's slug, mode, workload and schedule.
 * Keep mode, workload and schedule in step with the visible length text.
 *
 * @package Alex_Rivera
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function alex_rivera_content() {
	return array(
		'name'             => 'Dr Alex Rivera',
		'title'            => 'Clinical Psychologist and Trainer',
		'bio'              => 'Dr Alex Rivera is a clinical psychologist based in Sydney, Australia. For the past 12 years she has trained psychologists, counsellors and social workers in Acceptance and Commitment Therapy, a practical approach that helps people handle difficult thoughts and feelings and act on what matters to them.',
		'email'            => 'hello@example.com',
		'meta_description' => 'Sydney clinical psychologist Dr Alex Rivera trains psychologists, counsellors and social workers in Acceptance and Commitment Therapy, online.',
		'image'            => array(
			'path'   => 'assets/images/alex-rivera.webp',
			'width'  => 800,
			'height' => 1000,
		),
		'image_small'      => array(
			'path'   => 'assets/images/alex-rivera-400.webp',
			'width'  => 400,
			'height' => 500,
		),
		'image_alt'        => 'Dr Alex Rivera smiling in a bright office',
		'address'          => array(
			'locality' => 'Sydney',
			'country'  => 'AU',
		),
		'knows_about'      => array(
			'Acceptance and Commitment Therapy',
			'Clinical psychology',
		),
		'courses'          => array(
			array(
				'slug'        => 'intro-act',
				'name'        => 'Introduction to Acceptance and Commitment Therapy',
				'description' => 'The core ideas and skills, for practitioners new to the approach.',
				'length'      => '6 hours, online',
				'mode'        => 'online',
				'workload'    => 'PT6H',
				'url'         => '#',
			),
			array(
				'slug'        => 'act-anxiety',
				'name'        => 'Acceptance and Commitment Therapy for Anxiety',
				'description' => 'How to apply the approach with clients experiencing anxiety.',
				'length'      => '4 hours, online',
				'mode'        => 'online',
				'workload'    => 'PT4H',
				'url'         => '#',
			),
			array(
				'slug'        => 'act-supervision',
				'name'        => 'Acceptance and Commitment Therapy Supervision',
				'description' => 'Monthly group sessions to discuss cases and build confidence.',
				'length'      => '1.5 hours a month, online',
				'mode'        => 'online',
				'schedule'    => array(
					'repeatFrequency' => 'P1M',
					'duration'        => 'PT1H30M',
				),
				'url'         => '#',
			),
		),
	);
}
