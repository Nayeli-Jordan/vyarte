<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section id="contentBlog" class="container margin-top-60 margin-bottom-30">
			<h2 class="title-section"><span><?php the_title(); ?></span></h2>
			<div class="row text-center">
			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$blog_args = array(
					'post_type' 		=> 'post',
					'posts_per_page' 	=> 11,
				    'paged' 			=> $paged,
				);
				$blog_query = new WP_Query( $blog_args );
				if ( $blog_query->have_posts() ) : 
					$i = 1;
					while ( $blog_query->have_posts() ) : $blog_query->the_post(); 

						if ($i === 1) { ?>
							<div class="col s12 postComplete margin-bottom-30">
								<div class="bg-image" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)"></div>
						<?php } else { ?>
							<div class="col s12 m6 xl4 margin-bottom-30">
								<div class="bg-image" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>)"></div>
						<?php } ?>
							<h3 class="margin-top-bottom-10"><a href="<?php the_permalink(); ?>" class="color-text color-primary-dark_hover"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
							<a href="<?php the_permalink(); ?>" class="btn btn-tall clearfix margin-top-10">Leer más</a>
						</div>

				<?php $i ++; endwhile; ?>
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
		</section>
	<?php endwhile; endif; 
get_footer(); ?>