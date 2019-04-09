<div id="modal-personalizacion-cancelada" class="modal">
	<div class="fondo-modal"></div>
	<div class="modal-content">
		<div class="modal-body">
			<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
			<a href="<?php echo $actual_link; ?>" class="float-right"><i class="icon-close"></i></a>
			<p class="fz-24 text-center margin-bottom-10 margin-top-20 color-primary">¡Perfeto!</p>
			<p class="text-center">Tu producto <span class="uppercase">no necesita ser personalizado</span>. Lo prepararemos para su envìo lo mas pronto posible.</p>			
		</div>
	</div>
</div>