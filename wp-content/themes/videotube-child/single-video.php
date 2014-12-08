<?php if( !defined('ABSPATH') ) exit;?>
<?php get_header();
global $post, $videotube;
$guestlike = isset( $videotube['guestlike'] ) ? $videotube['guestlike'] : 1;
the_post();
?>
	<div class="MiniReel-wrapper" id="MRBox">
            <?php 
            /**
             * videotube_before_video action.
             */
            do_action( 'videotube_before_video' );
            ?>	            
        	<?php 
			/**
			 * mediapress_media action.
			 * hooked mediapress_get_media_object, 10, 1
			 */
			do_action( 'mediapress_media', get_the_ID() );
			?>
            <?php
			/**
			 * mediapress_media_pagination action.
			 * hooked mediapress_get_media_pagination, 10, 1
			 */
			do_action( 'mediapress_media_pagination', get_the_ID() );
			?>                
            <?php 
            /**
             * videotube_after_video action.
             */
            do_action( 'videotube_after_video' );
            ?>	                
            <div id="lightoff"></div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<?php 
					$defaults = array(
						'before' => '<ul class="pagination">',
						'after' => '</ul>',
						'before_link' => '<li>',
						'after_link' => '</li>',
						'current_before' => '<li class="active">',
						'current_after' => '</li>',
						'previouspagelink' => '&laquo;',
						'nextpagelink' => '&raquo;'
					);  
					bootstrap_link_pages( $defaults );
				?>				

				<!-- IF SHARE BUTTON IS CLICKED SHOW THIS -->
				<?php
					$post_data = mars_get_post_data($post->ID); 
					$url_image = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id($post->ID)) : null;
					$current_url = get_permalink( $post->ID );
					$current_title = $post_data->post_title;
					$current_trimHTML_Content = esc_html($post_data->post_content);
				?>
				<div class="row social-share-widget social-share-buttons00">
					<div class="col-xs-12">
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php print $current_url;?>"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook.png" alt="" /></a>
						<a target="_blank" href="https://twitter.com/home?status=<?php print $current_url;?>"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter.png" alt="" /></a>
						<a target="_blank" href="https://plus.google.com/share?url=<?php print $current_url;?>"><img src="<?php echo get_template_directory_uri(); ?>/img/googleplus.png" alt="" /></a>
						<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php print $current_url;?>&media=<?php print $url_image;?>&description=<?php print $current_trimHTML_Content;?>"><img src="<?php echo get_template_directory_uri(); ?>/img/pinterest.png" alt="" /></a>
						<a target="_blank" href="http://www.reddit.com/submit?url"><img src="<?php echo get_template_directory_uri(); ?>/img/reddit.png" alt="" /></a>
						<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php print $current_url;?>&title=<?php print $current_title;?>&summary=<?php print $current_trimHTML_Content;?>&source=<?php print home_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.png" alt="" /></a>
						<a target="_blank" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl=<?php print $current_url;?>&title=<?php print $current_title;?>"><img src="<?php echo get_template_directory_uri(); ?>/img/odnok.png" alt="" /></a>
						<a target="_blank" href="http://vkontakte.ru/share.php?url=<?php print $current_url;?>"><img src="<?php echo get_template_directory_uri(); ?>/img/vkontakte.png" alt="" /></a>
						<a href="mailto:?Subject=<?php print $current_title;?>&Body=<?php printf( __('I saw this and thought of you! %s','mars'), $current_url );?>"><img src="<?php echo get_template_directory_uri(); ?>/img/email.png" alt="" /></a>
					</div>
				</div>
				<div class="video-details">
					<?php 
						$author = get_the_author_meta('display_name', mars_get_post_authorID($post->ID));
					?>
					<span class="date"><?php printf(__('Published on %s by %s','mars'), get_the_date(), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.$author.'</a>' );?></span>
                    <div class="post-entry"><?php the_content();?></div>
                    <span class="meta"><?php print the_terms( $post->ID, 'categories', '<span class="meta-info">'.__('Category','mars').'</span> ', ' ' ); ?></span>
                    <span class="meta"><?php print the_terms( $post->ID, 'video_tag', '<span class="meta-info">'.__('Tag','mars').'</span> ', ' ' ); ?></span>
                </div>
				<?php dynamic_sidebar('mars-video-single-below-sidebar');?>
				<?php 
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php

function loadSingleVideoJS() {
    wp_enqueue_script(
        'single-video',
        get_stylesheet_directory_uri() . '/js/single-video.js',
        array( 'jquery' )
    );
}

add_action( 'wp_enqueue_scripts', 'loadSingleVideoJS' );
loadSingleVideoJS();
?>

<?php get_footer();?>
