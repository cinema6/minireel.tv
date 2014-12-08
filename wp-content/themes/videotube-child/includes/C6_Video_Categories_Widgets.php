<?php

function C6_Video_Categories_Widgets() {
    register_widget('C6_Video_Categories');
}

class C6_Video_Categories_Model {
    public function getCategories() {
        return array_map(function($term) {
            return [
                'id' => $term->term_id,
                'name' => $term->name,
                'slug' => $term->slug,
                'href' => get_site_url().'?'.$term->taxonomy.'='.$term->slug,
                'count' => $term->count
            ];
        }, get_terms(['categories']));
    }
}

class C6_Video_Categories extends WP_Widget {
    private $model;

    private function renderCategories($categories) {
        ?>
        <ul>
            <?php
            foreach ($categories as $index=>$category) {
                ?>
                <li class="cat-item cat-item-<?php echo $index + 1; ?>">
                    <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?> (<?php echo $category['count']; ?>)</a>
                </li>
                <?
            }
            ?>
        </ul>
        <?php
    }

    public function __construct() {
        parent::__construct(
            'c6_video_categories_widget',
            'VT Video Categories',
            [
                'description' => 'Renders a list of links to video categories.'
            ]
        );

        $this->model = new C6_Video_Categories_Model();
    }

    public function widget($args, $instance) {
        ?>
        <div class="widget widget_categories">
            <h4 class="widget-title"><?php echo $instance['title']; ?></h4>
            <?php $this->renderCategories($this->model->getCategories()); ?>
        </div>
        <?php
    }

    public function form($instance) {
        $instance = wp_parse_args((array) $instance, [
            'title' => 'Categories'
        ]);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width: 100%;" />
        </p>
        <?php
    }
}

add_action('widgets_init', 'C6_Video_Categories_Widgets');
