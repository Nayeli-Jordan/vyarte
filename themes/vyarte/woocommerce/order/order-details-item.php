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
	<td style="width: 220px;">
	<?php
		$noOrder 		= $order->get_order_number(); 
		$nameProduct 	= $item->get_name(); 

		$args = array(
		    'post_type'  => 'vy_personalizado',
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'vy_personalizado_orden',
					'value'		=> $noOrder,
					'compare'	=> '='
				),
				array(
					'key'		=> 'vy_personalizado_producto',
					'value'		=> $nameProduct,
					'compare'	=> '='
				)
			)
		);
		$wp_posts 	= get_posts($args);
		$loop 		= new WP_Query( $args );
		if (count($wp_posts)) : /* Si ya hay post */ 

			while ( $loop->have_posts() ) : $loop->the_post(); 
				global $post;
				$custom_fields  = get_post_custom();
				$post_id        = get_the_ID();
				$estatus      	= get_post_meta( $post_id, 'vy_personalizado_estatus', true ); 
				if ($estatus === 'personalizado') {
					$labelEstatus = 'Producto personalizado';
				} else if ($estatus === 'diferente') {
					$labelEstatus = 'Personalización diferente';
				} else {
					$labelEstatus = 'No deseo personalizar';
				} ?>
				<p><strong class="color-primary">Elegiste: </strong><?php echo $labelEstatus; ?></p>
			<?php endwhile; wp_reset_postdata();

		else: ?>

			<p id="openPersonalizar" class="btn open-modal">Personalizar Producto</p>
			<?php if ($item->get_quantity() > 1) { ?>
				<p id="openPersonalizarDiff" class="btn open-modal margin-top-10">Personalizar Diferente</p>
			<?php } ?>
			<p id="openPersonalizarCancel" class="btn btn-danger open-modal margin-top-10 color-primary cursor-pointer">No deseo personalizar</p>	

		<?php endif; ?>

	</td>

</tr>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

<tr class="woocommerce-table__product-purchase-note product-purchase-note">

	<td colspan="2"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>

</tr>

<?php endif; ?>
