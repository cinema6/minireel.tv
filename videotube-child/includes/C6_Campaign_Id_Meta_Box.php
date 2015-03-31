<?php

function c6_add_campaign_id_meta_box() {
    add_meta_box('c6-p2-campaign-id', 'Campaign ID', 'c6_campaign_id_meta_box_markup', 'video', 'side', 'high', null);
}

function c6_campaign_id_meta_box_markup($object) {
    wp_nonce_field(basename(__FILE__), 'c6-campaign-id-nonce');

    ?>
        <div>
            <input name="c6-campaign-id" type="text" value="<?php echo get_post_meta($object->ID, 'c6-campaign-id', true); ?>">
        </div>
    <?php
}

add_action('add_meta_boxes', 'c6_add_campaign_id_meta_box');

function c6_save_campaign_id($post_id, $post, $update) {
    if (!isset($_POST['c6-campaign-id-nonce']) || !wp_verify_nonce($_POST['c6-campaign-id-nonce'], basename(__FILE__))) {
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

    $campaign_id = '';

    if(isset($_POST['c6-campaign-id'])) {
        $campaign_id = $_POST['c6-campaign-id'];
    }

    update_post_meta($post_id, 'c6-campaign-id', $campaign_id);
}

add_action('save_post', 'c6_save_campaign_id', 10, 3);
