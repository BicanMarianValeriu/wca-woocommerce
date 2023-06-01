<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Checkbox
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Checkbox Styles
 */
class Checkbox extends Base {
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
            'woocommerce/checkout-shipping-address-block',
            'woocommerce/checkout-order-note-block',
            'woocommerce/checkout-terms-block',
            'woocommerce/attribute-filter',
            'woocommerce/rating-filter',
            'woocommerce/stock-filter',
        ];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
            .wc-block-checkbox-list {
                padding-left: 0;
                list-style: none;
                margin: 0;
            }
            .wc-block-checkbox-list__checkbox {
                margin-top: 0.5rem;
            }
            .wc-block-components-checkbox__mark {
                position: absolute;
                fill: white;
                width: 1.125em;
                height: 1.125em;
                margin-left: 0.1875em;
                margin-top: 0.0625em;
                pointer-events: none;
            }
            .wc-block-components-checkbox label {
                position: relative;
                display: flex;
                align-items: flex-start;
            }
            .wc-block-components-checkbox input {
                cursor: pointer;
                position: static;
                -webkit-appearance: none;
                        appearance: none;
                border: var(--wc--input--border);
                border-radius: calc(var(--wc--input--border-radius) / 2);
                margin: 0 var(--wc--input--padding-x) 0 0;
                height: var(--wc--checkbox--size);
                width: var(--wc--checkbox--size);
                min-height: var(--wc--checkbox--size);
                min-width: var(--wc--checkbox--size);
                overflow: hidden;
                outline: none;
                font-size: 1em;
                vertical-align: middle;
            }
            .wc-block-components-checkbox input:not(:checked) + .wc-block-components-checkbox__mark {
                display: none;
            }
            .wc-block-components-checkbox input:checked {
                background-color: var(--wp--preset--color--primary);
                border-color: var(--wp--preset--color--primary);
            }
            .wc-block-components-checkbox input:focus {
                border-color: var(--wc--input--border-focus);
                box-shadow: 0 0 0 0.25rem var(--wp--preset--color--accent);
                outline: 0;
            }
            .wc-block-components-checkbox input:checked::before,
            .wc-block-components-checkbox input:checked::after {
                content: none;
            }
        ';
	}
}
