<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Dropdown
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Dropdown Styles
 */
class Dropdown extends Base {

	static $deps = [ 'text' ];

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
				.wc-block-components-combobox
			) input[aria-expanded=true] {
				border-bottom-left-radius: 0;
				border-bottom-right-radius: 0;
			}
			:is(
				.wc-blocks-components-form-token-field-wrapper,
				.wc-block-components-combobox
			) label {
				font-size: 1rem;
			}
			:is(
				.wc-blocks-components-form-token-field-wrapper,
				.wc-block-components-combobox
			) .components-combobox-control__suggestions-container {
				border: 0;
			}
			:is(
				.wc-blocks-components-form-token-field-wrapper,
				.wc-block-components-combobox
			) .components-combobox-control__suggestions-container > * {
				width: 100%;
			}
			:is(
				.wc-blocks-components-form-token-field-wrapper,
				.wc-block-components-combobox
			) .components-form-token-field__suggestions-list {
				position: absolute;
				left: 0;
				right: 0;
				background-color: var(--wp--white);
				border: var(--wc--input--border);
				border-top: 0;
				border-color: var(--wp--preset--color--primary);
				max-height: 300px;
				min-width: 100%;
				overflow: auto;
				padding: 0;
				margin: 0;
				z-index: 10;
			}
			.theme-is-dark :is(
				.wc-blocks-components-form-token-field-wrapper,
				.wc-block-components-combobox
			) .components-form-token-field__suggestions-list {
				background-color: var(--wp--gray-dark);
			}
			:is(
				.wc-blocks-components-form-token-field-wrapper,
				.wc-block-components-combobox
			) .components-form-token-field__suggestion {
				padding: 0.5rem var(--wc--input--padding-x);
				cursor: pointer;
			}
			:is(
				.wc-blocks-components-form-token-field-wrapper,
				.wc-block-components-combobox
			) .components-form-token-field__suggestion.is-selected {
				background-color: var(--wp--preset--color--accent);
			}
			
			.wc-blocks-components-form-token-field-wrapper.single-selection .components-form-token-field__token {
				width: 100%;
				margin: 0;
			}
			.wc-blocks-components-form-token-field-wrapper.is-loading .components-form-token-field,
			.wc-blocks-components-form-token-field-wrapper ~ svg,
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__remove-token span,
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__label:empty,
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__suggestions-list:empty,
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container:not(.is-active) .components-form-token-field__token + input {
				display: none;
			}
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container {
				position: relative;
				padding: var(--wc--input--padding);
				background-color: transparent;
				width: auto;
			}
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container:is(:focus,:focus-within,.is-active) {
				border-color: var(--wc--input--border-focus);
			}
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container:is(:focus,:focus-within,.is-active) input {
				display: block;
			}
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container:is(:focus,:focus-within,.is-active) input:not(:first-child) {
				margin-top: var(--wc--input--padding-y);
			}
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__input-container input {
				padding: 0!important;
				border: 0!important;
				background: 0!important;
				border-radius: 0!important;
				box-shadow: none!important;
				outline: 0!important;
			}
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__token {
				position: relative;
				z-index: 1;
			}
			.wc-blocks-components-form-token-field-wrapper .components-form-token-field__suggestions-list {
				margin-top: 1.25rem;
				border-top: 1px solid var(--wc--input--border-focus);
				border-radius: var(--wc--input--border-radius);
			}
        ';
	}
}
