<div id="modal-Cancel_<?php echo $itemOrderID ?>" class="modal">
	<div class="modal-content">
		<div class="modal-body">
			<em class="icon-close close-modal"></em>
			<p class="text-center margin-bottom-10"><strong class="uppercase"><?php echo $item->get_name(); ?></strong> * <?php echo $item->get_quantity(); ?></p>
			<p>Al dar clic en aceptar confirmas que no deseas personalizar tu producto y se preparará para su entrega lo antes posible.</p>
			<form id="NoPers-form" name="NoPers-form" action=""  method="post" class="validation margin-top-10" enctype="multipart/form-data" data-parsley-noPersonalizacion>
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

	// Verify Title 
	$title 				=  '0rden: ' . $order->get_order_number() . ' | ' . $item->get_name() . ' (ID: ' . $item->get_product_id() . ') | NO Personalizado';
	$content 			=  'No. de Pedido: ' . $order->get_order_number() . '<br>';
	$content 			.=  'Fecha: ' . wc_format_datetime( $order->get_date_created() ) . '<br><br>';
	$content 			.=  'Producto: ' . $item->get_name() . ' (ID: ' . $item->get_product_id() . ')<br>';
	$content 			.=  'Cantidad: ' . $item->get_quantity() . '<br><br>';
	$content 			.=  'Se confirmó que el producto adquirido NO SERÁ PERSONALIZADO';

	$post = array(
		'post_title'	=> wp_strip_all_tags($title),
		'post_status'	=> 'publish',
		'post_type' 	=> 'vy_personalizado',
		'post_content'	=> $content
	);

	$my_post_id = wp_insert_post($post);
endif; ?>