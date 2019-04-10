<div id="modal-openPersonalizarCancel" class="modal">
	<div class="modal-content">
		<div class="modal-body">
			<em class="icon-close close-modal"></em>
			<p class="text-center margin-bottom-10"><strong class="uppercase">No Personalizar</strong></p>
			<p>Al dar clic en aceptar confirmas que no deseas personalizar tu producto y se preparará para su entrega tal como está.</p>
			<form id="NoPers-form" name="NoPers-form" action=""  method="post" class="validation relative margin-top-10" enctype="multipart/form-data" data-parsley-noPersonalizacion>
				<label for="persOrder">No. de orden*:</label>
				<span class="block_persOrder"></span>	
				<input type="text" id="persOrder" name="persOrder" required data-parsley-required-message="El campo es obligatorio." value="<?php echo $order->get_order_number(); ?>">
				<label for="persProducto">Producto*:</label>
				<select id="persProducto" name="persProducto" required data-parsley-required-message="El campo es obligatorio." >
					<?php echo $opnionsProducts; ?>
				</select>
				<div class="text-right">	
					<p class="margin-bottom-10"><small>Ya has aceptado los <a href="<?php echo SITEURL; ?>terminos-y-condiciones" class="color-primary">Términos y condiciones</a> al realizar tu compra.</small></p>	
					<input type="submit" name="submitNoPers" class="btn inline-block" value="Enviar" />
					<input type="hidden" name="btnSubmitNoPers" value="post" />
					<?php wp_nonce_field( 'NoPers-form' ); ?>
				</div>
			</form>					
		</div>
	</div>
</div>
<? if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['btnSubmitNoPers'] )) : 

	$orden 				=  $_POST['persOrder'];
	$producto 			=  $_POST['persProducto'];
	$title 				=  '0rden: #' . $orden . ' | ' . $producto . ' | Sin Personalizar';
	$content 			=  'No. de Pedido: #' . $orden . '<br>';
	$content 			.=  'Fecha: ' . wc_format_datetime( $order->get_date_created() ) . '<br><br>';
	$content 			.=  'Producto: ' . $producto . '<br>';
	//$content 			.=  'Cantidad: ' . $item->get_quantity() . '<br><br>';
	$content 			.=  'Se confirmó que el producto adquirido NO SERÁ PERSONALIZADO, puedes entregarlo.';

	$post = array(
		'post_title'	=> wp_strip_all_tags($title),
		'post_status'	=> 'publish',
		'post_type' 	=> 'vy_personalizado',
		'post_content'	=> $content
	);

	$my_post_id = wp_insert_post($post);

	update_post_meta($my_post_id,'vy_personalizado_orden',$orden);
	update_post_meta($my_post_id,'vy_personalizado_producto',$producto);
	update_post_meta($my_post_id,'vy_personalizado_estatus','cancelada');


	/* Correo */
	$to 				= "contacto@vyartesublimacion.com";
    $subject 			= "Personalización Vyarte - No Personalizar";	

	$message 			= '<html style="font-family: Arial, sans-serif; font-size: 14px;"><body>';
	$message 		   .= '<h1 style="display: block; margin-bottom: 20px; text-align: center;  font-size: 20px; font-weight: 700; color: #00B4EF; text-transform: uppercase;">Personalización Vyarte</h1>';
	$message 			.= '<p>No se quiere personalización en el pedido, está listo para su envío.</p></br>';
	$message 			.= '<p>' . $content . '</p>';
	$message 			.= '<p><a href="' . SITEURL . 'wp-admin/edit.php?post_type=vy_personalizado">Ver personalizaciones</a></p>';
	$message 			.= '<div style="text-align: center; margin-bottom: 10px; margin-top: 20px;"><p><small>Este email fue enviado desde el formulario de contacto de Vyarte.</small></p></div>';
	$message 	        .= '</body></html>';

	wp_mail($to, $subject, $message);

endif; ?>