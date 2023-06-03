<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Radio
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Radio Styles
 */
class Radio extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        return [
            'woocommerce/checkout',
            'woocommerce/cart',
        ];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.wc-block-components-radio-control-accordion-option {
				position: relative;
			}
			.wc-block-components-radio-control-accordion-option:last-child::after {
				border-width: 1px;
			}
			.wc-block-components-radio-control-accordion-option::after {
				content: "";
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				display: block;
				border-style: solid;
				border-width: 1px 1px 0;
				border-color: var(--wc--input--border-color);
				pointer-events: none;
			}
			.wc-block-components-radio-control-accordion-option label {
				padding: 1rem 1rem 1rem 3.5rem;
			}
			.wc-block-components-radio-control-accordion-option input {
				left: 1.125rem;
			}
			.wc-block-components-radio-control-accordion-content {
				padding: 0 1rem 1rem;
			}
			.wc-block-components-radio-control__input {
				position: absolute;
				top: 50%;
				left: 0;
				height: var(--wc--checkbox--size);
				width: var(--wc--checkbox--size);
				display: inline-block;
				margin: 0;
				-webkit-appearance: none;
						appearance: none;
				background: white;
				border: var(--wc--input--border);
				border-radius: 50%;
				transform: translateY(-50%);
			}
			.wc-block-components-radio-control__input:checked::before {
				content: "";
				position: absolute;
				top: 50%;
				left: 50%;
				height: calc(var(--wc--checkbox--size) / 2);
				width: calc(var(--wc--checkbox--size) / 2);
				background: var(--wp--preset--color--primary);
				border-radius: 50%;
				display: block;
				margin: 0;
				transform: translate(-50%, -50%);
			}
			.wc-block-components-radio-control__label {
				font-weight: 700;
			}
			.wc-block-components-radio-control__label-group {
				display: flex;
				justify-content: space-between;
			}
			.wc-block-components-radio-control__secondary-label {
				margin-left: 1.5rem;
			}
			.wc-block-components-radio-control__option {
				position: relative;
				display: block;
				padding: 0.5rem 0 0.5rem 2.5rem;
				color: inherit;
				font-family: inherit;
				font-size: inherit;
				font-style: inherit;
				font-weight: inherit;
				letter-spacing: inherit;
				line-height: inherit;
				text-decoration: inherit;
				text-transform: inherit;
				cursor: pointer;
			}   
        ';
	}
}
