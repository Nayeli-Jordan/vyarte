<h3 class="uppercase margin-bottom-10">Entradas recientes:</h3>
<?php
	$blog_args = array(
		'post_type' 		=> 'post',
		'posts_per_page' 	=> 5,
		'post__not_in'		=> $currentPost
	);
	$blog_query = new WP_Query( $blog_args );
	if ( $blog_query->have_posts() ) : 
		$i = 1;
		while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>

			<h4 class="margin-bottom-10 font-normal"><a href="<?php the_permalink(); ?>" class="color-text color-primary-dark_hover none-transforme"><?php the_title(); ?></a></h4>

	<?php $i ++; endwhile; wp_reset_postdata();
	endif; ?>

	<h3 class="uppercase margin-top-40 margin-bottom-10">Suscríbete al newsletter</h3>
	<?php include (TEMPLATEPATH . '/template/mailchimp-code.php'); ?>

	<?php /* Banner */
	$banner_args = array(
		'post_type' 		=> 'banner',
		'posts_per_page' 	=> 1,
        'orderby' 			=> 'rand'
	);
	$banner_query = new WP_Query( $banner_args );
	if ( $banner_query->have_posts() ) : 
		$i = 1;
		while ( $banner_query->have_posts() ) : $banner_query->the_post(); 
			$custom_fields  = get_post_custom();
    		$post_id        = get_the_ID();
    		$enlace      = get_post_meta( $post_id, 'banner_enlace', true ); 

    		if ($enlace != '') { ?>
    			<a href="<?php echo $enlace; ?>" class="block">
    		<?php } ?>
				<img src="<?php the_post_thumbnail_url('large'); ?>" class="margin-top-40  block responsive-img">
			<?php if ($enlace != '') { ?>
    			</a>
    		<?php } 

    	$i ++; endwhile; wp_reset_postdata();
	endif; ?>