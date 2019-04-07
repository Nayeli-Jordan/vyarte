<?php get_header(); 
	$currentPost[] = 0; //Evitar error de post actual de single
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section id="contentBlog" class="container margin-top-60 margin-bottom-30">
			<div class="row">
				<div class="col m4 hide-on-sm-and-down">
					<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
				</div>
				<div class="col s12 m8">
					<h2 class="text-left margin-bottom-30"><?php the_title(); ?></h2>
					<div class="row row-complete text-center">
					<?php
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$blog_args = array(
							'post_type' 		=> 'post',
							'posts_per_page' 	=> 11,
						    'paged' 			=> $paged,
						);
						$blog_query = new WP_Query( $blog_args );
						if ( $blog_query->have_posts() ) : 
							while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>

								<div class="col s12 l6 margin-bottom-30">
									<div class="bg-image" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>)"></div>
									<h3 class="margin-top-bottom-10"><a href="<?php the_permalink(); ?>" class="color-text color-primary-dark_hover"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink(); ?>" class="btn clearfix margin-top-10">Leer más</a>
								</div>

						<?php endwhile; ?>
					    <div class="col s12 pagination margin-top-large">
					    <?php 
						    $total_pages = $blog_query->max_num_pages;
						    if ($total_pages > 1){
						        $current_page = max(1, get_query_var('paged'));
						        echo paginate_links(array(
						            'base' => get_pagenum_link(1) . '%_%',
						            'format' => 'page/%#%',
						            'current' => $current_page,
						            'total' => $total_pages,
						            'prev_text'    => __('<'),
						            'next_text'    => __('>'),
						        ));
						    }
					    ?>		    	
					    </div>
						<?php wp_reset_postdata();
						endif; ?>
					</div>					
				</div>
				<div class="col s12 hide-on-med-and-up margin-top-40">
					<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
				</div>
			</div>

		</section>
	<?php endwhile; endif; 
get_footer(); ?>