		<div id="modal-openPersonalizar" class="modal">
			<div class="modal-content">
				<div class="modal-body">
					<em class="icon-close close-modal"></em>
					<p class="text-center margin-bottom-10"><strong class="uppercase">Personalización</strong></p>
					<p>Ten en cuenta que los colores llegan a variar un 15% a como lo ves en pantalla ya que ésta es una resolución en RGB y el modo de impresión será CMYK</p>
					<form id="pers-form" name="pers-form" action=""  method="post" class="validation margin-top-10" enctype="multipart/form-data" data-parsley-personalizacion>
						<input type="text" id="persOrder" name="persOrder" required data-parsley-required-message="El campo es obligatorio." value="<?php echo $order->get_order_number(); ?>">
						<select id="persProducto" name="persProducto" required data-parsley-required-message="El campo es obligatorio." >
							<?php echo $opnionsProducts; ?>
						</select>
						<textarea id="persDetalles" name="persDetalles" placeholder="Descríbenos la personalización de tu producto: tamaño, posición, tonalidad, etc." required data-parsley-length="[20, 200]" data-parsley-required-message="El campo es obligatorio." data-parsley-length-message="Se requieren de 20 a 200 caracteres."></textarea>
						<input type="file" accept="image/png, image/jpeg" name="persImage" id="persImage" data-parsley-max-file-size="400"required data-parsley-required-message="El campo es obligatorio.">
						<div class="text-right">
							<p class="margin-bottom-10"><small>Ya has aceptado los <a href="<?php echo SITEURL; ?>terminos-y-condiciones" class="color-primary">Términos y condiciones</a> al realizar tu compra.</small></p>	
							<input type="submit" name="submitPers" class="btn inline-block" value="Enviar" />
							<input type="hidden" name="btnSubmitPers" value="post" />
							<?php wp_nonce_field( 'pers-form' ); ?>
						</div>
					</form>					
				</div>
			</div>
		</div>	

		<? if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['btnSubmitPers'] )) : 

			$orden 				=  $_POST['persOrder'];
			$producto 			=  $_POST['persProducto'];
			$title 				=  '0rden: #' . $orden . ' | ' . $producto . ' | Personalizado';
			$content 			=  'No. de Pedido: #' . $orden . '<br>';
			$content 			.=  'Fecha: ' . wc_format_datetime( $order->get_date_created() ) . '<br><br>';
			$content 			.=  'Producto: ' . $producto . '<br>';
			//$content 			.=  'Cantidad: ' . $item->get_quantity() . '<br><br>';
			$content 			.=  $_POST['persDetalles'];

			/* Para agregar una imagen de perfil */
			$image      		= $_FILES['persImage'];
			$nombre_archivo 	= $_FILES['persImage']['name']; 
			$tipo_archivo  		= $_FILES['persImage']['type']; 
			$tamano_archivo 	= $_FILES['persImage']['size'];

			$post = array(
				'post_title'	=> wp_strip_all_tags($title),
				'post_status'	=> 'publish',
				'post_type' 	=> 'vy_personalizado',
				'post_content'	=> $content
			);

			$my_post_id = wp_insert_post($post);

			/* Subir imagen */
			include (TEMPLATEPATH . '/template/function/upload-image.php');
		endif; ?>