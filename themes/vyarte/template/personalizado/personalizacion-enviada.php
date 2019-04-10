<div id="modal-openPersonalizar" class="modal">
	<div class="modal-content">
		<div class="modal-body">
			<em class="icon-close close-modal"></em>
			<p class="text-center margin-bottom-10"><strong class="uppercase">Personalización</strong></p>
			<p>Ten en cuenta que los colores llegan a variar un 15% a como lo ves en pantalla ya que ésta es una resolución en RGB y el modo de impresión será CMYK</p>
			<form id="pers-form" name="pers-form" action=""  method="post" class="validation relative margin-top-10" enctype="multipart/form-data" data-parsley-personalizacion>
				<label for="persOrder">No. de orden*:</label>
				<span class="block_persOrder"></span>				
				<input type="text" id="persOrder" name="persOrder" required data-parsley-required-message="El campo es obligatorio." value="<?php echo $order->get_order_number(); ?>">
				<label for="persProducto">Producto*:</label>
				<select id="persProducto" name="persProducto" required data-parsley-required-message="El campo es obligatorio." >
					<?php echo $opnionsProducts; ?>
				</select>
				<label for="persDetalles">Personalización*: <small>Hasta 1000 carácteres</small></label>
				<textarea id="persDetalles" name="persDetalles" placeholder="Descríbenos la personalización de tu producto: tamaño, posición, tonalidad, etc." required data-parsley-length="[20, 1000]" data-parsley-required-message="El campo es obligatorio." data-parsley-length-message="Se requieren de 20 a 200 caracteres."></textarea>
				<label for="persImage">Imágenes: <small>Max. 1 MB por imagen</small></label>
				<input type="file" accept="image/png, image/jpeg" name="persImage" id="persImage" data-parsley-max-file-size="1100">
				<input type="file" accept="image/png, image/jpeg" name="persImagea" id="persImagea" data-parsley-max-file-size="1100">
				<input type="file" accept="image/png, image/jpeg" name="persImageb" id="persImageb" data-parsley-max-file-size="1100">
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

	$orden 				= $_POST['persOrder'];
	$producto 			= $_POST['persProducto'];
	$detalles 			= $_POST['persDetalles'];
	$title 				= '0rden: #' . $orden . ' | ' . $producto . ' | Personalizado';
	$content 			= 'No. de Pedido: #' . $orden . '<br>';
	$content 			.= 'Fecha: ' . wc_format_datetime( $order->get_date_created() ) . '<br><br>';
	$content 			.= 'Producto: ' . $producto . '<br><br>';
	$content 			.= 'Detalles: ' .  $detalles;

	/* Para agregar una imagen de perfil */
	$image      		= $_FILES['persImage'];
	$nombre_image 		= $_FILES['persImage']['name']; 
	$tipo_image  		= $_FILES['persImage']['type']; 
	$tamano_image 		= $_FILES['persImage']['size'];

	$imagea      		= $_FILES['persImagea'];
	$nombre_imagea 		= $_FILES['persImagea']['name']; 
	$tipo_imagea  		= $_FILES['persImagea']['type']; 
	$tamano_imagea 		= $_FILES['persImagea']['size'];

	$imageb      		= $_FILES['persImageb'];
	$nombre_imageb 		= $_FILES['persImageb']['name']; 
	$tipo_imageb  		= $_FILES['persImageb']['type']; 
	$tamano_imageb 		= $_FILES['persImageb']['size'];

	$post = array(
		'post_title'	=> wp_strip_all_tags($title),
		'post_status'	=> 'publish',
		'post_type' 	=> 'vy_personalizado',
		'post_content'	=> $content
	);

	$my_post_id = wp_insert_post($post);

	update_post_meta($my_post_id,'vy_personalizado_orden',$orden);
	update_post_meta($my_post_id,'vy_personalizado_producto',$producto);
	update_post_meta($my_post_id,'vy_personalizado_estatus','personalizado');

	/* Subir imagen */
	include (TEMPLATEPATH . '/template/function/upload-image.php');
	include (TEMPLATEPATH . '/template/function/upload-imagea.php');
	include (TEMPLATEPATH . '/template/function/upload-imageb.php');


	/* Correo */
	$to 				= "contacto@vyartesublimacion.com";
    $subject 			= "Personalización Vyarte - Personalizada";	

	$message 			= '<html style="font-family: Arial, sans-serif; font-size: 14px;"><body>';
	$message 		   .= '<h1 style="display: block; margin-bottom: 20px; text-align: center;  font-size: 20px; font-weight: 700; color: #00B4EF; text-transform: uppercase;">Personalización Vyarte</h1>';
	$message 			.= '<p>Hay una nueva personalización de un producto. Mira los detalles y contacta a tu cliente</p></br>';
	$message 			.= '<p>' . $content . '</p>';
	$message 			.= '<p><a href="' . SITEURL . 'wp-admin/edit.php?post_type=vy_personalizado">Ver personalizaciones</a></p>';
	$message 			.= '<div style="text-align: center; margin-bottom: 10px; margin-top: 20px;"><p><small>Este email fue enviado desde el formulario de contacto de Vyarte.</small></p></div>';
	$message 	        .= '</body></html>';

	wp_mail($to, $subject, $message);

endif; ?>