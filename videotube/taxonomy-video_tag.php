<?php if( !defined('ABSPATH') ) exit;?>
<?php get_header(); ?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>	
		<div class="row">
			<div class="col-sm-8">
            	<div class="section-header">
                    <h3><?php print $wp_query->get_queried_object()->name;?></h3>
                    <?php do_action('mars_orderblock_videos',null);?>
                </div>
				<?php if( have_posts() ):?>
				<div class="row video-section meta-maxwidth-230">
					<?php 			
					$thumbnail_size = mars_convert_columns_to_thumbnail_size();
					while ( have_posts() ) : the_post();
					?>
					<div class="col-sm-<?php print mars_get_columns();?> col-xs-6 item">
						<div class="item-img">
						<?php 
							if( has_post_thumbnail() ){
								print '<a href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null, $thumbnail_size , array('class'=>'img-responsive')) . '</a>';
							}
						?>
							<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
						</div>						
						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<?php print apply_filters('mars_video_meta',null);?>
					</div>
					<?php endwhile;?>
				</div>
				<?php do_action( 'mars_pagination', null );?>
                <?php else:?>
                	<div class="alert alert-info"><?php _e('Oops...nothing.','mars')?></div>
                <?php endif;?>
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>