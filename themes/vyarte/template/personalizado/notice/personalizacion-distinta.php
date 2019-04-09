<div id="modal-personalizacion-distinta" class="modal">
	<div class="fondo-modal"></div>
	<div class="modal-content">
		<div class="modal-body">
			<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
			<a href="<?php echo $actual_link; ?>" class="float-right"><i class="icon-close"></i></a>
			<p class="fz-24 text-center margin-bottom-10 margin-top-20 color-primary">¡Entendido!</p>
			<p class="text-center">Tu petición para personalizar cada una de tus piezas de distinta manera ha sido enviada. Pronto nos pondremos en contacto contigo para checar los detalles.</p>			
		</div>
	</div>
</div>