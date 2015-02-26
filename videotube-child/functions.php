<?php
/**
 * write your functions here.
 */
add_filter('show_admin_bar', '__return_false');
require_once(get_stylesheet_directory().'/includes/C6_Video_Categories_Widgets.php');
if( !defined('ABSPATH') ) exit;
