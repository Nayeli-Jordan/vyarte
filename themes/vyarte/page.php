<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section class="[ container ] padding-top-bottom-30">
			<h2 class="title-section"><span><?php the_title(); ?></span></h2>
			<p>contenido página</p>
			<?php the_content(); ?>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>