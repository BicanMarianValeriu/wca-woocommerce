<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Quantity
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Quantity Styles
 */
class Quantity extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
		// Global - mini cart
		return [];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			:root .wc-block-components-quantity-selector {
				display: inline-flex;
				width: auto;
			}
			:root .wc-block-components-quantity-selector::after {
				border-color: var(--wp--preset--color--accent);
			}
			:root :is(
				.quantity .qty,
				.wc-block-components-quantity-selector__input,
				.wc-block-components-quantity-selector input,
				.wc-block-components-quantity-selector__button
			) {
				min-width: 2.5em;
				height: 2.5em;
				min-height: 2.5em;
				padding: 0;
				background-color: transparent;
				border: 1px solid var(--wp--preset--color--accent);
				border-radius: 0;
				box-shadow: none;
				color: inherit;
				font-size: 1em;
				text-align: center;
				-webkit-appearance: none;
						appearance: none;
				outline: none;
				order: initial;
			}
			:root :is(
				.wc-block-components-quantity-selector__input,
				.wc-block-components-quantity-selector input
			) {
				position: relative;
				font-size: 1em!important;
				max-width: 5rem;
				margin: 0 -1px;
				padding: 0!important;
				color: inherit;
				background-color: transparent;
				-moz-appearance: textfield;  
			}
			:root .wc-block-components-quantity-selector__input::-webkit-inner-spin-button,
			:root .wc-block-components-quantity-selector__input::-webkit-outer-spin-button {
				margin: 0;
				-webkit-appearance: none;
						appearance: none;
			}
			:root .wc-block-components-quantity-selector__input:focus,
			:root .wc-block-components-quantity-selector__input:active {
				border-color: var(--wp--preset--color--primary);
				box-shadow: none;
			}
			:root .wc-block-components-quantity-selector__button {
				transition: ease background-color 300ms;
				cursor: pointer;
			}
			:root .wc-block-components-quantity-selector__button:hover,
			:root .wc-block-components-quantity-selector__button:focus {
				background-color: var(--wp--preset--color--accent);
			}
			:root .wc-block-components-quantity-selector__button--minus {
				order: -1!important;
			}     
			:root .wc-block-components-quantity-selector__button--plus {
				order: -99;
			}     
        ';
	}
}
