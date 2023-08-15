<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) :

	$product_ids = [];
	foreach( $upsells as $product ) {
		if( $product->get_type() !== 'variation' ) {
			$product_ids[] = $product->get_id();
		}
	}

	if( count( $product_ids ) === 0 ) {
		return;
	}

	$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'woocommerce' ) );

	$template = '<!-- wp:group {"layout":{"type":"constrained"}} -->';
	$template .= '<div class="wp-block-group">';
	if( $heading ) :
	$template .= '<!-- wp:heading {"level":3,"className":"fw-500"} -->';
	$template .= '<h3 class="wp-block-heading fw-500">' . $heading . '</h3>';
	$template .= '<!-- /wp:heading -->';
	endif;
	$template .= '<!-- wp:woocommerce/handpicked-products {"columns":4,"contentVisibility":{"image":true,"title":true,"price":true,"rating":true,"button":true},"orderby":"menu_order","products":[' . join( ',', $product_ids ) . ']} /-->';
	$template .= '</div>';
	$template .= '<!-- /wp:group -->';

	echo do_blocks( $template );

endif;
