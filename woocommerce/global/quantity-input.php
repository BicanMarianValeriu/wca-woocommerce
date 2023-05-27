<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.4.0
 */

defined( 'ABSPATH' ) || exit;

wecodeart( 'styles' )->Utilities->load( [ 'd-none' ] );

/* translators: %s: Quantity. */
$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );

?>
<div class="wc-block-components-quantity-selector quantity">
	<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
	<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>
	<?php
	
	$classes[] = 'form-control';
	$classes[] = 'wc-block-components-quantity-selector__input';
	$classes[] = 'qty';

	wecodeart_input( 'button', [
		'label' => '-',
		'attrs' => [
			'type'		=> 'button',
			'value'     => '-',
			'class'     => 'wc-block-components-quantity-selector__button',
		]
	] );
	
	wecodeart_input( $type, [
		'attrs' => [
			'id'        => $input_id,
			'name'      => $input_name,
			'value'     => $input_value,
			'title'		=> _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ),
			'class'     => join( ' ', (array) $classes ),
			'size'		=> 4,
			'min'		=> $min_value,
			'max'		=> 0 < $max_value ? $max_value : '',
			'step'			=> $readonly ? $step : null,
			'placeholder' 	=> $readonly ? $placeholder : null,
			'inputmode'		=> $readonly ? $inputmode : null,
			'readonly'		=> $readonly ? 'readonly' : null, 
			'autocomplete'	=> isset( $autocomplete ) ? $autocomplete : 'on'
		]
	] );

	wecodeart_input( 'button', [
		'label' => '+',
		'attrs' => [
			'type'		=> 'button',
			'value'     => '+',
			'class'     => 'wc-block-components-quantity-selector__button',
		]
	] );
	
	?>
	<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
</div>