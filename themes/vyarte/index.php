<?php get_header(); ?>
	<section class="[ container ]">
		<p>contenido</p>
	</section>
	<section id="section-productos_destacados" class="[ container ]">
		<h2 class="title-section">Productos destacados</h2>
		<?php echo do_shortcode('[featured_products limit="5"]'); ?>
	</section>
<?php get_footer(); ?>