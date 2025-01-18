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
                .wp-block-woocommerce-checkout-contact-information-block,
                .wp-block-woocommerce-checkout-shipping-address-block,
                .wp-block-woocommerce-checkout-billing-address-block,
                .wp-block-woocommerce-checkout-order-note-block
            ) :is(
                .wc-block-components-combobox,
                .wc-block-components-checkbox,
                .wc-block-components-text-input,
				.wc-block-components-country-input,
				.wc-block-components-state-input,
				.wc-block-checkout__guest-checkout-notice,
				.wc-block-components-address-form__address_2-toggle
            ) {
                margin: 0 0 var(--wp--style--block-gap);
            }
            .wc-block-components-address-address-wrapper:not(.is-editing) .wc-block-components-address-form-wrapper {
				height: 0;
				opacity: 0;
				visibility: hidden;
			}
			.wc-block-components-address-form__address_2-hidden-input,
			.wc-block-components-address-address-wrapper.is-editing .wc-block-components-address-card-wrapper {
				position: absolute;
				top: 0;
				opacity: 0;
				visibility: hidden;
			}
			.wc-block-components-address-form {
				display: flex;
				justify-content: space-between;
				flex-wrap: wrap;
			}
			.wc-block-components-address-form > * {
				flex: 1 1 100%;
			}
			:is(.is-small,.is-mobile) .wc-block-components-address-form__first_name {
				margin-top: 0;
			}
			:is(.is-medium,.is-large) :is(
				.wc-block-components-address-form__first_name,
				.wc-block-components-address-form__last_name
			) {
				margin-top: 0;
			}
			:where(.is-medium,.is-large) :is(
				.wc-block-components-address-form__first_name,
				.wc-block-components-address-form__last_name,
				.wc-block-components-address-form__city,
				.wc-block-components-address-form .wc-block-components-state-input 
			) {
				flex: 0 0 calc(50% - 0.75rem);
			}
			.wc-block-components-address-card {
				display: flex;
				align-items: flex-start;
				justify-content: space-between;
				border: 1px solid var(--wp--preset--color--light);
				border-radius: 5px;
				padding: var(--wp--custom--gutter);
				margin: 0 0 var(--wp--style--block-gap);
			}
			.wc-block-components-address-card__edit {
				padding: 0;
				border: 0;
				background: none;
				box-shadow: none;
				margin-left: auto;
				font-size: var(--wp--preset--font-size--small);
			}
			.wc-block-components-address-card__edit:is(:hover,:focus) {
				text-decoration: underline;
			}
			.wc-block-components-address-card__address-section {
				display: block;
				margin: 0 0 3px;
			}
			.wc-block-components-address-card__address-section:first-child {
				font-weight: bold;
			}
			.wc-block-components-address-card__address-section span::after {
				content: ",\00a0";
			}
        ';
	}
}
