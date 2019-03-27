<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section id="contentBlog" class="container margin-top-60 margin-bottom-30">
			<h2 class="title-section"><span><?php the_title(); ?></span></h2>
			<div class="row text-center">
				<p><a href="tel:+5518339080"><em class="icon-phone-circled"></em>044 55 18339080</a></p>
				<p><a href="" id="contact-email"><em class="icon-mail-alt"></em>contacto<span>@</span>vyarte.com</a></p>
				<p>¿Deseas conocer más detalles sobre nuestros productos?<br>¿Buscas algo en particulas?<br>¡Contáctanos!</p>
			</div>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>