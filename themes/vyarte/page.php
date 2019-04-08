<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section>
			<div class="bg-category bg-image margin-bottom-30" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>)">
				<div class="bg-opacity-dark bg-absolute"></div>
				<div class="content-center text-center padding-left-right-20 color-light">
					<h2 class="margin-bottom-10"><?php the_title(); ?></h2>
				</div>
			</div>
			<div class="container">
				<div class="row row-complete margin-bottom-30">
					<div class="col s12 m10 offset-m1 l8 offset-l2">
						<?php the_content(); ?>	
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>