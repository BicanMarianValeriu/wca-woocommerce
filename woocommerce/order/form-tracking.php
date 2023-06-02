<?php
/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
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

global $post;

wecodeart( 'styles' )->Utilities->load( [
	'col-md-10',
	'col-lg-6',
	'mx-auto',
	'my-5',
	'mb-3',
	'mb-0',
] );

?>
<div class="card col-md-10 col-lg-6 my-5 mx-auto">
	<div class="card-header">
		<p class="mb-0"><?php
		
			esc_html_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' );
			
		?></p>
	</div>
	<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="woocommerce-form woocommerce-form-track-order card-body needs-validation" novalidate="">
		<?php

		/**
		 * Action hook fired at the beginning of the form-tracking form.
		 *
		 * @since 6.5.0
		 */
		do_action( 'woocommerce_order_tracking_form_start' );

		?>
		<div class="mb-3"><?php
	
			wecodeart_input( 'floating', [
				'type'	=> 'text',
				'label' => esc_html__( 'Order ID', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
				'attrs' => [
					'id'			=> 'orderid',
					'name'			=> 'orderid',
					'value'			=> isset( $_REQUEST['orderid'] ) ? esc_attr( wp_unslash( $_REQUEST['orderid'] ) ) : '',
					'placeholder'	=> ' ',
					'required'		=> true
				],
				'messages' => [
					'help' => esc_html__( 'Found in your order confirmation email.', 'woocommerce' ),
				]
			] );

		?></div>
		<div class="mb-3"><?php
	
			wecodeart_input( 'floating', [
				'type'	=> 'text',
				'label' => esc_html__( 'Billing email', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
				'attrs' => [
					'id'			=> 'order_email',
					'name'			=> 'order_email',
					'value'			=> isset( $_REQUEST['order_email'] ) ? esc_attr( wp_unslash( $_REQUEST['order_email'] ) ) : '',
					'placeholder'	=> ' ',
					'required'		=> true
				],
				'messages' => [
					'help' => esc_html__( 'Email you used during checkout.', 'woocommerce' ),
				]
			] );
		
		?></div>
		<?php

		/**
		 * Action hook fired in the middle of the form-tracking form (before the submit button).
		 *
		 * @since 6.5.0
		 */
		do_action( 'woocommerce_order_tracking_form' );

		?>
		<div class="wp-block-button"><?php

			$classes = [ 'wp-block-button__link', 'has-primary-background-color' ];
			$classes[] = wc_wp_theme_get_element_class_name( 'button' );

			wecodeart_input( 'button', [
				'type'	=> 'submit',
				'label' => esc_html__( 'Track', 'woocommerce' ),
				'attrs' => [
					'name'	=> 'track',
					'value'	=> esc_attr__( 'Track', 'woocommerce' ),
					'class'	=> join( ' ', array_filter( $classes ) )
				]
			] );

			wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' );

		?></div><?php

		/**
		 * Action hook fired at the end of the form-tracking form (after the submit button).
		 *
		 * @since 6.5.0
		 */
		do_action( 'woocommerce_order_tracking_form_end' );

		?>
	</form>
</div>
