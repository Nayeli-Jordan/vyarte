<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section id="servPers" class="container  padding-top-bottom-30">
			<h2 class="title-section"><span><?php the_title(); ?></span></h2>
			<div class="row row-complete margin-top-20">
				<div class="col s12 sm6 m4 text-center margin-bottom-30">
					<a href="<?php echo SITEURL; ?>producto-categoria/serigrafia/">
						<div class="bg-gray padding-20 margin-bottom-20">
							<div class="bg-image bg-contain" style="background-image: url(https://gatchweb.com/vyarte/wp-content/uploads/2019/03/termo-lata-plata-300x300.jpg)"></div>
						</div>
						<h3 class="margin-bottom-20 uppercase">Serigrafía</h3>
					</a>
				</div>
				<div class="col s12 sm6 m4 text-center margin-bottom-30">
					<a href="<?php echo SITEURL; ?>producto-categoria/estampado/">
						<div class="bg-gray padding-20 margin-bottom-20">
							<div class="bg-image bg-contain" style="background-image: url(https://gatchweb.com/vyarte/wp-content/uploads/2019/03/termo-lata-plata-300x300.jpg)"></div>
						</div>
						<h3 class="margin-bottom-20 uppercase">Estampado</h3>
					</a>
				</div>
				<div class="col s12 sm6 m4 text-center margin-bottom-30">
					<a href="<?php echo SITEURL; ?>producto-categoria/sublimacion/">
						<div class="bg-gray padding-20 margin-bottom-20">
							<div class="bg-image bg-contain" style="background-image: url(https://gatchweb.com/vyarte/wp-content/uploads/2019/03/termo-lata-plata-300x300.jpg)"></div>
						</div>
						<h3 class="margin-bottom-20 uppercase">Sublimación</h3>
					</a>
				</div>	
			</div>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>