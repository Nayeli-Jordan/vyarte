<?php get_header(); ?>
	<section>
		<div class="bg-category bg-image margin-bottom-50" style="background-image: url(<?php echo THEMEPATH; ?>images/sublimacion.jpg)">
			<div class="bg-opacity-dark bg-absolute"></div>
			<div class="content-center text-center padding-left-right-20 color-light">
				<h2 class="margin-bottom-10">Error</h2>
			</div>
		</div>
		<div class="container">
			<div class="row row-complete margin-bottom-50">
				<div class="col s12 m10 offset-m1 l8 offset-l2 text-center">
					<p class="fz-24 margin-bottom-10">Lo sentimos</p>
					<p class="margin-bottom-30">La página que estás buscando no existe o está fuera de servicio.</p>
					<a href="<?php echo SITEURL; ?>" class="btn">Volver al inicio</a>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>