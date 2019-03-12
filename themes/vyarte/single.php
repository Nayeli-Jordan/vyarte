<?php 
	get_header();
	global $post;
	
	while ( have_posts() ) : the_post(); 
?>
	<section id="singlePost" class="container margin-top-bottom-60">
		<h2 class="title-section"><span><?php the_title(); ?></span></h2>
		<div class="row row-complete">
			<div class="col s12 m10 offset-m1 l8 offset-l2">
				<img src="<?php the_post_thumbnail_url('large'); ?>" class="responsive-img margin-auto margin-bottom-20 block max-height-500">
				<div class="contentPost">
					<?php the_content(); ?>
				</div>		
			</div>
		</div>
	</section>
<?php 
	endwhile; // end of the loop.
	get_footer(); 
?>
