<?php 
	get_header();
	global $post;
?>
	<section id="faqs" class="container  padding-top-bottom-30">
		<h2 class="title-page"><?php the_title(); ?></h2>
		<div class="row">
			<div class="col s12 m10 offset-m1 l8 offset-l2">
				<?php
				$faqs_args = array(
					'post_type' 		=> 'vy_faqs',
					'posts_per_page' 	=> -1,
					'tax_query' 		=> array(
						array(
							'taxonomy' 	=> 'cat_faq',
							'field'	   	=> 'slug',
							'terms'	 	=> 'serigrafia-y-sublimacion',
							'operator'	=> 'NOT IN',
						),
						array(
							'taxonomy' 	=> 'cat_faq',
							'field'	   	=> 'slug',
							'terms'	 	=> 'diseno-grafico',
							'operator'	=> 'NOT IN',
						)
					)
				);
				$faqs_query = new WP_Query( $faqs_args );
				if ( $faqs_query->have_posts() ) : 
					$i = 1;
					while ( $faqs_query->have_posts() ) : $faqs_query->the_post(); ?>
						<div id="faq_<?php echo $i; ?>" class="content-faq margin-bottom-20">
							<h3><em class="icon-left-open"></em><em class="icon-right-open"></em> <?php the_title(); ?></h3>
						<?php the_content(); ?></div>			
				<?php $i ++; endwhile; wp_reset_postdata();
				endif; 

				$faqs_args = array(
					'post_type' 		=> 'vy_faqs',
					'posts_per_page' 	=> -1,
					'tax_query' 		=> array(
						array(
							'taxonomy' 	=> 'cat_faq',
							'field'	   	=> 'slug',
							'terms'	 	=> 'serigrafia-y-sublimacion',
							'operator'	=> 'IN',
						)
					)
				);
				$faqs_query = new WP_Query( $faqs_args );
				if ( $faqs_query->have_posts() ) : 
					echo "<p class='margin-bottom-20 color-primary'><strong>Sublimación y serigrafía</strong></p>";
					$i = 1;
					while ( $faqs_query->have_posts() ) : $faqs_query->the_post(); ?>
						<div id="faq_<?php echo $i; ?>" class="content-faq margin-bottom-20">
							<h3><em class="icon-left-open"></em><em class="icon-right-open"></em> <?php the_title(); ?></h3>
						<?php the_content(); ?></div>			
				<?php $i ++; endwhile; wp_reset_postdata();
				endif; 

				$faqs_args = array(
					'post_type' 		=> 'vy_faqs',
					'posts_per_page' 	=> -1,
					'tax_query' 		=> array(
						array(
							'taxonomy' 	=> 'cat_faq',
							'field'	   	=> 'slug',
							'terms'	 	=> 'diseno-grafico',
							'operator'	=> 'IN',
						)
					)
				);
				$faqs_query = new WP_Query( $faqs_args );
				if ( $faqs_query->have_posts() ) : 
					echo "<p class='margin-bottom-20 color-primary'><strong>Diseño gráfico</strong></p>";
					$i = 1;
					while ( $faqs_query->have_posts() ) : $faqs_query->the_post(); ?>
						<div id="faq_<?php echo $i; ?>" class="content-faq margin-bottom-20">
							<h3><em class="icon-left-open"></em><em class="icon-right-open"></em> <?php the_title(); ?></h3>
						<?php the_content(); ?></div>			
				<?php $i ++; endwhile; wp_reset_postdata();
				endif; ?>												
			</div>			
		</div>
	</section>
<?php get_footer(); ?>