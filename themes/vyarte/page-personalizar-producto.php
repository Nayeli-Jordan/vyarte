<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section>
			<div class="bg-category bg-image margin-bottom-30" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>)">
				<div class="bg-opacity-dark bg-absolute"></div>
				<div class="content-center text-center padding-left-right-20 color-light">
					<h2 class="margin-bottom-10"><?php the_title(); ?></h2>
				</div>
			</div>
			<div class="container content-editor">
				<div class="row row-complete margin-top-30 margin-bottom-30">
					<div class="col s12 m10 offset-m1">
						<?php the_content(); ?>	
					</div>
					<?php
					$inst_args = array(
						'post_type' 		=> 'vy_persInstruccion',
						'posts_per_page' 	=> -1,
					);
					$inst_query = new WP_Query( $inst_args );
					if ( $inst_query->have_posts() ) : 
						$i = 1;
						while ( $inst_query->have_posts() ) : $inst_query->the_post(); ?>
							<div class="col s12 sm6 m4 margin-bottom-20">
								<img src="<?php the_post_thumbnail_url('large'); ?>" alt="" class="responsive-img margin-bottom-10">
								<p class="text-center margin-bottom-10"><strong><?php the_title(); ?></strong></p>
								<?php the_content(); ?>	
							</div>			
					<?php $i ++; endwhile; wp_reset_postdata();
					endif; ?>
				</div>
			</div>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>