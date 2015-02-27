<?php
/**
 * write your functions here.
 */

require_once(get_stylesheet_directory().'/includes/C6_Video_Categories_Widgets.php');
require_once(get_stylesheet_directory().'/includes/C6_MiniReel_Id_Meta_Box.php');

if( !defined('ABSPATH') ) exit;

// noop the mars_video_meta action hook
function mars_video_meta() {}
add_action('mars_video_meta', 'mars_video_meta', 10);

// turn off the admin bar at the top of the site when logged in
add_filter('show_admin_bar', '__return_false');


function mediapress_get_media_object($post_id) {
    if (!$post_id){ return; }

    $minireel_id = get_post_meta($post_id, 'c6-minireel-id', true);

    print '<iframe src="http://cinema6.com/solo?id=' . $minireel_id . '" width="100%" height="100%" frameborder="0"></iframe>';

}
add_action( 'mediapress_media' , 'mediapress_get_media_object', 10, 1);
