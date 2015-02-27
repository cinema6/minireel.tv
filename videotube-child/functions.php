<?php
/**
 * write your functions here.
 */

require_once(get_stylesheet_directory().'/includes/C6_Video_Categories_Widgets.php');

if( !defined('ABSPATH') ) exit;

// noop the mars_video_meta action hook
function mars_video_meta() {}
add_action('mars_video_meta', 'mars_video_meta', 10);

// turn off the admin bar at the top of the site when logged in
add_filter('show_admin_bar', '__return_false');

