<?php
/**
 * Torno-Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Torno-Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_TORNO_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'torno-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_TORNO_CHILD_VERSION, 'all' );

}
// Hook for adding custom link on LMS Dashboard
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );
add_filter('tutor_dashboard/nav_items', 'add_some_links_dashboard');
function add_some_links_dashboard($links){

	$links['custom_link'] = [
		"title" =>	__('All Courses', 'tutor'),
		"url" => "https://racelinetechnologies.com/courses/",
// 		"url" => "https://racelinetechnologies.com/available/",
		"icon" => "tutor-icon-calender-line",

	];
	return $links;
}

// Hook for adding new feild in registration form

add_filter('tutor_student_registration_required_fields', 'required_phone_no_callback');
if ( ! function_exists('required_phone_no_callback')){
    function required_phone_no_callback($atts){
        $atts['phone_no'] = 'Phone Number field is required';
        return $atts;
    }
}
add_action('user_register', 'add_phone_after_user_register');
add_action('profile_update', 'add_phone_after_user_register');
if ( ! function_exists('add_phone_after_user_register')) {
    function add_phone_after_user_register($user_id){
        if ( ! empty($_POST['phone_no'])) {
            $phone_number = sanitize_text_field($_POST['phone_no']);
            update_user_meta($user_id, '_phone_number', $phone_number);
        }
    }
}