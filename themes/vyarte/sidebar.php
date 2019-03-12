<h3 class="uppercase">banner Vyarte</h3>
<p class="uppercase">Últimos Artículos</p>
<hr class="bg-gray-dark">
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

			<h4 class=""><a href="<?php the_permalink(); ?>" class="color-text color-primary-dark_hover"><?php the_title(); ?></a></h4>
			<em class="inline-block margin-bottom-10"><small><?php echo get_the_date(); ?></small></em>

	<?php $i ++; endwhile; wp_reset_postdata();
	endif;

	/* Banner */
	$banner_args = array(
		'post_type' 		=> 'banner',
		'posts_per_page' 	=> 1,
        'orderby' 			=> 'rand'
	);
	$banner_query = new WP_Query( $banner_args );
	if ( $banner_query->have_posts() ) : 
		$i = 1;
		while ( $banner_query->have_posts() ) : $banner_query->the_post(); ?>

			<img src="<?php the_post_thumbnail_url('medium'); ?>" class="margin-top-20">

	<?php $i ++; endwhile; wp_reset_postdata();
	endif; ?>