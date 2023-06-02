<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Panel
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Panel Styles
 */
class Panel extends Base {
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
			.wc-block-components-panel {
				position: relative;
				font-size: 1rem;
			}
			.wc-block-components-panel h2 {
				margin: 0;
				color: inherit;
				font-family: inherit;
				font-size: inherit;
				font-style: inherit;
				font-weight: inherit;
				letter-spacing: inherit;
				line-height: inherit;
				text-decoration: inherit;
				text-transform: inherit;
			}
			.wc-block-components-panel__button {
				padding: 0;
				margin: 0;
				border: 0;
				background: transparent;
				box-shadow: none;
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
			.wc-block-components-panel__button svg {
				position: absolute;
				right: 0;
			}
			.wc-block-components-panel__content {
				margin-top: 0.5rem;
			}    
        ';
	}
}
