<div id="modal-personalizacion-enviada" class="modal">
	<div class="fondo-modal"></div>
	<div class="modal-content">
		<div class="modal-body">
			<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
			<a href="<?php echo $actual_link; ?>" class="float-right"><i class="icon-close"></i></a>
			<p class="fz-24 text-center margin-bottom-10 margin-top-20 color-primary">¡Gracias!</p>
			<p class="text-center">Los detalles de la personalización de tu producto han sido enviados, pronto nos pondremos en contacto contigo.</p>			
		</div>
	</div>
</div>