<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section class="container  padding-top-bottom-30">
			<h2 class="title-page"><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>