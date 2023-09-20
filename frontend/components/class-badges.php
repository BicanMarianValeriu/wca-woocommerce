<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Badges
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Badges Styles
 */
class Badges extends Base {
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
			.wc-block-components-product-badge {
				display: inline-block;
				border: 1px solid currentColor;
				border-radius: 2px;
				padding: 0 0.66em;
				font-size: 0.65em;
				color: var(--wp--gray-500);
				text-transform: uppercase;
				white-space: nowrap;
			}
			:is(.onsale,.wc-block-grid__product-onsale,.wc-block-components-product-sale-badge) {
				position: absolute;
				display: block;
				top: 10px;
				margin: 0;
				background-color: var(--wp--preset--color--danger);
				color: var(--wp--preset--color--white);
				font-size: var(--wp--preset--font-size--small);
				font-weight: 500;
				text-align: center;
				text-transform: uppercase;
				padding: 0.5em;
				z-index: 9;
				border: 1px solid transparent;
				box-shadow: 0 2px 6px -2px rgba(0, 0, 0, 0.4);
				border-radius: 0.375rem;
			}
			:is(.onsale,.wc-block-grid__product-onsale,.wc-block-components-product-sale-badge)::before {
				content: "";
				position: absolute;
				bottom: -5px;
				width: 0;
				height: 0;
				border-top: 0 solid transparent;
				border-bottom: 5px solid transparent;
				z-index: -1;
			}
			:is(.onsale,.wc-block-grid__product-onsale,.wp-block-cart-cross-sells-product__product-onsale) {
				left: -10px;
			}
			:is(.onsale,.wc-block-grid__product-onsale,.wp-block-cart-cross-sells-product__product-onsale)::before {
				border-right: 5px solid rgba(0, 0, 0, 0.4);
				left: 5px;
			}
			.wc-block-components-sale-badge {
				color: var(--wp--preset--color--danger);
			}
			.wc-block-components-product-sale-badge--align-left {
				left: -10px;
			}
			.wc-block-components-product-sale-badge--align-left::before {
				border-right: 5px solid rgba(0, 0, 0, 0.4);
				left: 5px;
			}
			.wc-block-components-product-sale-badge--align-right {
				right: -10px;
				left: auto;
			}
			.wc-block-components-product-sale-badge--align-right::before {
				border-left: 5px solid rgba(0, 0, 0, 0.4);
				border-right: 0;
				right: 5px;
				left: initial;
			}
			.wc-block-components-product-low-stock-badge {
				color: var(--wp--preset--color--warning);
			}     
        ';
	}
}
