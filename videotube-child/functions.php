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