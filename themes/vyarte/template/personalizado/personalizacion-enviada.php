		<div id="modal-<?php echo $itemOrderID ?>" class="modal">
			<div class="modal-content">
				<div class="modal-body">
					<em class="icon-close close-modal"></em>
					<p class="text-center margin-bottom-10"><strong class="uppercase"><?php echo $item->get_name(); ?></strong> * <?php echo $item->get_quantity(); ?></p>
					<p>Ten en cuenta que los colores llegan a variar un 15% a como lo ves en pantalla ya que ésta es una resolución en RGB y el modo de impresión será CMYK</p>
					<?php if ($item->get_quantity() > 1): ?>
						<p class="margin-top-20"><strong>Distinta personalización</strong></p>
						<p>Sí deseas una personalización distinta para cada una de las piezas de este modelo da clic en el siguiente botón</p>
						<form id="persDist-form" name="persDist-form" action=""  method="post" class="validation margin-top-10 margin-bottom-20 text-center" enctype="multipart/form-data" data-parsley-persDist>
							<input type="submit" name="submitPersDist" class="btn inline-block" value="Personalizaciones distintas" />
							<input type="hidden" name="btnSubmitPersDist" value="post" />
							<?php wp_nonce_field( 'persDist-form' ); ?>
						</form>	
						<p class="margin-top-10">Si es el mismo estilo para tus <?php echo $item->get_quantity(); ?> piezas de este modelo continúa con el siguiente formulario:</p>
					<?php endif ?>
					<form id="pers-form" name="pers-form" action=""  method="post" class="validation margin-top-10" enctype="multipart/form-data" data-parsley-personalizacion>
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
		<? if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['btnSubmitPersDist'] )) : 

			// Verify Title 
			$title 				=  '0rden: ' . $order->get_order_number() . ' | ' . $item->get_name() . ' (ID: ' . $item->get_product_id() . ') | Personalizado Distinto';
			$content 			=  'No. de Pedido: ' . $order->get_order_number() . '<br>';
			$content 			.=  'Fecha: ' . wc_format_datetime( $order->get_date_created() ) . '<br><br>';
			$content 			.=  'Producto: ' . $item->get_name() . ' (ID: ' . $item->get_product_id() . ')<br>';
			$content 			.=  'Cantidad: ' . $item->get_quantity() . '<br><br>';
			$content 			.=  'Se solicito que las piezas de este modelo tengan una PERSONALIZACIÓN DISTINTA';

			$post = array(
				'post_title'	=> wp_strip_all_tags($title),
				'post_status'	=> 'publish',
				'post_type' 	=> 'vy_personalizado',
				'post_content'	=> $content
			);

			$my_post_id = wp_insert_post($post);
		endif; ?>		

		<? if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['btnSubmitPers'] )) : 

			// Verify Title 
			$title 				=  '0rden: ' . $order->get_order_number() . ' | ' . $item->get_name() . ' (ID: ' . $item->get_product_id() . ')';
			$content 			=  'No. de Pedido: ' . $order->get_order_number() . '<br>';
			$content 			.=  'Fecha: ' . wc_format_datetime( $order->get_date_created() ) . '<br><br>';
			$content 			.=  'Producto: ' . $item->get_name() . ' (ID: ' . $item->get_product_id() . ')<br>';
			$content 			.=  'Cantidad: ' . $item->get_quantity() . '<br><br>';
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