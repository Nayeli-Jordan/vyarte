<?php get_header(); ?>
	<section id="sliderHome" class="text-center margin-bottom-50">
		<div class="cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-timeout="5000" data-cycle-prev="#prevSlider" data-cycle-next="#nextSlider">
		<?php
			$serv_args = array(
				'post_type' 		=> 'slider',
				'posts_per_page' 	=> 2,
			);
			$serv_query = new WP_Query( $serv_args );
			if ( $serv_query->have_posts() ) : 
				$i = 1;
				while ( $serv_query->have_posts() ) : $serv_query->the_post(); ?>
					<img src="<?php the_post_thumbnail_url('large'); ?>">	
			<?php $i ++; endwhile; wp_reset_postdata();
			endif; 
			if ($i > 0):?>
				<div class="cycle-pager"></div>
			<?php endif ?>
		</div> <!-- end cycle-slideshow -->
	</section>
	<section id="servHome" class="container text-center margin-bottom-20">
		<h2 class="title-section"><span>Servicios</span></h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
		<div class="row row-complete margin-top-20">
		<?php
			$serv_args = array(
				'post_type' 		=> 'servicios',
				'posts_per_page' 	=> 2,
			);
			$serv_query = new WP_Query( $serv_args );
			if ( $serv_query->have_posts() ) : 
				$i = 1;
				while ( $serv_query->have_posts() ) : $serv_query->the_post(); ?>
					<div class="col s12 sm6 text-center margin-bottom-30">
						<div class="bg-gray padding-20 margin-bottom-20">
							<div class="bg-image bg-contain" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)"></div>
						</div>
						<h3 class="margin-bottom-20 uppercase"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>			
			<?php $i ++; endwhile; wp_reset_postdata();
			endif; ?>				
		</div>
	</section>
	<section id="section-productos_destacados" class="container margin-top-bottom-30">
		<h2 class="title-section"><span>Productos destacados</span></h2>
		<?php echo do_shortcode('[featured_products limit="5"]'); ?>
	</section>
	<section class="bg-gray text-center padding-top-bottom-50 margin-bottom-50">
		<div class="container">
			<div class="row">
				<div class="col s12 m10 offset-m1 l8 offset-l2">
					<h2>Suscríbete a nuestro newsletter</h2>
					<p>Suscribete y recibe las mejores promociones directamente en tu correo electrónico</p>					
				</div>
			</div>
		</div>
	</section>
	<section id="blogHome" class="container margin-bottom-20">
		<h2 class="title-section"><span>Blog vyarte</span></h2>
		<div class="row row-complete">
		<?php
			$blog_args = array(
				'post_type' 		=> 'post',
				'posts_per_page' 	=> 2,
			);
			$blog_query = new WP_Query( $blog_args );
			if ( $blog_query->have_posts() ) : 
				$i = 1;
				while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
					<div class="col s12 sm6 text-center margin-bottom-30">
						<div class="bg-image margin-bottom-20" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)"></div>
						<h3 class="margin-bottom-20 uppercase"><a href="<?php the_permalink(); ?>" class="color-text color-primary-dark_hover"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="btn btn-tall clearfix margin-top-20">Leer más</a>
					</div>			
			<?php $i ++; endwhile; wp_reset_postdata();
			endif; ?>							
		</div>
	</section>
	<section class="bg-gray text-center padding-top-bottom-50">
		<div class="container">
			<h2>#VYARTE en Instagram</h2>
			<a href="" class="btn btn-tall clearfix margin-top-20">Ver instagram</a>
		</div>
	</section>
<?php get_footer(); ?>