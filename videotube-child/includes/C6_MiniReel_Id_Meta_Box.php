<?php

function c6_add_minireel_id_meta_box() {
    add_meta_box('c6-p1-minireel-id', 'MiniReel ID', 'c6_minireel_id_meta_box_markup', 'video', 'side', 'high', null);
}

function c6_minireel_id_meta_box_markup($object) {
    wp_nonce_field(basename(__FILE__), 'c6-minireel-id-nonce');

    ?>
        <div>
            <input name="c6-minireel-id" type="text" value="<?php echo get_post_meta($object->ID, 'c6-minireel-id', true); ?>">
        </div>
    <?php
}

add_action('add_meta_boxes', 'c6_add_minireel_id_meta_box');

function c6_save_minireel_id($post_id, $post, $update) {
    if (!isset($_POST['c6-minireel-id-nonce']) || !wp_verify_nonce($_POST['c6-minireel-id-nonce'], basename(__FILE__))) {
        return $post_id;
    }

    if(!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    $slug = 'video';
    if($slug != $post->post_type) {
        return $post_id;
    }

    $minireel_id = '';

    if(isset($_POST['c6-minireel-id'])) {
        $minireel_id = $_POST['c6-minireel-id'];
    }

    update_post_meta($post_id, 'c6-minireel-id', $minireel_id);
}

add_action('save_post', 'c6_save_minireel_id', 10, 3);
