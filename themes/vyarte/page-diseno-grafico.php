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
				<h3 class="margin-bottom-30">Conoce nuestro trabajo</h3>
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