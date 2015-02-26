<?php if( !defined('ABSPATH') ) exit; ?>
<?php 
if( !class_exists('Mars_Custom_Taxonomies') ){
	class Mars_Custom_Taxonomies {
		function __construct() {
			add_action('init', array($this,'cptui_register_my_taxes_categories'));
			add_action('init', array($this,'cptui_register_my_taxes_key'));
		}
		function cptui_register_my_taxes_categories() {
			$labels = array(
				'name'              => __( 'Video Category', 'mars' ),
				'singular_name'     => __( 'Video Category', 'mars' ),
				'search_items'      => __( 'Search Video Category','mars' ),
				'all_items'         => __( 'All Video Category','mars' ),
				'parent_item'       => __( 'Parent Video Category','mars' ),
				'parent_item_colon' => __( 'Parent Video Category:','mars' ),
				'edit_item'         => __( 'Edit Video Category','mars' ),
				'update_item'       => __( 'Update Video Category','mars' ),
				'add_new_item'      => __( 'Add New Video Category','mars' ),
				'new_item_name'     => __( 'New Video Category','mars' ),
				'menu_name'         => __( 'Video Category','mars' ),
			);			
			register_taxonomy( 'categories',array (
			  0 => 'video',
			),
			array( 'hierarchical' => true,
					'label' => __( 'Video Category', 'mars' ),
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'labels' => $labels,
					'rewrite'    => array( 'slug' => 'categories' ),
				)
			); 
		}
		function cptui_register_my_taxes_key() {
			$labels = array(
				'name'              => __( 'Video Tag', 'mars' ),
				'singular_name'     => __( 'Video Tag', 'mars' ),
				'search_items'      => __( 'Search Video Tag','mars' ),
				'all_items'         => __( 'All Video Tag','mars' ),
				'parent_item'       => __( 'Parent Video Tag','mars' ),
				'parent_item_colon' => __( 'Parent Video Tag:','mars' ),
				'edit_item'         => __( 'Edit Video Tag','mars' ),
				'update_item'       => __( 'Update Video Tag','mars' ),
				'add_new_item'      => __( 'Add New Video Tag','mars' ),
				'new_item_name'     => __( 'New Video Tag','mars' ),
				'menu_name'         => __( 'Video Tag','mars' ),
			);			
			register_taxonomy( 'video_tag',array (
			  0 => 'video',
			),
			array( 'hierarchical' => false,
					'label' => __( 'Video Tag', 'mars' ),
					'rewrite'    => array( 'slug' => 'video_tag' ),
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'labels' => $labels
				) 
			); 
		}		
		
	}
	new Mars_Custom_Taxonomies();
}
