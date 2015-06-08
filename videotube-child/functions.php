<?php
/**
 * write your functions here.
 */

require_once(get_stylesheet_directory().'/includes/C6_Video_Categories_Widgets.php');
require_once(get_stylesheet_directory().'/includes/C6_MiniReel_Id_Meta_Box.php');
require_once(get_stylesheet_directory().'/includes/C6_Campaign_Id_Meta_Box.php');

if( !defined('ABSPATH') ) exit;

// noop the mars_video_meta action hook
function mars_video_meta() {}
add_action('mars_video_meta', 'mars_video_meta', 10);

// turn off features in video post editor
function disable_video_post_editor() {
    remove_post_type_support( 'video', 'comments' );
    remove_post_type_support( 'video', 'editor' );
}
add_action( 'admin_init', 'disable_video_post_editor' );

// force one column video admin
function set_video_screen_columns( $columns ) {
    $columns['video'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'set_video_screen_columns' );

function get_video_screen_columns(){return 1;}
add_filter( 'get_user_option_screen_layout_video', 'get_video_screen_columns' );

// overriding the parent theme's embed hook
function mediapress_get_media_object($post_id) {
    if (!$post_id){ return; }

    $minireel_id = get_post_meta($post_id, 'c6-minireel-id', true);
    $campaign_id = get_post_meta($post_id, 'c6-campaign-id', true);

    $player_version = get_query_var('playerVersion');
    $campaign = get_query_var('campaign');
    $campaign = $campaign ? $campaign : $campaign_id;
    $src = get_query_var('src');

    $query_string = '?id=' . $minireel_id;
    $query_string .= $player_version ? '&playerVersion=' . $player_version : '';
    $query_string .= $campaign ? '&campaign=' . $campaign : '';
    $query_string .= $src ? '&src=' . $src : '';

    if ($minireel_id) {
        print '<iframe src="https://cinema6.com/solo' . $query_string . '" width="100%" height="100%" frameborder="0"></iframe>';
    }
}
add_action( 'mediapress_media' , 'mediapress_get_media_object', 10, 1);

// add accessible custom query parameters for passing version, campaign, etc.
function add_query_vars_filter( $vars ){
  $vars[] = 'playerVersion';
  $vars[] = 'campaign';
  $vars[] = 'src';
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

// add tracking code to wp_head
function insert_tracking_code() {
    require( 'includes/C6_Page_Close_Tracking.php' );
}
add_action( 'wp_head', 'insert_tracking_code', 999 );
