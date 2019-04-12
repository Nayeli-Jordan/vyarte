<article id="orderPersonalizacion">
	<?php $noOrder = $order->get_order_number() ?>
	<h2>Personalizar pedido</h2>
	<p>Entra al siguiente enlace si aún no has personalizado tu producto*, entre más pronto realices este paso antes podremos hacerte entrega de tu pedido.</p>
	<p>De la misma manera, si deseas que no hagamos ningún tipo de personalización indícanoslo seleccionando "No deseo personalizar".</p>
	<a href="<?php echo SITEURL; ?>cuenta/view-order/<?php echo $noOrder; ?>">Personalizar producto</a><br>
	<p><small>*Sólo para productos personalizables de sublimación o serigrafía. No aplica en productos de diseño gráfico. Cuentas con hasta 24hr. para personalizar tu producto a partir de tu compra, de lo contrario prepararemos tu pedido para su envío sin realizar ningún cambio.</small></p><br>	
</article>