<?php
/*
	Template Name: Página informativa
	Template Post Type: page
*/
get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section class="container padding-top-30">
			<h2 class="title-page"><?php the_title(); ?></h2>
			<div class="row row-complete margin-bottom-30">
				<div class="col s12 m10 offset-m1 l8 offset-l2">
					<?php the_content(); ?>	
				</div>
			</div>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>