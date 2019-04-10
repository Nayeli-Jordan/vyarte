		<div id="modal-openPersonalizarDiff" class="modal">
			<div class="modal-content">
				<div class="modal-body">
					<em class="icon-close close-modal"></em>
					<p class="text-center margin-bottom-10"><strong class="uppercase">Personalización Distinta</strong></p>
					<p>Sí deseas una personalización distinta para cada una de las piezas de un mismo modelo completa el formulario</p>
					<form id="persDist-form" name="persDist-form" action=""  method="post" class="validation margin-top-10 text-center" enctype="multipart/form-data" data-parsley-persDist>
						<input type="text" id="persOrder" name="persOrder" required data-parsley-required-message="El campo es obligatorio." value="<?php echo $order->get_order_number(); ?>">
						<select id="persProducto" name="persProducto" required data-parsley-required-message="El campo es obligatorio." >
							<?php echo $opnionsProducts; ?>
						</select>
						<input type="submit" name="submitPersDist" class="btn inline-block" value="Personalizaciones distintas" />
						<input type="hidden" name="btnSubmitPersDist" value="post" />
						<?php wp_nonce_field( 'persDist-form' ); ?>
					</form>				
				</div>
			</div>
		</div>
		<? if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['btnSubmitPersDist'] )) : 

			$orden 				=  $_POST['persOrder'];
			$producto 			=  $_POST['persProducto'];
			$title 				=  '0rden: #' . $orden . ' | ' . $producto . ' | Personalizado Distinto';
			$content 			=  'No. de Pedido: #' . $orden . '<br>';
			$content 			.=  'Fecha: ' . wc_format_datetime( $order->get_date_created() ) . '<br><br>';
			$content 			.=  'Producto: ' . $producto . '<br><br>';
			//$content 			.=  'Cantidad: ' . $item->get_quantity() . '<br><br>';
			$content 			.=  'Se solicito que las piezas de este modelo tengan una PERSONALIZACIÓN DISTINTA';

			$post = array(
				'post_title'	=> wp_strip_all_tags($title),
				'post_status'	=> 'publish',
				'post_type' 	=> 'vy_personalizado',
				'post_content'	=> $content
			);

			$my_post_id = wp_insert_post($post);
		endif; ?>