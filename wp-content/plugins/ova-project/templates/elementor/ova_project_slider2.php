<?php

    $show_link_to = $args['show_link_to_detail'];

    $data_options['items']              = $args['item_number'];
	$data_options['slideBy']            = $args['slides_to_scroll'];
	$data_options['margin']             = $args['margin_items'];
	$data_options['autoplayHoverPause'] = $args['pause_on_hover'] === 'yes' ? true : false;
	$data_options['loop']               = $args['infinite'] === 'yes' ? true : false;
	$data_options['autoplay']           = $args['autoplay'] === 'yes' ? true : false;
	$data_options['autoplayTimeout']    = $args['autoplay_speed'];
	$data_options['smartSpeed']         = $args['smartspeed'];
	$data_options['dots']               = $args['dot_control'] === 'yes' ? true : false;


	$projects = ovaproject_get_data_project_slider_2_el( $args );

?>

<div class="ova-project-slider-2">

	<div class="content slide-project-2 owl-carousel owl-theme" data-options="<?php echo esc_attr(json_encode($data_options)) ?>">

		<?php if( $projects->have_posts() ) : while ( $projects->have_posts() ) : $projects->the_post(); ?>

			<div class="item">
				<?php 
                    $thumbnail   = wp_get_attachment_image_url(get_post_thumbnail_id() , 'infetech_project_thumbnail' );
                    if ( $thumbnail == '') {
					    $thumbnail  =  \Elementor\Utils::get_placeholder_image_src();
					}
					$id          = get_the_id();
					$sub_title   = get_post_meta( $id, 'ova_project_sub_title', true );
				?>

				<div class="ova-media">
                    
                    <?php if( $show_link_to == 'yes' ): ?>
				        <a href="<?php the_permalink();?>">
					<?php endif; ?>	
						<div class="project-img">
							<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php the_title(); ?>">
						</div>
					<?php if( $show_link_to == 'yes' ): ?>
						</a>
					<?php endif; ?>

				    <div class="content">
				    	<?php if( $show_link_to == 'yes' ): ?>
				        <a href="<?php the_permalink();?>">
					    <?php endif; ?>	

							<h3 class="title">
								<?php the_title() ?>
							</h3>
							
						<?php if( $show_link_to == 'yes' ): ?>
						 </a>
					    <?php endif; ?>	

						<?php if( ! empty( $sub_title ) ) { ?>
							<p class="sub_title">
								<?php echo esc_html( $sub_title ) ?>
							</p>
						<?php } ?>
                        
                        <?php if( $show_link_to == 'yes' ): ?>
					        <a href="<?php the_permalink();?>">
						<?php endif; ?>	
							<div class="icon">
							   <i class="ovaicon ovaicon-next"></i>  
							</div>
							<div class="icon-mask"></div>
						<?php if( $show_link_to == 'yes' ): ?>
							</a>
					    <?php endif; ?>
						
				    </div>

				</div>

			</div>

		<?php endwhile; endif; wp_reset_postdata(); ?>
	</div>

</div>