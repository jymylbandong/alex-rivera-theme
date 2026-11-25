<?php
/**
 * Site content. Single source of truth for the page and the JSON-LD.
 */
function alex_rivera_content() {
	return array(
		'name'    => 'Dr Alex Rivera',
		'title'   => 'Clinical Psychologist and Trainer',
		'bio'     => 'Dr Alex Rivera is a clinical psychologist based in Sydney, Australia. For the past 12 years she has trained psychologists, counsellors and social workers in Acceptance and Commitment Therapy, a practical approach that helps people handle difficult thoughts and feelings and act on what matters to them.',
		'email'   => 'hello@example.com',
		'courses' => array(
			array(
				'slug'        => 'intro-act',
				'name'        => 'Introduction to Acceptance and Commitment Therapy',
				'description' => 'The core ideas and skills, for practitioners new to the approach.',
				'length'      => '6 hours, online',
				'workload'    => 'PT6H',
				'url'         => '#',
			),
			array(
				'slug'        => 'act-anxiety',
				'name'        => 'Acceptance and Commitment Therapy for Anxiety',
				'description' => 'How to apply the approach with clients experiencing anxiety.',
				'length'      => '4 hours, online',
				'workload'    => 'PT4H',
				'url'         => '#',
			),
			array(
				'slug'        => 'act-supervision',
				'name'        => 'Acceptance and Commitment Therapy Supervision',
				'description' => 'Monthly group sessions to discuss cases and build confidence.',
				'length'      => '1.5 hours a month, online',
				'schedule'    => array( 'repeatFrequency' => 'P1M', 'duration' => 'PT1H30M' ),
				'url'         => '#',
			),
		),
	);
}