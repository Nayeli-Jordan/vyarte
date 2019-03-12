<?php 
	get_header();
	global $post;
	$currentPost[] = $post->ID;
	while ( have_posts() ) : the_post(); 
?>
	<section id="singlePost" class="container margin-top-bottom-60">
		<div class="row row-complete">		
			<div class="col s12 m3 l4">
				<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
			</div>
			<div class="col s12 m9 l8">
				<h2 class="title-section"><span><?php the_title(); ?></span></h2>
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
