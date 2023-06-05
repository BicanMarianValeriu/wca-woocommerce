<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;

wecodeart( 'styles' )->Utilities->load( [
	'fw-700',
	'my-0',
	'mb-0',
] );

?>

<p>
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="woocommerce-Addresses grid addresses" style="--wp--columns:2;">
<?php endif; ?>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
	<?php
		$address = wc_get_account_formatted_address( $name );
	?>
	<div class="span-2 span-md-<?php echo $col < 0 ? 2 : 1; ?>">
		<div class="woocommerce-Address card has-accent-background-color has-white-border-color h-100">
			<header class="card-header">
				<h6 class="fw-700 my-0"><?php echo esc_html( $address_title ); ?></h6>
			</header>
			<address class="card-body">
				<?php echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' ); ?>
			</address>
			<footer class="card-footer">
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php echo $address ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ); ?></a>
			</footer>
		</div>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
	<?php
endif;
