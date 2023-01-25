<?php
/**
 * Template for displaying courses
 *
 * @author Themeum
 * @link https://themeum.com
 * @package TutorLMS/Templates
 * @version 1.5.8
 */

tutor_utils()->tutor_custom_header();

if ( isset( $_GET['course_filter'] ) ) {
	$filter = ( new \Tutor\Course_Filter( false ) )->load_listing( $_GET, true );
	query_posts( $filter );
}

// Load the
tutor_load_template(
	'archive-course-init',
	array_merge(
		$_GET,
		array(
			'course_filter'     => (bool) tutor_utils()->get_option( 'course_archive_filter', false ),
			'supported_filters' => tutor_utils()->get_option( 'supported_course_filters', array() ),
			'loop_content_only' => false,
		)
	)
);

tutor_utils()->tutor_custom_footer();
