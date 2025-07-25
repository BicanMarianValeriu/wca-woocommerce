<?php
/**
 * External product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/external.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="is-layout-flow cart" action="<?php echo esc_url( $product_url ); ?>" method="get">

	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<div class="wp-block-button wc-block-components-product-button"><?php

	$classes = [ 'wp-block-button__link', 'wc-block-components-product-button__button', 'single_add_to_cart_button' ];
	$classes[] = wc_wp_theme_get_element_class_name( 'button' );

	wecodeart_input( 'button', [
		'label' => $button_text,
		'attrs' => [
			'type'	=> 'submit',
			'class' => join( ' ', array_filter( $classes ) )
		]
	] );
	
	?></div>

	<?php wc_query_string_form_fields( $product_url ); ?>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
