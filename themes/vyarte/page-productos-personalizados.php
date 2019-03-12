<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section id="servPers" class="container  padding-top-bottom-30">
			<h2 class="title-section"><span>Productos personalizados</span></h2>
			<div class="row row-complete margin-top-20">
				<div class="col s12 sm6 text-center margin-bottom-30">
					<div class="bg-gray padding-20 margin-bottom-20">
						<div class="bg-image bg-contain" style="background-image: url(https://gatchweb.com/vyarte/wp-content/uploads/2019/03/termo-lata-plata-300x300.jpg)"></div>
					</div>
					<h3 class="margin-bottom-20 uppercase"><a href="<?php the_permalink(); ?>">Productos personalizados</a></h3>
				</div>
				<div class="col s12 sm6 text-center margin-bottom-30">
					<div class="bg-gray padding-20 margin-bottom-20">
						<div class="bg-image bg-contain" style="background-image: url(https://gatchweb.com/vyarte/wp-content/uploads/2019/03/termo-lata-plata-300x300.jpg)"></div>
					</div>
					<h3 class="margin-bottom-20 uppercase"><a href="<?php the_permalink(); ?>">Identidad Corporativa</a></h3>
				</div>	
			</div>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>