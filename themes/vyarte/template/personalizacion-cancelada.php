<div id="modal-personalizacion-cancelada" class="modal">
	<div class="fondo-modal"></div>
	<div class="modal-content">
		<div class="modal-body">
			<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
			<a href="<?php echo $actual_link; ?>" class="float-right"><i class="icon-close"></i></a>
			<p class="fz-24 text-center margin-bottom-10 margin-top-20 color-primary">¡Gracias!</p>
			<p class="text-center">Recibimos tu notificación de que el producto <span class="uppercase">no será personalizado</span>, lo prepararemos para su entrega.</p>			
		</div>
	</div>
</div>