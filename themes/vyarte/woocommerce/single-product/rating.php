<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$averageRound = round($average, 0, PHP_ROUND_HALF_UP);

if ( $rating_count > 0 ) : ?>
	<div class="woocommerce-product-rating margin-bottom-10">
		<div class="content_stars activeToStar<?php echo $averageRound; ?>">
			<em class="icon-star star1"></em>
			<em class="icon-star star2"></em>
			<em class="icon-star star3"></em>
			<em class="icon-star star4"></em>
			<em class="icon-star star5"></em>
			<em class="margin-left-10"><?php echo $review_count; ?> opiniones</em>
		</div>
	</div>
<?php endif; ?>
