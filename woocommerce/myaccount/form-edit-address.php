<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
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

use function WeCodeArt\Functions\get_prop;

wecodeart( 'styles' )->Utilities->load( [
	'fw-700',
	'my-0',
	'mb-0',
] );

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>
<form method="post" class="card needs-validation" novalidate="">
	<div class="card-header">
		<h6 class="fw-700 my-0"><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h6><?php // @codingStandardsIgnoreLine ?>
	</div>
	<div class="card-body">
		<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>
		<div class="grid" style="--wp--columns:2;">
		<?php foreach ( $address as $key => $field ) {
			woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
		} ?>
		</div>
		<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
	</div>
	<div class="card-footer">
		<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
		<div class="wp-block-button">
			<?php			
			
				$classes = [ 'wp-block-button__link', 'has-primary-background-color' ];
				$classes[] = wc_wp_theme_get_element_class_name( 'button' );

				wecodeart_input( 'button', [
					'type'	=> 'submit',
					'label' => esc_html__( 'Save address', 'woocommerce' ),
					'attrs' => [
						'name'	=> 'save_address',
						'value'	=> esc_attr__( 'Save address', 'woocommerce' ),
						'class'	=> join( ' ', array_filter( $classes ) )
					]
				] );
			
			?>
		</div>
		<input type="hidden" name="action" value="edit_address" />	
	</div>
</form>
<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
