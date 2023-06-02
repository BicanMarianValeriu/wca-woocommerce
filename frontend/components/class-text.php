<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Text
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Text Styles
 */
class Text extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        if( wecodeart_if( 'is_woocommerce_archive' ) ) {
            return [];
        }
        
        return [
            'woocommerce/checkout-order-summary-coupon-form-block',
            'woocommerce/checkout-contact-information-block',
            'woocommerce/checkout-shipping-method-block',
            'woocommerce/checkout-billing-method-block',
            'woocommerce/cart-order-summary-coupon-form-block',
            'woocommerce/cart-order-summary-shipping-block',
            'woocommerce/attribute-filter',
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
                .wc-blocks-components-form-token-field-wrapper,
                .wc-block-components-combobox,
                .wc-block-components-checkbox,
                .wc-block-components-text-input
            ) {
                position: relative;
            }
            .wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container input,
            .wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container,
            .wc-block-components-textarea,
            .wc-block-components-text-input input,
            .wc-block-components-combobox input.components-combobox-control__input {
                width: 100%;
                min-height: 0;
                padding: var(--wc--input--padding-x);
                padding-top: 1.25em;
                margin: 0;
                background-color: var(--wc--input--background-color);
                border: var(--wc--input--border);
                border-radius: var(--wc--input--border-radius);
                color: var(--wc--input--color);
                font-family: var(--wc--input--font-family,inherit);
                font-size: var(--wc--input--font-size,1rem);
                line-height: var(--wc--input--line-height,1.5);
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }
            .wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container input:focus,
            .wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container:focus,
            .wc-block-components-textarea:focus,
            .wc-block-components-text-input input:focus,
            .wc-block-components-combobox input.components-combobox-control__input:focus {
                border-color: var(--wc--input--border-focus);
                box-shadow: 0 0 0 0.25rem var(--wp--preset--color--accent);
                outline: 0;
            }
            .wc-block-components-text-input:focus-within label,
            .wc-block-components-text-input.is-active label,
            .wc-block-components-combobox:focus-within label,
            .wc-block-components-combobox.is-active label {
                transform: translateY(5px) scale(0.75);
                opacity: 0.5;
            }
            .wc-block-components-text-input label,
            .wc-block-components-combobox label {
                position: absolute;
                top: 0;
                left: 0;
                margin: 0 0 0 calc(var(--wc--input--padding-x) + 1px);
                max-width: calc(100% - var(--wc--input--padding-x) * 2);
                overflow: hidden;
                font-family: inherit;
                font-size: inherit;
                font-style: inherit;
                font-weight: inherit;
                letter-spacing: inherit;
                line-height: inherit;
                text-decoration: inherit;
                text-overflow: ellipsis;
                text-transform: inherit;
                transform: translateY(1em);
                transform-origin: top left;
                transition: transform 0.2s ease;
                cursor: text;
            }
        ';
	}
}
