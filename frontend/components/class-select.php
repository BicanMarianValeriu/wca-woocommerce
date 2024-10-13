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
class Select extends Base {
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
            .wc-blocks-components-select__container {
                position: relative;
            }
            .wc-blocks-components-select__label {
                position: absolute;
                top: 0;
                left: 0;
                margin: 0 0 0 calc(var(--wc--input--padding-x) + 1px);
                max-width: calc(100% - var(--wc--input--padding-x)* 2);
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
                transform: translateY(5px) scale(0.75);
                transform-origin: top left;
                transition: transform 0.2s ease;
                cursor: text;
                opacity: 0.5;
            }
            .wc-blocks-components-select__expand {
                position: absolute;
                right: .5rem;
                top: 50%;
                transform: translate3d(5px, -50%, 0);
            }
            .wc-blocks-components-select__select {
                box-sizing: border-box;
                width: 100%;
                min-height: 0;
                padding: var(--wc--input--padding-x);
                padding-top: 1.25em;
                margin: 0;
                background-color: var(--wc--input--background-color);
                border: var(--wc--input--border);
                border-radius: var(--wc--input--border-radius);
                color: var(--wc--input--color);
                font-family: var(--wc--input--font-family, inherit);
                font-size: var(--wc--input--font-size, 1rem);
                line-height: var(--wc--input--line-height, 1.5);
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                appearance: none;
            }
            .wc-blocks-components-select__select:focus {
                border-color: var(--wc--input--border-focus);
                box-shadow: 0 0 0 .25rem var(--wp--preset--color--accent);
                outline: 0;
            }
        ';
	}
}
