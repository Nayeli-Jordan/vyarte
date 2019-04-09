<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">

	<td class="woocommerce-table__product-name product-name">
		<?php
			$is_visible        = $product && $product->is_visible();
			$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

			echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible );
			echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item->get_quantity() ) . '</strong>', $item );

			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

			wc_display_item_meta( $item );

			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
		?>
	</td>

	<td class="woocommerce-table__product-total product-total">
		<?php echo $order->get_formatted_line_subtotal( $item ); ?>
	</td>
	<td style="width: 40%;">
		<?php $itemOrderID = 'O' . $order->get_order_number() . '_P' . $item->get_product_id(); ?>
		<p id="<?php echo $itemOrderID ?>" class="btn open-modal">Personalizar</p>
		<p id="Cancel_<?php echo $itemOrderID ?>" class="open-modal margin-top-10 color-primary cursor-pointer">No deseo personalizarlo</p>
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
		<div id="modal-<?php echo $itemOrderID ?>" class="modal">
			<div class="modal-content">
				<div class="modal-body">
					<em class="icon-close close-modal"></em>
					<p class="text-center margin-bottom-10"><strong class="uppercase"><?php echo $item->get_name(); ?></strong> * <?php echo $item->get_quantity(); ?></p>
					<p>Instrucciones para personalizar tu producto.</p>
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
	</td>

</tr>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

<tr class="woocommerce-table__product-purchase-note product-purchase-note">

	<td colspan="2"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>

</tr>

<?php endif; ?>
