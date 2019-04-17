<div id="modal-openPersonalizarDiff" class="modal">
	<div class="modal-content">
		<div class="modal-body">
			<em class="icon-close close-modal"></em>
			<p class="text-center margin-bottom-10"><strong class="uppercase">Personalización Distinta</strong></p>
			<p>Sí deseas una personalización distinta para cada una de las piezas de un mismo modelo completa el formulario</p>
			<form id="persDist-form" name="persDist-form" action=""  method="post" class="validation relative margin-top-10 text-center" enctype="multipart/form-data" data-parsley-persDist>
				<label for="persOrder">No. de orden*:</label>
				<span class="block_persOrder"></span>	
				<input type="text" id="persOrder" name="persOrder" required data-parsley-required-message="El campo es obligatorio." value="<?php echo $order->get_order_number(); ?>">
					<label for="persProducto">Producto*:</label>
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
	$content 			.= 'Email: <a href="mailto:' . $order->get_billing_email() . '">' . $order->get_billing_email() . '</a><br><br>';
	$content 			.=  'Producto: ' . $producto . '<br><br>';
	$content 			.=  'Se solicito que las piezas de este modelo tengan una PERSONALIZACIÓN DISTINTA, contacta a tu cliente.';

	$post = array(
		'post_title'	=> wp_strip_all_tags($title),
		'post_status'	=> 'publish',
		'post_type' 	=> 'vy_personalizado',
		'post_content'	=> $content
	);

	$my_post_id = wp_insert_post($post);

	update_post_meta($my_post_id,'vy_personalizado_orden',$orden);
	update_post_meta($my_post_id,'vy_personalizado_producto',$producto);
	update_post_meta($my_post_id,'vy_personalizado_estatus','diferente');


	/* Correo */
	$to 				= "contacto@vyartesublimacion.com";
    $subject 			= "Personalización Vyarte - Diferente";	

	$message 			= '<html style="font-family: Arial, sans-serif; font-size: 14px;"><body>';
	$message 		   .= '<h1 style="display: block; margin-bottom: 20px; text-align: center;  font-size: 20px; font-weight: 700; color: #00B4EF; text-transform: uppercase;">Personalización Vyarte</h1>';
	$message 			.= '<p>Se solicito una personalización distinta en un pedido.</p></br>';
	$message 			.= '<p>' . $content . '</p>';
	$message 			.= '<p><a href="' . SITEURL . 'wp-admin/edit.php?post_type=vy_personalizado">Ver personalizaciones</a></p>';
	$message 			.= '<div style="text-align: center; margin-bottom: 10px; margin-top: 20px;"><p><small>Este email fue enviado desde el formulario de contacto de Vyarte.</small></p></div>';
	$message 	        .= '</body></html>';

	wp_mail($to, $subject, $message);

endif; ?>