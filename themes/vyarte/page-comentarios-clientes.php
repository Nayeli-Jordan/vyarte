<?php 
	get_header();
	global $post;
?>
	<section>
		<div class="bg-category bg-image margin-bottom-30" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>)">
			<div class="bg-opacity-dark bg-absolute"></div>
			<div class="content-center text-center padding-left-right-20 color-light">
				<h2 class="margin-bottom-10"><?php the_title(); ?></h2>
			</div>
		</div>
		<div id="clients_comments" class="container">
			<div class="row row-complete margin-bottom-30">
				<div class="col s12 m10 offset-m1 l8 offset-l2">
					<ol>
					<?php
						$comment_args = array(
							'post_type' 		=> 'product',
							'posts_per_page' 	=> -1,
						);
						$comment_query = new WP_Query( $comment_args );
						if ( $comment_query->have_posts() ) : 
							$i = 1;
							while ( $comment_query->have_posts() ) : $comment_query->the_post();
								$post_id        = get_the_ID();
								$comments = get_comments( $post_id );
								wp_list_comments( array( 'callback' => 'woocommerce_comments' ), $comments);
							$i ++; endwhile; wp_reset_postdata();
						endif; ?>						
					</ul>											
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>