<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Totals
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Totals Styles
 */
class Totals extends Base {
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
			.wc-block-components-totals-wrapper {
				position: relative;
				padding: 1rem 0;
			}
			.wc-block-components-totals-wrapper:empty {
				display: none;
			}
			.woocommerce-page .wc-block-components-totals-wrapper:last-child {
				padding-bottom: 0;
			}
			.wc-block-components-totals-wrapper::before {
				content: "";
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				border-style: solid;
				border-width: 1px 0 0;
				border-color: var(--wp--preset--color--accent);
				display: block;
				pointer-events: none;
			}
			.wc-block-components-totals-footer-item {
				font-size: var(--wp--preset--font-size--large);
			}
			.wc-block-components-totals-footer-item .wc-block-components-totals-item__label {
				font-weight: 700;
			}
			.wc-block-components-totals-item {
				display: flex;
				flex-wrap: wrap;
				width: 100%;
			}
			.wc-block-components-totals-item__label {
				flex-grow: 1;
			}
			.wc-block-components-totals-item__value {
				font-weight: 700;
			}
			.wc-block-components-totals-item__description {
				flex: 0 0 100%;
			}
			.wc-block-components-totals-shipping .wc-block-components-totals-item__description {
				font-size: var(--wp--preset--font-size--small);
			}
        ';
	}
}
