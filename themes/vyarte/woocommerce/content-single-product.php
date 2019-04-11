<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

	<div class="row">
		<div class="col s12 m6 relative product-image">
			<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>
		<div class="col s12 m6 summary entry-summary">
			<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' ); ?>

			<?php if (has_term('sublimacion-y-serigrafia','product_cat')) { ?>
				<div class="info_personaliza">
					<p>Todos nuestros productos de serigrafía y sublimación se pueden personalizar. Agrégale una imagen y el texto que desees. <strong>¡Agrega a tu carrito, paga y personaliza tus productos!</strong></p>
				</div>
			<?php } ?>
		</div>		
	</div>
	<?php if (has_term('diseno-grafico','product_cat')) { ?>
		<div class="contact_diseno margin-bottom-30">
			<?php include (TEMPLATEPATH . '/template/banner/enlace-contacto-diseno.php'); ?>
		</div>
	<?php } else { ?>
		<div class="content_personaliza text-center bg-gray-light padding-top-bottom-40 margin-bottom-30">
			<h3>¡Personaliza tu producto gratis!</h3>
			<p class="margin-bottom-20">Conoce los detalles para hacerlo</p>
			<div class="row row-complete">
			<?php
			$inst_args = array(
				'post_type' 		=> 'vy_persinstruccion',
				'posts_per_page' 	=> -1,
				'order'				=> 'ASC',
				'tax_query' 		=> array(
					array(
						'taxonomy' 	=> 'cat_instruccion',
						'field'	   	=> 'slug',
						'terms'	 	=> 'instruccion-base',
						'operator'	=> 'IN',
					)
				)
			);
			$inst_query = new WP_Query( $inst_args );
			if ( $inst_query->have_posts() ) : 
				$i = 1;
				while ( $inst_query->have_posts() ) : $inst_query->the_post(); ?>
					<div class="col s12 sm6 m3 margin-bottom-20">
						<img src="<?php the_post_thumbnail_url('full'); ?>" alt="" class="responsive-img margin-bottom-10">
						<p class="text-center"><strong><?php the_title(); ?></strong></p>
					</div>			
			<?php $i ++; endwhile; wp_reset_postdata();
			endif; ?>				
			</div>
			<a href="<?php echo SITEURL; ?>personalizar-producto" target="_blank" class="btn margin-bottom-10">Ver más</a><br>
			<a href="<?php echo SITEURL; ?>terminos-y-condiciones" target="_blank" class="btn">Términos y condiciones</a>
		</div>
	<?php } ?>

	<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
