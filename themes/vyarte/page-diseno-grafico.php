<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section>
			<div class="bg-category bg-image margin-bottom-30" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>)">
				<div class="bg-opacity-dark bg-absolute"></div>
				<div class="content-center text-center padding-left-right-20 color-light">
					<h2 class="margin-bottom-10"><?php the_title(); ?></h2>
					<?php the_content(); ?>					
				</div>
			</div>
			<div class="container">
				<h3 class="margin-bottom-30">Nuestro trabajo</h3>
				<article id="sliderHome" class="text-center margin-bottom-50">
					<div class="cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-timeout="5000" data-cycle-prev="#prevSlider" data-cycle-next="#nextSlider">
						<!-- to do - http://jquery.malsup.com/cycle2/demo/carousel.php -->
						<?php
						$dgServ_args = array(
						'post_type' 		=> 'dg_trabajos',
						'posts_per_page' 	=> 2,
						);
						$dgServ_query = new WP_Query( $dgServ_args );
						if ( $dgServ_query->have_posts() ) : 
						$i = 1;
							while ( $dgServ_query->have_posts() ) : $dgServ_query->the_post(); ?>
							<img src="<?php the_post_thumbnail_url('large'); ?>">	
							<?php $i ++; endwhile; wp_reset_postdata();
							if ($i > 0):?>
								<div class="cycle-pager"></div>
							<?php endif;						
						endif; ?>
					</div> <!-- end cycle-slideshow -->
				</article>
				<h3 class="margin-bottom-30">Servicios de Diseño Gráfico</h3>
				<?php echo do_shortcode('[products category="diseno-grafico"]'); ?>
			</div>
			<div class="bg-gray text-center padding-top-bottom-40">
				<div class="container">
					<p class="uppercase">¿No encuentras el servicio ideal que necesitas?</p>
					<p class="margin-bottom-20">Contáctanos y te ofreceremos una cotización</p>
					<a href="<?php echo SITEURL; ?>contacto" class="btn">Contacto</a>	
				</div>
			</div>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>