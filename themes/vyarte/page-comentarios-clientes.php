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
				<div class="col s12 m10 offset-m1 l8 offset-l2 relative">
					<div class="cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-slides="> div" data-cycle-timeout="5000"  data-cycle-prev="#prevComment" data-cycle-next="#nextComment">
					<?php
						$comments = get_comments(  );
						$i = 1;
						foreach ( $comments as $comment ) : 
							global $comment;
							$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
							if ( $rating && 'yes' === get_option( 'woocommerce_enable_review_rating' ) ) { ?>
								<div>
									<p class="client_comment"><?php echo $comment->comment_content; ?><span></span></p>
									<div class='content_stars activeToStar<?php echo $rating; ?>'>
										<em class='icon-star star1'></em>
										<em class='icon-star star2'></em>
										<em class='icon-star star3'></em>
										<em class='icon-star star4'></em>
										<em class='icon-star star5'></em>
									</div>
									<p class="client_name"><?php echo $comment->comment_author; ?></p>
								</div>
							<?php } ?>
						<?php endforeach; ?>						
					</div> <!-- end cycle-slideshow -->									
					<a href=# id="prevComment"><em class="icon-left-open"></em></a> 
					<a href=# id="nextComment"><em class="icon-right-open"></em></a>	
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>