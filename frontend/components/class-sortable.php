<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Sortable
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Sortable Styles
 */
class Sortable extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        return [
			'woocommerce/reviews-by-category',
			'woocommerce/reviews-by-product',
            'woocommerce/all-products',
            'woocommerce/all-reviews',
        ];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			:is(.wc-block-catalog-sorting,.wc-block-sort-select) {
				text-align: right;
				margin-bottom: 1rem;
			}
			:is(.wc-block-catalog-sorting,.wc-block-sort-select) select {
				display: inline-block;
				width: auto;
				padding: .25rem var(--wc--input--padding-x);
				padding-right: 1.5em;
				font-size: var(--wc--input--font-size);
				font-weight: var(--wc--input--font-weight);
				line-height: var(--wc--input--line-height);
				color: var(--wc--input--color);
				background-color: var(--wc--input--background-color);
				background-image: var(--wc--icon--carret);
				background-repeat: no-repeat;
				background-position: right var(--wc--input--padding-y) center;
				background-size: 1em 0.75em;
				border: var(--wc--input--border);
				border-radius: var(--wc--input--border-radius);
				transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
				-webkit-appearance: none;
						appearance: none;
			}
			:is(.wc-block-catalog-sorting,.wc-block-sort-select) select:focus {
				border-color: var(--wc--input--border-focus);
				box-shadow: 0 0 0 0.25rem var(--wp--preset--color--accent);
				outline: 0;
			}
			:is(.wc-block-catalog-sorting,.wc-block-sort-select) label {
				margin-right: 10px;
				margin-bottom: 10px;
			}  
        ';
	}
}
