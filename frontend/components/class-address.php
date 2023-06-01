<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Address
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Address Styles
 */
class Address extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        return [
            'woocommerce/cart-order-summary-shipping-block',
            'woocommerce/checkout-shipping-address-block',
            'woocommerce/checkout-billing-address-block',
        ];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
            :is(
                .wc-block-components-shipping-calculator-address,
                .wp-block-woocommerce-checkout-shipping-address-block,
                .wp-block-woocommerce-checkout-billing-address-block,
                .wp-block-woocommerce-checkout-order-note-block
            ) :is(
                .wc-block-components-combobox,
                .wc-block-components-checkbox,
                .wc-block-components-text-input
            ) {
                margin-bottom: var(--wp--style--block-gap);
            }
        ';
	}
}
